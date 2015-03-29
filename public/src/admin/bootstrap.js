define([
    'angular',
    'app',
    'configure'
], function(angular) {
    'use strict';

    angular.element(document).ready(function() {
        angular.bootstrap(document, ['admin']);
    });

});