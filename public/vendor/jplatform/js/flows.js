JarvisPlatform.controller('flowController', ['$scope', 'flowService', function ($scope, flowService) {

    $scope.flowForm = {
        module: window.module
    };

    $scope.flow = window.flow;

    if($scope.flow != null)
    {
        $scope.flowForm.name = $scope.flow.name;
        $scope.flowForm.description = $scope.flow.description;
        $scope.flowForm.active = $scope.flow.active.toString();
    }

    $scope.saveFlow = function(){
        if($scope.flow === null){
            $m = flowService.storeFlow($scope.flowForm);
            $m.success(function(data){
                window.location.href = GLOBALS.site_url+'/'+window.redirectBaseUrl+'/'+data.data.id+'/edit'
            }).error(HandleErrorResponse);
        }else{
            $m = flowService.updateFlow($scope.flowForm, $scope.flow.id);
            $m.success($scope.handleFlowSuccess).error(HandleErrorResponse);
        }
    }

    $scope.handleFlowSuccess = function(data)
    {
        $scope.flow = data;
    }

    $scope.stepModal = function(id)
    {
        $scope.stepForm = {};
        $scope.operationWithStep = "Agregar ";
        $scope.stepForm.flow_id = window.flow.id;
        if(id !== undefined)
        {
            $scope.stepForm.isEdit = true;
            $scope.stepForm.id = id;
            $scope.operationWithStep = "Editar ";
        }
        $('#stepModal').modal('show');
    }

    $scope.saveStep = function()
    {
        $('#saveStep').button('loading');
        if($scope.stepForm.isEdit === true) {
            $m = flowService.updateStep($scope.stepForm, $scope.stepForm.id);
        }else{
            $m = flowService.storeStep($scope.stepForm);
        }
        $m.success($scope.handleStepSuccess).error(HandleErrorResponse);
    }

    $scope.handleStepSuccess = function(data)
    {
        $('#saveStep').button('reset');
        $('#stepModal').modal('hide');
        $scope.getSteps();
    }

    $scope.getSteps = function()
    {
        $m = flowService.getSteps($scope.flow.id).success(function(data) {
            $scope.steps = data.data;
            $scope.initGraph(data.data);
        }).error(HandleErrorResponse);
    }

    $scope.transitionModal = function(from, id)
    {
        $scope.transitionForm = {};
        $scope.operationWithTransition = "Agregar ";
        $scope.transitionForm.flow_id = $scope.flow.id;
        $scope.transitionForm.from = from;
        if(id !== undefined)
        {
            $scope.transitionForm.isEdit = true;
            $scope.transitionForm.id = id;
            $scope.operationWithTransition = "Editar ";
        }
        $('#transitionModal').modal('show');
    }

    $scope.saveTransition = function() {
        $('#saveTransition').button('loading');
        if($scope.transitionForm.isEdit === true) {
            $m = flowService.updateTransition($scope.transitionForm, $scope.transitionForm.id);
        }else{
            $m = flowService.storeTransition($scope.transitionForm);
        }
        $m.success($scope.handleTransitionSuccess).error(HandleErrorResponse);
    }

    $scope.handleTransitionSuccess = function(data) {
        $('#saveTransition').button('loading');
        $('#transitionModal').modal('hide');
        $scope.getSteps();
    }

    $scope.initGraph = function(data) {
        jsPlumb.ready(function() {
            // create elements
            var html = "";
            $(data).each(function(d){
                html += '<div class="thumbnail node" id="'+data[d].id+'" style="position:absolute"><div class="ep" action="'+data[d].id+'"></div><div class="caption">'+data[d].name+'</div></div>';
            });
            $('#jsplump').html(html);
            $scope.doGraph(data);
        });
    }

    $scope.doGraph = function(data)
    {
        var instance = jsPlumb.getInstance({
            Endpoint: ["Dot", {radius: 2}],
            Connector:"Flowchart",
            HoverPaintStyle: {
                strokeStyle: "#1e8151",
                lineWidth: 1
            },
            ConnectionOverlays: [
                [ "Arrow", {
                    location: 1,
                    id: "arrow",
                    length: 14,
                    foldback: 0.8
                } ],
                [ "Label", {id: "label", cssClass: "aLabel" }]
            ],
            Container: "jsplump"
        });
        instance.registerConnectionType("basic", {
            anchor:"Continuous",
            connector:"Flowchart"
        });
        var windows = jsPlumb.getSelector(".node");
        var initNode = function(el) {
            // initialise draggable elements.
            instance.draggable(el);
            instance.makeSource(el, {
                filter: ".ep",
                anchor: "Continuous",
                connectorStyle: {
                    strokeStyle: "#5c96bc",
                    lineWidth: 2,
                    outlineColor: "transparent",
                    outlineWidth: 4
                },
                connectionType: "basic"
            });

            instance.makeTarget(el, {
                dropOptions: {
                    hoverClass: "dragHover"
                },
                anchor: "Continuous",
                allowLoopback: true
            });
        }
        // suspend drawing and initialise.
        instance.batch(function () {
            for (var i = 0; i < windows.length; i++) {
                initNode(windows[i], true);
            }
            $(data).each(function(d) {
                $(data[d].transitions.data).each(function(t){
                    instance.connect({
                        source: data[d].transitions.data[t].from.data.id.toString(),
                        target: data[d].transitions.data[t].to.data.id.toString(),
                        type : 'basic'
                    });
                });
            });
        });
        // construct dagre graph from JsPlumb graph
        var g = new dagre.graphlib.Graph();
        g.setGraph({});
        g.setDefaultEdgeLabel(function() { return {}; });
        $(".node").each(function(i, el) {
            var n = $(el);
            g.setNode(n.attr('id'), {width: n.width(), height: n.height()});
        });
        var edges = instance.getAllConnections();
        $(edges).each(function(e) {
            var c = edges[e];
            g.setEdge(c.source.id, c.target.id);
        });
        // calculate the layout (i.e. node positions)
        dagre.layout(g);
        // Applying the calculated layout
        var totalHeigth = 0;
        g.nodes().forEach(function(v) {
            $("#" + v).css("left", g.node(v).x + "px");
            $("#" + v).css("top", g.node(v).y + "px");
            totalHeigth = totalHeigth + g.node(v).y;
        });
        $('#jsplump').css("height", totalHeigth + 'px');
        instance.repaintEverything();
    }

}]);
/** Services **/
JarvisPlatform.factory('flowService', ['$http', function ($http) {

    service = {
        storeFlow : function(form)
        {
            return $http({
                method: 'post',
                url: GLOBALS.site_url + '/api/core/flows',
                headers: {
                    'Content-Type': 'application/json'
                },
                data: form
            });
        },
        updateFlow : function(form, id)
        {
            return $http({
                method: 'put',
                url: GLOBALS.site_url + '/api/core/flows/'+id,
                headers: {
                    'Content-Type': 'application/json'
                },
                data: form
            });
        },
        storeStep : function(form)
        {
            return $http({
                method: 'post',
                url: GLOBALS.site_url + '/api/core/steps/',
                headers: {
                    'Content-Type': 'application/json'
                },
                data: form
            });
        },
        updateStep : function(form, id)
        {
            return $http({
                method: 'put',
                url: GLOBALS.site_url + '/api/core/steps/'+id,
                headers: {
                    'Content-Type': 'application/json'
                },
                data: form
            });
        },
        getSteps : function(flow_id)
        {
            return $http({
                method: 'get',
                url: GLOBALS.site_url + '/api/core/steps?fow_id='+flow_id+'&include=transitions',
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        },
        updateTransition : function (form, id)
        {
            return $http({
                method: 'get',
                url: GLOBALS.site_url + '/api/core/transitions/'+id,
                headers: {
                    'Content-Type': 'application/json'
                },
                data: form
            });
        },
        storeTransition : function (form)
        {
            return $http({
                method: 'post',
                url: GLOBALS.site_url + '/api/core/transitions',
                headers: {
                    'Content-Type': 'application/json'
                },
                data : form
            });
        },
    };
    return service;
}]);