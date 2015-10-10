JarvisPlatform.controller('UsersController', ['$scope', 'usersService', '$anchorScroll', function($scope, usersService, $anchorScroll) {
    $scope.form = {};
    $scope.nextPage = 1;
    $scope.NoResults = 0;
    $scope.hasMoreResults = false;
    $scope.current_page = 1;

    $scope.searchUsers = function()
    {
        $('#usersSearchButton').button('loading');
        usersService.getUsers($scope.form, 1).success(handleUsersSuccess);
    }

    $scope.loadNext = function()
    {
        $('#usersSearchButton').button('loading');
        usersService.getUsers($scope.form, $scope.nextPage).success(handleUsersSuccess);
    }

    $scope.loadPrevious = function()
    {
        $('#usersSearchButton').button('loading');
        usersService.getUsers($scope.form, $scope.current_page - 1).success(handleUsersSuccess);
    }

    $scope.reset = function()
    {
        $scope.form = {};
        $scope.searchUsers();
    }

    function handleUsersSuccess(data, status)
    {
        $scope.loading = 0;
        $scope.NoResults = 1;
        if(data.meta.pagination.count > 0)
        {
            $scope.NoResults = 0;
            $scope.hasMoreResults = false;
            if(data.meta.pagination.links.next !== undefined)
            {
                $scope.hasMoreResults = true;
                $scope.nextPage = data.meta.pagination.current_page + 1;
                $scope.prevPage = data.meta.pagination.current_page - 1;
            }
            $scope.current_page = data.meta.pagination.current_page;
            $scope.total_pages = data.meta.pagination.total_pages;
            $scope.total = data.meta.pagination.total;
        }
        $scope.results = data.data;
        $('#usersSearchButton').button('reset');
        $anchorScroll('resultsBox');
    }
}]);

JarvisPlatform.factory('usersService', ['$http', function($http){
    return {
        getUsers : function(form, page)
        {
            form._token = GLOBALS.token;
            return $http({
                method: 'post',
                url: GLOBALS.site_url+'/api/users/find-users/?page='+page,
                headers: {
                    'Content-Type' : 'application/json'
                },
                data: form
            });
        }
    };
}]);