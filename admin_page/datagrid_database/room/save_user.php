<?php

$ROOM_ID = $_REQUEST['ROOM_ID'];
$ROOM_TYPE = $_REQUEST['ROOM_TYPE'];
$AVAILABLE_STATUS = $_REQUEST['AVAILABLE_STATUS'];
$RECU_ID = $_REQUEST['RECU_ID'];

require '../../../connect_oracle.php';

$s = oci_parse($c, "insert into ROOM(ROOM_ID,ROOM_TYPE,AVAILABLE_STATUS,RECU_ID) 
					values('$ROOM_ID','$ROOM_TYPE','$AVAILABLE_STATUS','$RECU_ID')");
$r = oci_execute($s);

echo json_encode(array(
	'ROOM_ID' => $ROOM_ID,
	'ROOM_TYPE' => $ROOM_TYPE,
	'AVAILABLE_STATUS' => $AVAILABLE_STATUS,
	'RECU_ID' => $RECU_ID
));

?>