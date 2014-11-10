<?php

$USERNAME = $_REQUEST['USERNAME'];


require '../../../connect_oracle.php';

$s = oci_parse($c,"delete from HOSPITAL_STAFFS where USERNAME='$USERNAME'");
$r = oci_execute($s);




echo json_encode(array('success'=>true));
?>