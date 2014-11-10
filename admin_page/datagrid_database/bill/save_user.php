<?php

$BILL_ID = $_REQUEST['BILL_ID'];
$MED_ID = $_REQUEST['MED_ID'];
$ALL_COST = $_REQUEST['ALL_COST'];
$PAYING_STATUS = $_REQUEST['PAYING_STATUS'];

require '../../../connect_oracle.php';

$s = oci_parse($c, "insert into BILL(BILL_ID,MED_ID,ALL_COST,PAYING_STATUS) values('$BILL_ID','$MED_ID','$ALL_COST','$PAYING_STATUS')");
$r = oci_execute($s);

echo json_encode(array(
	'BILL_ID' => $BILL_ID,
	'MED_ID' => $MED_ID,
	'ALL_COST' => $ALL_COST,
	'PAYING_STATUS' => $PAYING_STATUS
));

?>