define(['app'], function(app) {
    'use strict';

    app.controller('AuthController',
        function($scope, $state, Auth) {
            angular.extend($scope, {
                model: {},
                error: false
            });

            $scope.login = function() {
                $scope.error = false;

                Auth.login($scope.model)
                    .then(
                        function() { $state.go('app.index'); },
                        function() { $scope.error = true; }
                    );
            }

        }
    );

});