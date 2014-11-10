<?php

$OPER_ID = $_REQUEST['OPER_ID'];
$HOSPITALSTAFF_ID = $_REQUEST['HOSPITALSTAFF_ID'];
$HOURS = $_REQUEST['HOURS'];

require '../../../connect_oracle.php';

$s = oci_parse($c, "insert into OPERATE_BY(OPER_ID,HOSPITALSTAFF_ID,HOURS) 
									values('$OPER_ID','$HOSPITALSTAFF_ID','$HOURS')");
$r = oci_execute($s);

echo json_encode(array(
	'OPER_ID' => $OPER_ID,
	'HOSPITALSTAFF_ID' => $HOSPITALSTAFF_ID,
	'HOURS' => $HOURS
	
));

?>