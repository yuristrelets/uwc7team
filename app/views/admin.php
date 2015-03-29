<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="/src/vendor/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/src/styles/admin.css">
</head>
<body>
    <div class="container">
        <div ui-view></div>
    </div>

    <script src="/src/vendor/requirejs/require.js" data-main="/src/admin/main.js"></script>
</body>
</html>