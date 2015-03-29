define(['app'], function(app) {
    'use strict';

    app.controller('ProjectController',
        function($scope, projects) {
            angular.extend($scope, {
                projects: projects
            });

            $scope.remove = function(project) {
                if(confirm('Are you sure?')) {
                    project.$remove();
                }
            }
        }
    );

});