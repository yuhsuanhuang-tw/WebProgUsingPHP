<!DOCTYPE HTML>
<html lang="en-ca">
<head>
    <meta charset="UTF-8">
    <title>Save registration...</title>
</head>
<body>

<?php
//Get the form inputs
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$message = '';
$ok = true;

//validate the inputs
if(empty($username)) {
  // echo '<p><span class="nes-text is-error">Username is required</span></p>';
  $message = 'required';
  $ok = false;
}

if(empty($password)) {
  // echo '<p><span class="nes-text is-error">Password is required</span></p>';
  $message = 'required';
  $ok = false;
}

if($password != $confirm_password) {
  // echo '<p><span class="nes-text is-error">Password do not match</span></p>';
  $message = 'confirm-error';
  $ok = false;
}


require ('db.php');
$sql = "SELECT COUNT(*) AS count FROM users WHERE username = :username";
$cmd = $conn->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();
$user = $cmd->fetch();

if($user['count'] != '0') {
  $message = 'duplicate';
  $ok = false;
  var_dump($user);
}


if($ok) {
  //hash the password
  $password = password_hash($password, PASSWORD_DEFAULT);

  //set up and execute the insert
  //$conn = new PDO('mysql:host=127.0.0.1;dbname=Yu200443723', 'Yu200443723', '0KBPSTzFsH');
  $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
  $cmd = $conn->prepare($sql);
  $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
  $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
  $cmd->execute();
  $user = $cmd->fetch();

  //disconnect
  $conn = null;

  //show a message to the user
  // echo '<p><span class="nes-text is-success">User Saved</span></p>';

  header('location:login.php');
} else {
    // user not found

    //disconnect
    $conn = null;

    header('location:register.php?invalid=' . $message);
    exit();
}


?>
</body>
</html>