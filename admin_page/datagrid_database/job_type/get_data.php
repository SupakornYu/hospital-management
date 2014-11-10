<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'job_id';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	
	$job_id_search = isset($_POST['JOB_ID']) ? $_POST['JOB_ID'] : '';
	$job_name_search = isset($_POST['JOB_NAME']) ? $_POST['JOB_NAME'] : '';
	
	$offset = ($page-1)*$rows;
	$nextrow = $offset + $rows;
	$result = array();

	require '../../../connect_oracle.php';
	
	
	$s = oci_parse($c, "select count(*) from JOB_TYPE");
	$rs = oci_execute($s);
	
	$row = oci_fetch_row($s);
	$result["total"] = $row[0];
	
	

	$s = oci_parse($c, "select * from(SELECT rownum r,job_id,job_name from ( select j.* from job_type j where job_id like '$job_id_search%' and job_name like '$job_name_search%' order by j.$sort $order ) ) where r > '$offset' and r <='$nextrow'"); //limit '$offset','$rows'
	$rs = oci_execute($s);
	$rows = array();
	
	while($row = oci_fetch_object($s)){
		array_push($rows, $row);
	}
	$result["rows"] = $rows;
	
	echo json_encode($result);

?>