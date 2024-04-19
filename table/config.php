<?php
function filter($check)
{
  $check =  htmlspecialchars($check);
  $check = trim($check);
  $check = stripslashes($check);
  return $check;
}

$host = "localhost";
$database = "loginforms";
$table = "users";
$usrname = "root";
$pass = "";