define([
    'app',

    'services/auth',
    'services/storage',

    'models/projects',

    'controllers/auth',
    'controllers/index',
    'controllers/projects',

    'directives/menu'

], function(app) {
    'use strict';

    app.config(
        function($httpProvider) {
            $httpProvider.interceptors.push(
                function($rootScope, $q, $injector) {
                    return {
                        responseError: function(rejection) {
                            var $state = $injector.get('$state');

                            if($state.current.name !== 'auth.login') {
                                switch (rejection.status) {
                                    case 401:
                                        var deferred = $q.defer();
                                        $rootScope.$broadcast('auth:loginRequired', rejection);
                                        return deferred.promise;

                                    case 403:
                                        $rootScope.$broadcast('auth:forbidden', rejection);
                                        break;
                                }
                            }

                            return $q.reject(rejection);
                        }
                    };
                }
            );
        }
    );

    app.config(
        function($stateProvider, $urlRouterProvider) {

            $stateProvider
                .state('auth', {
                    url: '/auth',
                    abstract: true,
                    template: '<ui-view/>'
                })
                .state('auth.login', {
                    url: '/login',
                    templateUrl: '/src/admin/views/auth/login.html',
                    controller: 'AuthController'
                })
                .state('auth.logout', {
                    url: '/logout',
                    onEnter: function(Auth) {
                        Auth.logout();
                    }
                });

            $stateProvider
                .state('app', {
                    data: { protect: true },
                    templateUrl: '/src/admin/views/layouts/main.html'
                })
                .state('app.index', {
                    url: '/',
                    templateUrl: '/src/admin/views/index.html',
                    controller: 'IndexController'
                })
                .state('app.projects', {
                    url: '/projects',
                    templateUrl: '/src/admin/views/projects.html',
                    controller: 'ProjectController',
                    resolve: {
                        projects: function(Project) {
                            return Project.query({}).$promise;
                        }
                    }
                });

            $urlRouterProvider.otherwise('/');
        }
    );

    app.run(function($rootScope, $state, Auth) {

        $rootScope.$on("$stateChangeStart", function(e, next) {
            if(next.data && next.data.protect && !Auth.check()) {
                console.log('======================');
                e.preventDefault();
                $state.go('auth.login');
            }
        });

        $rootScope.$on('auth:logout', function() {
            $state.go('auth.login');
        });

        Auth.init();

    });

});