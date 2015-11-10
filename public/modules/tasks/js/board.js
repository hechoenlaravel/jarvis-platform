JarvisPlatform.controller('BoardController', ['$scope', 'BoardService', function ($scope, BoardService) {

    console.log(window.board);

    $scope.board = window.board;

}]);
/** Services **/
JarvisPlatform.factory('BoardService', ['$http', function ($http) {

    service = {
        getTasks : function(form)
        {

        }
    };
    return service;
}]);
