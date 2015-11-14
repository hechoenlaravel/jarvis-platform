JarvisPlatform.controller('BoardController', ['$scope', 'BoardService', function ($scope, BoardService) {

    $scope.board = window.board;

    $scope.nextPage = 1;
    $scope.NoResults = 0;
    $scope.hasMoreResults = false;
    $scope.current_page = 1;

    $scope.tasksParameters = {
        page: $scope.current_page,
        limit: 30
    }

    $scope.searchTasks = function()
    {
        $scope.getTasks();
    }

    $scope.getTasks = function()
    {
        $('#tasksSearchButton').button('loading');
        BoardService.getTasks($scope.board.data, $scope.tasksParameters).success($scope.handleTasksQuerySuccess).error(HandleErrorResponse);
    }

    $scope.handleTasksQuerySuccess = function(data)
    {
        $('#tasksSearchButton').button('reset');
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
        }else{
            $scope.total = 0;
        }
        $scope.tasks = data.data;
    }

}]);
/** Services **/
JarvisPlatform.factory('BoardService', ['$http', function ($http) {

    service = {
        getTasks : function(board, parameters)
        {
            return $http({
                method: 'post',
                url: GLOBALS.site_url+'/api/tasks/boards/'+board.uuid+'/tasks/?include=user,users,step',
                headers: {
                    'Content-Type' : 'application/json'
                },
                data: parameters
            });
        }
    };
    return service;
}]);
