<?php
require_once 'functions.php';
require_once 'config.php';

if (!empty(SITE_ROOT)) {
    $url_path = "/" . SITE_ROOT . "/";
} else {
    $url_path = "/";
}

?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" ,initial-scale=1">
    <title>PHP Blog</title>

    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

</head>

<body>
    <div class="navbar navbar-expand-md navbar-dark bg-primary bg-gradient mb-8 fixed-top" role="navigation">
        <h2><a class="navbar-brand" href="#"><b>NITRBlog</b></a></h2>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-5 mr-auto">
                <li class="nav-item active">
                    <!-- <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a> -->
                    <a href="/<?= SITE_ROOT ?>" class="nav-link">Home</a>
                </li>
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<li class='nav-item active'><a href='" . $url_path . "new.php' class='nav-link'>New Post</a></li>";
                    echo "<li class='nav-item active'><a href='" . $url_path . "admin.php' class='nav-link'>Admin Panel</a></li>";
                    echo "<li class='nav-item active'><a href='" . $url_path . "logout.php' class='nav-link'>Logout</a></li>";
                } else {
                    echo "<li class='nav-item active'><a href='" . $url_path . "login.php' class='nav-link' >Sign In</a></li>";
                    echo "<li class='nav-item active'><a href='" . $url_path . "registration.php' class='nav-link' >Sign Up</a></li>";
                }
                ?>
            </ul>
            <form action="<?= $url_path ?>search.php" method="GET" class="form-inline mt-2 mt-md-0">
                <input type="text" name="q" class="form-control mr-sm-2" placeholder="Search" aria-label="Search">
                <button type="submit" class="btn btn-light my-2 my-sm-0">Search</button>
            </form>
        </div>
    </div>

    <div style="margin-bottom: 80px;">

    </div>