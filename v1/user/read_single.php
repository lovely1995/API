<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');

include_once('init.php');
$post= new Post($db);
//url function
$post->NO=isset($_GET['NO']) ? $_GET['NO'] : die() ;
$post->Password=isset($_GET['Password']) ? $_GET['Password'] : die() ;
$post->read_single();
$post_arr=array(
	'NO'=>$post->NO,
	'Account'=>$post->Account,
	'Password'=>$post->Password,
);

print_r(json_encode($post_arr));


?>