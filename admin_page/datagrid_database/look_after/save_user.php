<?php

$RECU_ID = $_REQUEST['RECU_ID'];
$ID_NO = $_REQUEST['ID_NO'];
$START_REST = $_REQUEST['START_REST'];
$END_REST = $_REQUEST['END_REST'];

require '../../../connect_oracle.php';

$s = oci_parse($c, "insert into look_after(RECU_ID,ID_NO,START_REST,END_REST) 
									values('$RECU_ID','$ID_NO',TO_DATE('$START_REST','MM/DD/YYYY'),TO_DATE('$END_REST','MM/DD/YYYY'))");
$r = oci_execute($s);

echo json_encode(array(
	'RECU_ID' => $RECU_ID,
	'ID_NO' => $ID_NO,
	'START_REST' => $START_REST,
	'END_REST' => $END_REST
	
));

?>