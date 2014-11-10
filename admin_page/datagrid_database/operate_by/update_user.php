<?php

$OPER_ID = $_REQUEST['OPER_ID'];
$HOSPITALSTAFF_ID = $_REQUEST['HOSPITALSTAFF_ID'];
$HOURS = $_REQUEST['HOURS'];

require '../../../connect_oracle.php';


$s = oci_parse($c, "update OPERATE_BY set HOURS='$HOURS' 
					where OPER_ID='$OPER_ID' and HOSPITALSTAFF_ID='$HOSPITALSTAFF_ID'");
$r = oci_execute($s,OCI_NO_AUTO_COMMIT);


if ($r){
	oci_commit($c); //*** Commit Transaction ***//
	echo json_encode(array(
		'OPER_ID' => $OPER_ID,
		'HOSPITALSTAFF_ID' => $HOSPITALSTAFF_ID,
		'HOURS' => $HOURS
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