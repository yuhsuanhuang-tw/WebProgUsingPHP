<?php
// access the current session
session_start();

// check if there is a user identity stored in the session object
if (empty($_SESSION['user_id'])) {
    // if there is no user_id in the session, redirect the user to the login page
    header('location:login.php');
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="en-ca">
<head>
    <meta charset="UTF-8">
    <title>Movie</title>

    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />

    <link href="style.css" rel="stylesheet" />
</head>
<body>

<header>
    <div class="back_color">
        <div class="text_center">
            <a class="nes-btn" href="menu.php">Home</a>
            <a class="nes-btn" href="movies.php">Movies</a>
            <a class="nes-btn" href="movie.php">Add movie</a>
            <a class="nes-btn is-error" href="logout.php">Logout</a>
        </div>
    </div>
</header>

<main class="container text_center">

    <h1>COMP1006 Application</h1>
    <img src="jakob-owens-CiUR8zISX60-unsplash.jpg">

</main>

</body>
</html>