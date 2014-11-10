<?php

$OPER_ID = $_REQUEST['OPER_ID'];
$MED_ID = $_REQUEST['MED_ID'];
$STATUS = $_REQUEST['STATUS'];
$OPERATION_DATE = $_REQUEST['OPERATION_DATE'];

require '../../../connect_oracle.php';

$s = oci_parse($c, "insert into OPERATION(OPER_ID,MED_ID,STATUS,OPERATION_DATE) 
									values('$OPER_ID','$MED_ID','$STATUS',TO_DATE('$OPERATION_DATE','MM/DD/YYYY'))");
$r = oci_execute($s);

echo json_encode(array(
	'OPER_ID' => $OPER_ID,
	'MED_ID' => $MED_ID,
	'STATUS' => $STATUS
	
));

?>