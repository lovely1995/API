<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');
include_once('init.php');

$post= new Post($db);
$result=$post->read();//catch other .php data
$num=$result->rowCount();
//echo $num;

if ($num >0) {
	$post_arr=array();
	$post_arr['data']=array();
	while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$post_item=array(
			'No' => $NO,
			'Account' => $Account,
			'Password' => $Password
		);
		array_push($post_arr['data'],$post_item);
		echo json_encode($post_item);
	}
}else{
	echo json_encode(array('Message' => 'No Post.'));
}
?>