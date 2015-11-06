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
                window.location.href = GLOBALS.site_url+'/'+window.redirectBaseUrl+'/'+data.id+'/edit'
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

}]);
/** Services **/
JarvisPlatform.factory('flowService', ['$http', function ($http) {

    service = {
        storeFlow : function(form)
        {
            return $http({
                method: 'post',
                url: GLOBALS.site_url + '/api/core/flow',
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
                url: GLOBALS.site_url + '/api/core/flow/'+id,
                headers: {
                    'Content-Type': 'application/json'
                },
                data: form
            });
        }
    };
    return service;
}]);