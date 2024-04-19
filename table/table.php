<?php
include "config.php";

$con = new PDO("mysql:host=$host;dbname=$database", $usrname, $pass);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$select = $con->prepare("SELECT * FROM $table");
$select->execute();
$result = $select->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="table.css">
</head>

<body>
  <section>
    <a class='add' href='add.php'>Add user</a>
    <table>
      <tr>
        <td class='tt'>ID</td>
        <td class='tt'>FullName</td>
        <td class='tt'>Username</td>
        <td class='tt'>Email</td>
        <td class='tt'>Password</td>
        <td class='tt'>Edit</td>
        <td class='tt'>Delete</td>
      </tr>
      <?php
      foreach ($result as $v) {
      ?>
        <tr>
          <td><?php echo $v["id"] ?></td>
          <td><?php echo $v["fullName"] ?></td>
          <td><?php echo $v["username"] ?></td>
          <td><?php echo $v["email"] ?></td>
          <td><?php echo $v["password"] ?></td>
          <td><a class='edit' href='edit.php?id=<?php echo $v["id"] ?>'>Edit</a></td>
          <td><a class='delete' href='delete.php?id=<?php echo $v["id"] ?>'>Delete</a></td>
        </tr>
      <?php
      }
      ?>
    </table>
  </section>
</body>

</html>