<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');

include_once('init.php');
$post= new Post($db);

//Json function
$data=json_decode(file_get_contents("php://input"));
//json test
//$data=json_decode(file_get_contents("login_test.json"));

$post->Account=$data->Account;
$post->Password=$data->Password;

if ($post->login_check()) {
	http_response_code(200);
	echo json_encode(array('code'=>0,'message'=>'Login Success'));
}else{
	http_response_code(400);
	echo json_encode(array('code'=>2,'message'=>'Login Failed'));	
}




?>