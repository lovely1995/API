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
//$post->NO=$data->NO;

if ($post->remove()) {
	$IsOK='true';
	echo json_encode(array('code'=>0,'message'=>'Delete','IsOK'=>$IsOK));
}else{
	$IsOK='false';
	echo json_encode(array('code'=>0,'message'=>'Delete Wrong','IsOK'=>$IsOK));	
}
?>