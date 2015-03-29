define(['angular', 'app'], function(angular, app) {
    'use strict';

    var USER_KEY = 'adminuser';

    app.factory('Auth', function($rootScope, Storage, $resource) {

        var _currentUser = null,
            _resource = $resource('/api/auth/:id', {}, {
                login: { method: 'POST' },
                logout: { method: 'DELETE' }
            });

        function _init() {
            if(Storage.has(USER_KEY)) {
                _currentUser = Storage.get(USER_KEY);
            }

            return !!_currentUser;
        }

        function _login(credentials) {
            return _resource
                .login(credentials)
                .$promise
                .then(_setUser);
        }

        function _setUser(user) {
            _currentUser = user;
            Storage.set(USER_KEY, user);

            return user;
        }

        function _logout() {
            return _resource
                .logout({ id: _currentUser.id })
                .$promise
                .then(function() {
                    _currentUser = null;
                    Storage.remove(USER_KEY);

                    $rootScope.$emit('auth:logout');
                });
        }

        function _check() {
            return !!_currentUser;
        }

        function _user() {
            return _currentUser;
        }

        return {
            init: _init,
            check: _check,
            user: _user,
            login: _login,
            logout: _logout
        };

    });

});