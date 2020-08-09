<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('init.php');
$post= new Post($db);
//Json function
$data=json_decode(file_get_contents("php://input"));
$post->Account=$data->Account;
$post->Password=$data->Password;

if ($post->create()) {
	$IsOK='true';
	echo json_encode(array('code'=>0,'message'=>'Create Done',"IsOK"=>$IsOK));
}else{
	$IsOK='false';
	echo json_encode(array('code'=>0,'message'=>'Create Wrong',"IsOK"=>$IsOK));	
}
?>