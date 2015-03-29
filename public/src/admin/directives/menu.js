define(['app'], function(app) {

    app.directive('topMenu', function(Auth) {

        return {
            restrict: 'E',
            scope: true,
            templateUrl: '/src/admin/views/directives/menu.html',
            controller: function($scope) {
                $scope.user = Auth.user();
            }
        }

    });

});