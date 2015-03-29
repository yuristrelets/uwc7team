define('app', [
    'angular',
    'angular-resource',
    'ui-router',
    'angular-bootstrap',
    'angular-bootstrap-tpls'
], function(angular) {
    'use strict';

    var dependencies = [
        'ngResource',
        'ui.router',
        'ui.bootstrap'
    ];

    return angular.module('admin', dependencies);

});