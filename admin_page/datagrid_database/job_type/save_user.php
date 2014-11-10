<?php

$JOB_ID = $_REQUEST['JOB_ID'];
$JOB_NAME = $_REQUEST['JOB_NAME'];

require '../../../connect_oracle.php';

$s = oci_parse($c, "insert into JOB_TYPE(JOB_ID,JOB_NAME) values('$JOB_ID','$JOB_NAME')");
$r = oci_execute($s);

echo json_encode(array(
	'JOB_ID' => $JOB_ID,
	'JOB_NAME' => $JOB_NAME
));

?>