<?php
$con = mysqli_connect("localhost","046754342_honest","DJyCKaMy+8Lj","9054122433_honest");
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$sql = "SELECT * FROM my_users WHERE id = '".$_SESSION['user_id']."'";
$result = mysqli_query($con, $sql);

$arr = mysqli_fetch_assoc($result);

?>


<?php 
// $host      = 'localhost'; // Доступ к хосту, обычно - localhost
// $user      = 'root'; // Логин от базы данных
// $password  = ''; // Пароль от базы данных
// $db        = 'honest'; // Имя базы данных

// $connect = mysqli_connect($host, $user, $password);
// $select = "SELECT * FROM my_users WHERE id = '".$_SESSION['user_id']."'";
// mysqli_query($connect, "SET NAMES utf8");

// $q_s = mysqli_query($connect, $select);
// var_dump($new);
// $arr = mysqli_fetch_assoc($q_s);
?>