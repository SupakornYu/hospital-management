<?php

$ROOM_ID = $_REQUEST['ROOM_ID'];


require '../../../connect_oracle.php';

$s = oci_parse($c,"delete from ROOM where ROOM_ID='$ROOM_ID'");
$r = oci_execute($s);




echo json_encode(array('success'=>true));
?>