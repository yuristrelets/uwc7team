define(['app'], function(app) {
    'use strict';

    app.factory('Project', function($resource) {

        return $resource('/api/projects/:id', { id: '@id' });

    });

});