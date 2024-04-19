<?php
include "config.php";
$connect = new PDO("mysql:host=$host;dbname=$database", $usrname, $pass);
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $id = $_GET['id'];

  $select = $connect->query("SELECT * FROM $table WHERE id=$id");
  $result = $select->fetch();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $connect = new PDO("mysql:host=$host;dbname=$database", $usrname, $pass);
  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $fullname = filter($_POST["fullName"]);
  $username = filter($_POST["username"]);
  $email =  filter($_POST["email"]);
  $password = filter($_POST["password"]);
  $id = $_POST["id"];

  $update = $connect->prepare("UPDATE $usertable SET fullName=:fullName, username=:username, email=:email, password=:password WHERE id=:id");
  $update->bindParam(":fullName", $fullname);
  $update->bindParam(":username", $username);
  $update->bindParam(":email", $email);
  $update->bindParam(":password", $password);
  $update->bindParam(":id", $id);
  $update->execute();
  header("location:table.php");
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
  <form method="POST" action="">
    <h1>Edit <span><?php echo $result["username"] ?></span>'s user info :</h1>
    <input type="hidden" name="id" value="<?php echo $result["id"] ?>">
    <input type="text" name="fullName" value="<?php echo $result["fullName"] ?>">
    <input type="text" name="username" value="<?php echo $result["username"] ?>">
    <input type="text" name="email" value="<?php echo $result["email"] ?>">
    <input type="text" name="password" value="<?php echo $result["password"] ?>">
    <input type="submit">
  </form>
</body>

</html>