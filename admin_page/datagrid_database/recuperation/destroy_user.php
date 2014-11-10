<?php

$RECU_ID = $_REQUEST['RECU_ID'];


require '../../../connect_oracle.php';

$s = oci_parse($c,"delete from RECUPERATION where RECU_ID='$RECU_ID'");
$r = oci_execute($s);




echo json_encode(array('success'=>true));
?>