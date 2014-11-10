<?php

$OPER_ID = $_REQUEST['OPER_ID'];
$HOSPITALSTAFF_ID = $_REQUEST['HOSPITALSTAFF_ID'];

require '../../../connect_oracle.php';

$s = oci_parse($c,"delete from operate_by where OPER_ID='$OPER_ID' and HOSPITALSTAFF_ID='$HOSPITALSTAFF_ID'");
$r = oci_execute($s);




echo json_encode(array('success'=>true));
?>