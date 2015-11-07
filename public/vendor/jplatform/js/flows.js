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
                url: GLOBALS.site_url + '/api/core/steps?fow_id='+flow_id,
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