<?php
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

/**
//Read SQL
$db=mysqli_connect("localhost","root","") or die("無法連結");
mysqli_select_db($db,'test') or die("can't open the database");
mysqli_query($db,'SET CHARACTER SET utf8');
mysqli_query($db, "SET collation connection='utf_general_ci");

$read_title_name="SELECT * FROM `member`";
$read_name=mysqli_query($db,$read_title_name);
while ($tmenu=mysqli_fetch_assoc($read_name)){
echo $tmenu['Account'];
}
**/
?>