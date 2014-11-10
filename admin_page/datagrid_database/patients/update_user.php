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


$s = oci_parse($c, "update patients 
						set USERNAME='$USERNAME' 
						, PASSWORD='$md5PASSWORD'
						, SSN='$SSN' 
						, NAME='$NAME' 
						, SURNAME='$SURNAME'
						, BLOOD_GROUP='$BLOOD_GROUP'  
						, GENDER='$GENDER'
						, BIRTHDAY=TO_DATE('$BIRTHDAY','MM/DD/YYYY')
						, HOSPITALSTAFFS_ID='$HOSPITALSTAFFS_ID' 
						where ACCOUNT_ID='$ACCOUNT_ID'");
$r = oci_execute($s,OCI_NO_AUTO_COMMIT);


if ($r){
	oci_commit($c); //*** Commit Transaction ***//
	echo json_encode(array(
		'ACCOUNT_ID' => $ACCOUNT_ID,
		'USERNAME' => $USERNAME,
		'PASSWORD' => $md5PASSWORD,
		'SSN' => $SSN,
		'NAME' => $NAME,
		'SURNAME' => $SURNAME,
		'BLOOD_GROUP' => $BLOOD_GROUP,
		'GENDER' => $GENDER,
		'BIRTHDAY' => $BIRTHDAY,
		'HOSPITALSTAFFS_ID' => $HOSPITALSTAFFS_ID
	));
} else {
	oci_rollback($c); //*** RollBack Transaction ***//
	
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
oci_close($c);

/* echo json_encode(array(
	'JOB_ID' => $JOB_ID,
	'JOB_NAME' => $JOB_NAME
)); */
?>