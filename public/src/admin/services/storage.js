define(['angular', 'app'], function(angular, app) {
    'use strict';

    app.service('Storage', function() {

        function _get(key) {
            return angular.fromJson(window.localStorage.getItem(key));
        }

        function _has(key) {
            return !!window.localStorage.getItem(key);
        }

        function _set(key, value) {
            window.localStorage.setItem(key, angular.toJson(value));
        }

        function _remove(key) {
            window.localStorage.removeItem(key);
        }

        function _clear() {
            window.localStorage.clear();
        }

        return {
            'get': _get,
            'has': _has,
            'set': _set,
            'remove': _remove,
            'clear': _clear
        };

    });

});