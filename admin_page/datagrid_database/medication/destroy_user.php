<?php

$MED_ID = $_REQUEST['MED_ID'];

require '../../../connect_oracle.php';

$s = oci_parse($c,"delete from medication where MED_ID='$MED_ID'");
$r = oci_execute($s);




echo json_encode(array('success'=>true));
?>