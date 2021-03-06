<!DOCTYPE HTML>
<html lang="en-ca">
<head>
    <meta charset="UTF-8">
    <title>Validate</title>

    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />

    <link href="style.css" rel="stylesheet" />
</head>
<body>

<h1>Validate</h1>

<p class="title">Messages: </p>
<div class="nes-container with-title">

    <?php
    // store the inputs & hash the password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // connect
    //$conn = new PDO('mysql:host=127.0.0.1;dbname=Yu200443723', 'Yu200443723', '0KBPSTzFsH');
    require('db.php');

    // write the query
    $sql = "SELECT * FROM users WHERE username = :username";

    // create the command, run the query and store the result
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

    // if count is 1, we found a matching username in the database.  Now check the password
    if (password_verify($password, $user['password'])) {
        // user found
        session_start();
        $_SESSION['user_id'] = $user['user_id'];
        header('location:menu.php');
    }
    else {
        // user not found
        header('location:login.php?invalid=true');
        exit();
    }

    //disconnect
    $conn = null;
    ?>
</div>
</body>
</html>