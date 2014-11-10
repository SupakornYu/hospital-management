<?php

$USERNAME = $_REQUEST['USERNAME'];
$PASSWORD = $_REQUEST['PASSWORD'];
$F_NAME = $_REQUEST['F_NAME'];
$L_NAME = $_REQUEST['L_NAME'];
$MD5_PASSWORD = md5($PASSWORD);
include 'conn.php';

//$sql = "insert into users(USERNAME,PASSWORD,F_NAME,L_NAME) values('$USERNAME','$MD5_PASSWORD','$F_NAME','$L_NAME')";
//@mysql_query($sql);

$s = oci_parse($c, "insert into accounts(USERNAME,PASSWORD,F_NAME,L_NAME) values('$USERNAME','$MD5_PASSWORD','$F_NAME','$L_NAME')");
$r = oci_execute($s);

echo json_encode(array(
	//'id' => mysql_insert_id(),
	'USERNAME' => $USERNAME,
	'PASSWORD' => $MD5_PASSWORD,
	'F_NAME' => $F_NAME,
	'L_NAME' => $L_NAME
));

?>