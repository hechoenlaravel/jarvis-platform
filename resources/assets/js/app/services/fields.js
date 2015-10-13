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
        }
    };
}]);

