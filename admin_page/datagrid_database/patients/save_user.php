<?php

$ACCOUNT_ID = $_REQUEST['ACCOUNT_ID'];
$USERNAME = $_REQUEST['USERNAME'];
$PASSWORD = $_REQUEST['PASSWORD'];
$md5PASSWORD = md5($PASSWORD);

$SSN = $_REQUEST['SSN'];
$NAME = $_REQUEST['NAME'];
$SURNAME = $_REQUEST['SURNAME'];
$BLOOD_GROUP = $_REQUEST['BLOOD_GROUP'];
$GENDER = $_REQUEST['GENDER'];
$BIRTHDAY = $_REQUEST['BIRTHDAY'];
$HOSPITALSTAFFS_ID = $_REQUEST['HOSPITALSTAFFS_ID'];

require '../../../connect_oracle.php';

$s = oci_parse($c, "insert into patients(ACCOUNT_ID,USERNAME,PASSWORD,SSN,NAME,SURNAME,BLOOD_GROUP,GENDER,BIRTHDAY,HOSPITALSTAFFS_ID) 
					values('$ACCOUNT_ID','$USERNAME','$md5PASSWORD','$SSN','$NAME','$SURNAME','$BLOOD_GROUP','$GENDER',TO_DATE('$BIRTHDAY','MM/DD/YYYY'),'$HOSPITALSTAFFS_ID')");
$r = oci_execute($s);

echo json_encode(array(
	'ACCOUNT_ID' => $ACCOUNT_ID,
	'USERNAME' => $USERNAME,
	'PASSWORD' => $md5PASSWORD ,
	'SSN' => $SSN,
	'NAME' => $NAME,
	'SURNAME' => $SURNAME,
	'BLOOD_GROUP' => $BLOOD_GROUP,
	'GENDER' => $GENDER,
	'BIRTHDAY' => $BIRTHDAY,
	'HOSPITALSTAFFS_ID' => $HOSPITALSTAFFS_ID
));

?>