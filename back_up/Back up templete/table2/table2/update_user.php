<?php

//$id = intval($_REQUEST['id']);
$USERNAME = $_REQUEST['USERNAME'];
$PASSWORD = $_REQUEST['PASSWORD'];
$F_NAME = $_REQUEST['F_NAME'];
$L_NAME = $_REQUEST['L_NAME'];
$MD5_PASSWORD = md5($PASSWORD);

include 'conn.php';

//$sql = "update users set firstname='$firstname',lastname='$lastname',phone='$phone',email='$email' where id=$id";
//@mysql_query($sql);

$s = oci_parse($c, "update accounts set PASSWORD='$MD5_PASSWORD',F_NAME='$F_NAME',L_NAME='$L_NAME' where USERNAME='$USERNAME'");
$r = oci_execute($s);

echo json_encode(array(
	//'id' => $id,
	'USERNAME' => $USERNAME,
	'PASSWORD' => $MD5_PASSWORD,
	'F_NAME' => $F_NAME,
	'L_NAME' => $L_NAME
));
?>