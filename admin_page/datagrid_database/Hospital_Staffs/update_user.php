<?php

require '../../../connect_oracle.php';


$ACCOUNT_ID = $_REQUEST['ACCOUNT_ID'];
$USERNAME = $_REQUEST['USERNAME'];
$PASSWORD = $_REQUEST['PASSWORD'];
$md5PASSWORD = md5($PASSWORD);

$SSN = $_REQUEST['SSN'];
$NAME = $_REQUEST['NAME'];
$SURNAME = $_REQUEST['SURNAME'];
$JOB_ID = $_REQUEST['JOB_ID'];
$SALARY = $_REQUEST['SALARY'];
$START_CONTRACT = $_REQUEST['START_CONTRACT'];
$END_CONTRACT = $_REQUEST['END_CONTRACT'];





$s = oci_parse($c, "update HOSPITAL_STAFFS
						set USERNAME='$USERNAME' 
						, PASSWORD='$md5PASSWORD'
						, SSN='$SSN' 
						, NAME='$NAME' 
						, SURNAME='$SURNAME'
						, JOB_ID='$JOB_ID' 
						, SALARY='$SALARY' 
						, START_CONTRACT = TO_DATE('$START_CONTRACT','MM/DD/YYYY')
						, END_CONTRACT= TO_DATE('$END_CONTRACT','MM/DD/YYYY')
						
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
		'JOB_ID' => $JOB_ID,
		'SALARY' => $SALARY,
		'START_CONTRACT' => $START_CONTRACT,
		'END_CONTRACT' => $END_CONTRACT
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