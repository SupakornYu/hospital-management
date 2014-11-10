<?php

$ROOM_ID = $_REQUEST['ROOM_ID'];
$ROOM_TYPE = $_REQUEST['ROOM_TYPE'];
$AVAILABLE_STATUS = $_REQUEST['AVAILABLE_STATUS'];
$RECU_ID = $_REQUEST['RECU_ID'];

require '../../../connect_oracle.php';


$s = oci_parse($c, "update ROOM set ROOM_TYPE='$ROOM_TYPE' , AVAILABLE_STATUS='$AVAILABLE_STATUS' 
					, RECU_ID='$RECU_ID'  where ROOM_ID='$ROOM_ID'");
$r = oci_execute($s,OCI_NO_AUTO_COMMIT);


if ($r){
	oci_commit($c); //*** Commit Transaction ***//
	echo json_encode(array(
		'ROOM_ID' => $ROOM_ID,
		'ROOM_TYPE' => $ROOM_TYPE,
		'AVAILABLE_STATUS' => $AVAILABLE_STATUS,
		'RECU_ID' => $RECU_ID
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