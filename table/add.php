<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "config.php";

  if (!empty($_POST["fullName"])) {
    $fullname = $_POST["fullName"];
  } else {
    die("namempty");
  }

  if (!empty($_POST["username"])) {
    $username = $_POST["username"];
  } else {
    die("userempty");
  }

  if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $email = $_POST["email"];
  } else {
    die("invalidemail");
  }

  if (!empty($_POST["password"])) {
    $password = $_POST["password"];
  } else {
    die("passempty");
  }

  try {
    $con = new PDO("mysql:host=$host;dbname=$database", $usrname, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $select = $con->query("SELECT username, email FROM $table WHERE username='$username' OR email='$email'");
    $result = $select->fetch();

    if (empty($result)) {
      $sql = "INSERT INTO $table (fullName, username, email, password) VALUES (:fullName, :username, :email, :password)";
      $insert = $con->prepare($sql);
      $insert->bindParam(":fullName", $fullname);
      $insert->bindParam(":username", $username);
      $insert->bindParam(":email", $email);
      $insert->bindParam(":password", $password);
      $insert->execute();
      header("location:table.php");

      echo "User added";
    } else {
      echo "username or email already exist!";
    }
  } catch (PDOException $e) {
    echo "error" . $e;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Add a new user account :</h1>
  <form action="" method="POST">
    <input type="text" name="fullName" id="fullname" placeholder="Full name">
    <input type="text" name="username" id="username" placeholder="Username">
    <input type="text" name="email" id="email" placeholder="Email">
    <input type="password" name="password" id="password" placeholder="Password">
    <input type="submit" name="submit" id="submit" value="Add user">
  </form>
</body>

</html>