<?php

$JOB_ID = $_REQUEST['JOB_ID'];

require '../../../connect_oracle.php';

$s = oci_parse($c,"delete from JOB_TYPE where JOB_ID='$JOB_ID'");
$r = oci_execute($s);




echo json_encode(array('success'=>true));
?>