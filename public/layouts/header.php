<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="http://fonts.googleapis.com/css?family=Reenie+Beanie:regular" 
          rel="stylesheet"
          type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" 
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" 
          crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="<?php echo url('assets/css/index.css') ?>">
    <title><?php echo isset($title) ? $title : 'Home'; ?> | <?php echo getConfig('APP_NAME', 'Life System') ?></title>
</head>
