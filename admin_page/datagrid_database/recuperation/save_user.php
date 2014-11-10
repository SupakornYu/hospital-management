<?php

$RECU_ID = $_REQUEST['RECU_ID'];
$STATUS = $_REQUEST['STATUS'];
$START_REST = $_REQUEST['START_REST'];
$END_REST = $_REQUEST['END_REST'];
$MED_ID = $_REQUEST['MED_ID'];

require '../../../connect_oracle.php';

$s = oci_parse($c, "insert into RECUPERATION(RECU_ID,STATUS,START_REST,END_REST,MED_ID)
									values('$RECU_ID','$STATUS',TO_DATE('$START_REST','MM/DD/YYYY'),TO_DATE('$END_REST','MM/DD/YYYY'),'$MED_ID')");
$r = oci_execute($s);

echo json_encode(array(
	'RECU_ID' => $RECU_ID,
	'STATUS' => $STATUS,
	'START_REST' => $START_REST,
	'END_REST' => $END_REST,
	'MED_ID' => $MED_ID
));

?>