<?php

$BILL_ID = $_REQUEST['BILL_ID'];
$MED_ID = $_REQUEST['MED_ID'];
$ALL_COST = $_REQUEST['ALL_COST'];
$PAYING_STATUS = $_REQUEST['PAYING_STATUS'];

require '../../../connect_oracle.php';


$s = oci_parse($c, "update BILL set MED_ID='$MED_ID' 
								, ALL_COST='$ALL_COST' 
								, PAYING_STATUS='$PAYING_STATUS' 
								where BILL_ID='$BILL_ID'");
$r = oci_execute($s,OCI_NO_AUTO_COMMIT);


if ($r){
	oci_commit($c); //*** Commit Transaction ***//
	echo json_encode(array(
		'BILL_ID' => $BILL_ID,
		'MED_ID' => $MED_ID,
		'ALL_COST' => $ALL_COST,
		'PAYING_STATUS' => $PAYING_STATUS
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