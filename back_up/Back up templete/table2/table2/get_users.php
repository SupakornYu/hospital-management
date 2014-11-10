<?php

include 'conn.php';
//$rs = mysql_query('select * from users');
$s = oci_parse($c, "select * from accounts");
$r = oci_execute($s);
$result = array();
while($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)){
	array_push($result, $row);
}

echo json_encode($result);

?>