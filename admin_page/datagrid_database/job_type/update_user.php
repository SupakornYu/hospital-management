<?php

$JOB_ID = $_REQUEST['JOB_ID'];
$JOB_NAME = $_REQUEST['JOB_NAME'];

require '../../../connect_oracle.php';


$s = oci_parse($c, "update JOB_TYPE set JOB_NAME='$JOB_NAME' where JOB_ID='$JOB_ID'");
$r = oci_execute($s,OCI_NO_AUTO_COMMIT);


if ($r){
	oci_commit($c); //*** Commit Transaction ***//
	echo json_encode(array(
		'JOB_ID' => $JOB_ID,
		'JOB_NAME' => $JOB_NAME
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