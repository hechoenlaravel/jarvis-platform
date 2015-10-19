JarvisPlatform.controller('UsersSettingsController', ['$scope', 'fieldsService', function ($scope, fieldsService) {

    $scope.fields = [];

    $scope.getFields = function () {
        fieldsService.fieldsList(window.entity_id, $scope);
    }

    $scope.deleteField = function (id) {
        fieldsService.deleteFieldAction(window.entity_id, id, function(){
            $scope.getFields();
        });
    }

}]);
