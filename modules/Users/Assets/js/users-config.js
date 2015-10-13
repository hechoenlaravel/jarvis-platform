JarvisPlatform.controller('UsersSettingsController', ['$scope', 'fieldsService', function($scope, fieldsService) {

    $scope.fields = [];

    $scope.getFields = function()
    {
        fieldsService.getFields(window.entity_id).success(function(data){
            $scope.fields = data.data;
        });
    }

    $scope.createField = function()
    {

    }

}]);
