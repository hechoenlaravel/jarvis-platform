JarvisPlatform.controller('createFieldController', ['$scope', 'fieldsService', function ($scope, fieldsService) {
    $scope.form = {};
    $scope.formOptions = "";
    $scope.getFieldDetails = function () {
        if ($scope.form.type !== "") {
            fieldsService.getFieldOptionsForm($scope.form.type).success(function (data) {
                $scope.formOptions = data.form;
            });
        }
    }
    $scope.createField = function () {
        $scope.form.returnUrl = window.returnUrl;
        fieldsService.createField(window.entity_id, $scope.form).success(function (data) {
            window.location.href = data.meta.return_url;
        }).error(HandleErrorResponse);
    }

    $scope.editField = function () {
        $scope.form.returnUrl = window.returnUrl;
        fieldsService.editField(window.entity_id, $scope.form).success(function (data) {
            window.location.href = data.meta.return_url;
        }).error(HandleErrorResponse);
    }

    if (window.isEdit == "1") {
        $scope.form = window.fieldForm.data;
    }

    /** Select Field Type **/
    if (window.isEdit != "1") {
        $scope.form.options = [];
    }

    $scope.optionToAdd = "";

    $scope.addOption = function()
    {
        if($scope.optionToAdd != ""){
            $scope.form.options.push($scope.optionToAdd);
        }
        $scope.optionToAdd = "";
    }

    $scope.removeItem = function(index)
    {
        $scope.form.options.splice(index, 1);
    }


}]);
/** Services **/
JarvisPlatform.factory('fieldsService', ['$http', function ($http) {

    service = {
        getFields: function (entity) {
            return $http({
                method: 'get',
                url: GLOBALS.site_url + '/api/core/entity/' + entity + '/fields',
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        },
        getFieldOptionsForm: function (type) {
            return $http({
                method: 'get',
                url: GLOBALS.site_url + '/api/core/field-type/' + type + '/form',
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        },
        createField: function (entity, form) {
            return $http({
                method: 'post',
                url: GLOBALS.site_url + '/api/core/entity/' + entity + '/fields',
                headers: {
                    'Content-Type': 'application/json'
                },
                data: form
            });
        },
        editField: function (entity, form) {
            return $http({
                method: 'put',
                url: GLOBALS.site_url + '/api/core/entity/' + entity + '/fields/' + window.field_id,
                headers: {
                    'Content-Type': 'application/json'
                },
                data: form
            });
        },
        deleteField: function(id)
        {
            return $http({
                method: 'delete',
                url: GLOBALS.site_url + '/api/core/entity/' + window.entity_id + '/fields/' + id,
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        },
        fieldsList: function (entity_id, $scope)
        {
            service.getFields(entity_id).success(function (data) {
                $scope.fields = data.data;
                $scope.fieldsConfig = {
                    group: 'ProfileFields',
                    animation: 150,
                    onSort: function (evt){
                        $models = [];
                        $(evt.models).each(function(x){
                            $models.push(evt.models[x].id);
                        });
                        service.reOrderFields($models);
                    }
                };
            });
        },
        deleteFieldAction: function(entity_id, id, callback)
        {
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
                    service.deleteField(id).success(function (data) {
                        swal("Eliminado!", "Se ha eliminado el campo!", "success");
                        callback();
                    }).error(HandleErrorResponse);
                });
        },
        reOrderFields: function(items)
        {
            $http({
                method: 'PUT',
                url: GLOBALS.site_url + '/api/core/entity/' + window.entity_id + '/order-fields',
                headers: {
                    'Content-Type': 'application/json'
                },
                data: {
                    items : items
                }
            }).error(HandleErrorResponse);
        }
    };
    return service;
}]);
