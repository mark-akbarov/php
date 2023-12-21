<?php include "../config/db.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Blog</title>
</head>
<body>    
    <nav class="navbar bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark"">
    <div class="container-fluid">
        <a href="list.php" class="navbar-brand">Blog</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="create.php">Create +</a>
            </li>
        </ul>
        <form method="POST" action="search.php" class="d-flex" role="search">
            <input class="form-control me-2" name="title" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary" type="search">Search</button>
        </form>
    </div>
    </nav>
    <div class="container">
    