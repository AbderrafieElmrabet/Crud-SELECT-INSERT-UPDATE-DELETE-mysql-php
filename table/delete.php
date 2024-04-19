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

  $id = $_POST["id"];

  $update = $connect->prepare("DELETE FROM $usertable WHERE id=:id");
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
    <h1>Are you sure you want to delete <span><?php echo $result["username"] ?></span>'s user info? :</h1>
    <input type="hidden" name="id" value="<?php echo $result["id"] ?>">
    <input type="submit">
  </form>
</body>

</html>