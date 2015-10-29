JarvisPlatform.controller('LoginController', ['$scope', 'loginService', function ($scope, loginService) {
    $scope.form = {};
    $scope.forgotPassword = function()
    {
        swal({
            title: "Recuperar contraseña",
            text: "Por favor ingrese el Email de su usuario:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Email",
            showLoaderOnConfirm: true
        }, function(inputValue){
            if (inputValue === false)
                return false;
            if (inputValue === "")
            {
                swal.showInputError("Ingrese el Email");
                return false
            }
            $r = loginService.resetPassword({
                'email': inputValue
            }).success(function(data){
                swal("Listo! Verifique su correo electrónico para instrucciones sobre como recuperar su contraseña.");
            }).error(HandleErrorResponse);
        });
    }
}]);

JarvisPlatform.factory('loginService', ['$http', function($http){
    return {
        resetPassword : function(form)
        {
            form._token = GLOBALS.token;
            return $http({
                method: 'post',
                url: GLOBALS.site_url+'/api/users/forgot-password',
                headers: {
                    'Content-Type' : 'application/json'
                },
                data: form
            });
        }
    };
}]);