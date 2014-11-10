<?php

$RECU_ID = $_REQUEST['RECU_ID'];
$ID_NO = $_REQUEST['ID_NO'];

require '../../../connect_oracle.php';

$s = oci_parse($c,"delete from look_after where RECU_ID='$RECU_ID' and ID_NO='$ID_NO'");
$r = oci_execute($s);




echo json_encode(array('success'=>true));
?>