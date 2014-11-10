<?php

$RECU_ID = $_REQUEST['RECU_ID'];
$ID_NO = $_REQUEST['ID_NO'];
$START_REST = $_REQUEST['START_REST'];
$END_REST = $_REQUEST['END_REST'];

require '../../../connect_oracle.php';


$s = oci_parse($c, "update look_after set START_REST= TO_DATE('$START_REST','MM/DD/YYYY') 
									 , END_REST= TO_DATE('$END_REST','MM/DD/YYYY')
									 where RECU_ID='$RECU_ID'
									 and ID_NO='$ID_NO' ");
$r = oci_execute($s,OCI_NO_AUTO_COMMIT);


if ($r){
	oci_commit($c); //*** Commit Transaction ***//
	echo json_encode(array(
		'RECU_ID' => $RECU_ID,
		'ID_NO' => $ID_NO,
		'START_REST' => $START_REST,
		'END_REST' => $END_REST
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