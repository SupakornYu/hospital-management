<?php

$PER_ID = $_REQUEST['PER_ID'];

require '../../../connect_oracle.php';

$s = oci_parse($c,"delete from perscription where PER_ID='$PER_ID'");
$r = oci_execute($s);




echo json_encode(array('success'=>true));
?>