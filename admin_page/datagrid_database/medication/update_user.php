<?php

$MED_ID = $_REQUEST['MED_ID'];
$PA_ID = $_REQUEST['PA_ID'];
$DETAIL = $_REQUEST['DETAIL'];
$PER_ID = $_REQUEST['PER_ID'];
$STATUS = $_REQUEST['STATUS'];

require '../../../connect_oracle.php';


$s = oci_parse($c, "update medication set PA_ID='$PA_ID' 
									 , DETAIL='$DETAIL' 
									 , PER_ID='$PER_ID' 
									 , STATUS='$STATUS'
									 , TIMESTAMP=(select systimestamp from dual)
									 where MED_ID='$MED_ID'");
$r = oci_execute($s,OCI_NO_AUTO_COMMIT);


if ($r){
	oci_commit($c); //*** Commit Transaction ***//
	echo json_encode(array(
		'MED_ID' => $MED_ID,
		'PA_ID' => $PA_ID,
		'DETAIL' => $DETAIL,
		'PER_ID' => $PER_ID,
		'STATUS' => $STATUS
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