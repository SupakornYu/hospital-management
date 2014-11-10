<?php

$USERNAME = $_REQUEST['USERNAME'];

include 'conn.php';

$s = oci_parse($c," delete from accounts where USERNAME = 'eeee' ");
$r = oci_execute($s);

echo json_encode(array('success'=>true));
?>