JarvisPlatform.controller('UsersSettingsController', ['$scope', 'fieldsService', function ($scope, fieldsService) {

    $scope.fields = [];

    $scope.getFields = function () {
        fieldsService.getFields(window.entity_id).success(function (data) {
            $scope.fields = data.data;
        });
    }

    $scope.deleteField = function (id) {
        swal(
            {
                title: "Esta segúro de eliminar el campo?",
                text: "Tenga en cuenta que si elimina el campo, cualquier información que este alojada ahí se borará y no podrá recuperarse",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, Estoy segúro",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false
            }, function () {
                fieldsService.deleteField(id).success(function (data) {
                    fieldsService.getFields(window.entity_id);
                    swal("Eliminado!", "Se ha eliminado el campo!", "success");
                }).error(HandleErrorResponse);
            });
    }

}]);
