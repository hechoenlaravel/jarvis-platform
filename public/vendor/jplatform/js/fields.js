JarvisPlatform.controller('createFieldController', ['$scope', 'fieldsService', function($scope, fieldsService){
    $scope.form = {};
    $scope.formOptions = "";
    $scope.getFieldDetails = function()
    {
        if($scope.form.type !== ""){
            fieldsService.getFieldOptionsForm($scope.form.type).success(function(data){
                $scope.formOptions = data.form;
            });
        }
    }
    $scope.createField = function(){
        $scope.form.returnUrl = window.returnUrl;
        fieldsService.createField(window.entity_id, $scope.form).success(function(data){
            window.location.href = data.meta.return_url;
        }).error(HandleErrorResponse);
    }
}]);
/** Services **/
JarvisPlatform.factory('fieldsService', ['$http', function($http) {
    return {
        getFields: function(entity)
        {
            return $http({
                method: 'get',
                url: GLOBALS.site_url+'/api/core/entity/'+entity+'/fields',
                headers: {
                    'Content-Type' : 'application/json'
                }
            });
        },
        getFieldOptionsForm : function(type)
        {
            return $http({
                method: 'get',
                url: GLOBALS.site_url+'/api/core/field-type/'+type+'/form',
                headers: {
                    'Content-Type' : 'application/json'
                }
            });
        },
        createField: function(entity, form)
        {
            return $http({
                method: 'post',
                url: GLOBALS.site_url+'/api/core/entity/'+entity+'/fields',
                headers: {
                    'Content-Type' : 'application/json'
                },
                data: form
            });
        }
    };
}]);
