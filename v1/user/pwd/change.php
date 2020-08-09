<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
//header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Methods:GET');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

require_once('../../includes/config.php');
require_once('../post.php');

$post= new Post($db);
//Json function
$data=json_decode(file_get_contents("php://input"));
//$post->NO=$data->NO;
$post->Account=$data->Account;
$post->Password=$data->Password;
$post->New_Password=$data->New_Password;

if ($post->update()) {
	$IsOK='true';
	echo json_encode(array('code'=>0,'message'=>'Update',"IsOK"=>$IsOK));
}else{
	$IsOK='false';
	echo json_encode(array('code'=>0,'message'=>'Update Wrong',"IsOK"=>$IsOK));	
}
?>