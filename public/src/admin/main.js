require.config({
    "baseUrl": "/src/admin",

    "paths": {
        "jquery": "../vendor/jquery/dist/jquery",
        "angular": "../vendor/angular/angular.min",
        "angular-resource": "../vendor/angular-resource/angular-resource.min",
        "angular-bootstrap": "../vendor/angular-bootstrap/ui-bootstrap.min",
        "angular-bootstrap-tpls": "../vendor/angular-bootstrap/ui-bootstrap-tpls.min",
        "ui-router": "../vendor/ui-router/release/angular-ui-router.min"
    },

    "shim": {
        "angular": {
            "exports": "angular",
            "deps": ["jquery"]
        },
        "angular-resource": {
            "deps": ["angular"]
        },
        "angular-bootstrap": {
            "deps": ["angular"]
        },
        "angular-bootstrap-tpls": {
            "deps": ["angular-bootstrap"]
        },
        "ui-router": {
            "deps": ["angular"]
        }
    },

    "deps": ["bootstrap"]
});
