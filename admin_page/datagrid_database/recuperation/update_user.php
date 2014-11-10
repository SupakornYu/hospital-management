<?php

$RECU_ID = $_REQUEST['RECU_ID'];
$STATUS = $_REQUEST['STATUS'];
$START_REST = $_REQUEST['START_REST'];
$END_REST = $_REQUEST['END_REST'];
$MED_ID = $_REQUEST['MED_ID'];

require '../../../connect_oracle.php';


$s = oci_parse($c, "update RECUPERATION set STATUS='$STATUS' 
										, START_REST=TO_DATE('$START_REST','MM/DD/YYYY')
										, END_REST=TO_DATE('$END_REST','MM/DD/YYYY') 
										, MED_ID='$MED_ID' 
										where RECU_ID='$RECU_ID'");
$r = oci_execute($s,OCI_NO_AUTO_COMMIT);


if ($r){
	oci_commit($c); //*** Commit Transaction ***//
	echo json_encode(array(
		'RECU_ID' => $RECU_ID,
		'STATUS' => $STATUS,
		'START_REST' => $START_REST,
		'END_REST' => $END_REST,
		'MED_ID' => $MED_ID
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