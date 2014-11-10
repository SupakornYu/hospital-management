<?php

$BILL_ID = $_REQUEST['BILL_ID'];


require '../../../connect_oracle.php';

$s = oci_parse($c,"delete from BILL where BILL_ID='$BILL_ID'");
$r = oci_execute($s);




echo json_encode(array('success'=>true));
?>