<?php

$OPER_ID = $_REQUEST['OPER_ID'];
$MED_ID = $_REQUEST['MED_ID'];
$STATUS = $_REQUEST['STATUS'];
$OPERATION_DATE = $_REQUEST['OPERATION_DATE'];

require '../../../connect_oracle.php';


$s = oci_parse($c, "update OPERATION set MED_ID='$MED_ID' 
									 , STATUS='$STATUS' 
									 , OPERATION_DATE=TO_DATE('$OPERATION_DATE','MM/DD/YYYY')
									 where OPER_ID='$OPER_ID'");
$r = oci_execute($s,OCI_NO_AUTO_COMMIT);


if ($r){
	oci_commit($c); //*** Commit Transaction ***//
	echo json_encode(array(
		'OPER_ID' => $OPER_ID,
		'MED_ID' => $MED_ID,
		'STATUS' => $STATUS,
		'OPERATION_DATE' => $OPERATION_DATE
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