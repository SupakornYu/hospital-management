<?php

$MED_ID = $_REQUEST['MED_ID'];
$PA_ID = $_REQUEST['PA_ID'];
$DETAIL = $_REQUEST['DETAIL'];
$PER_ID = $_REQUEST['PER_ID'];
$STATUS = $_REQUEST['STATUS'];


require '../../../connect_oracle.php';

$s = oci_parse($c, "insert into MEDICATION(MED_ID,PA_ID,DETAIL,PER_ID,STATUS,TIMESTAMP) 
									values('$MED_ID','$PA_ID','$DETAIL','$PER_ID','$STATUS',(select systimestamp from dual))");
$r = oci_execute($s);

echo json_encode(array(
	'MED_ID' => $MED_ID,
	'PA_ID' => $PA_ID,
	'DETAIL' => $DETAIL,
	'PER_ID' => $PER_ID,
	'STATUS' => $STATUS
	
));

?>