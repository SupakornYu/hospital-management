<?php

$PER_ID = $_REQUEST['PER_ID'];
$MEDICINE_DETAIL = $_REQUEST['MEDICINE_DETAIL'];

require '../../../connect_oracle.php';

$s = oci_parse($c, "insert into PERSCRIPTION(PER_ID,MEDICINE_DETAIL) values('$PER_ID','$MEDICINE_DETAIL')");
$r = oci_execute($s);

echo json_encode(array(
	'PER_ID' => $PER_ID,
	'MEDICINE_DETAIL' => $MEDICINE_DETAIL
));

?>