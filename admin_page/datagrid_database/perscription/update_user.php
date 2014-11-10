<?php

$PER_ID = $_REQUEST['PER_ID'];
$MEDICINE_DETAIL = $_REQUEST['MEDICINE_DETAIL'];

require '../../../connect_oracle.php';


$s = oci_parse($c, "update perscription set MEDICINE_DETAIL='$MEDICINE_DETAIL' 
										where PER_ID='$PER_ID'");
$r = oci_execute($s,OCI_NO_AUTO_COMMIT);


if ($r){
	oci_commit($c); //*** Commit Transaction ***//
	echo json_encode(array(
		'PER_ID' => $PER_ID,
		'MEDICINE_DETAIL' => $MEDICINE_DETAIL
	));
} else {
	oci_rollback($c); //*** RollBack Transaction ***//
	
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
oci_close($c);

/* echo json_encode(array(
	'PER_ID' => $PER_ID,
	'MEDICINE_DETAIL' => $MEDICINE_DETAIL
)); */
?>