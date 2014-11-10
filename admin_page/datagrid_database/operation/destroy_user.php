<?php

$OPER_ID = $_REQUEST['OPER_ID'];

require '../../../connect_oracle.php';

$s = oci_parse($c,"delete from OPERATION where OPER_ID='$OPER_ID'");
$r = oci_execute($s);




echo json_encode(array('success'=>true));
?>