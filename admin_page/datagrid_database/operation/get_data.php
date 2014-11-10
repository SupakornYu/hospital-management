<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'oper_id';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	
	$oper_id_search = isset($_POST['OPER_ID']) ? $_POST['OPER_ID'] : '';
	$med_id_search = isset($_POST['MED_ID']) ? $_POST['MED_ID'] : '';
	$status_search = isset($_POST['STATUS']) ? $_POST['STATUS'] : '';
	$operation_search = isset($_POST['OPERATION_DATE']) ? $_POST['OPERATION_DATE'] : '';
	
	$offset = ($page-1)*$rows;
	$nextrow = $offset + $rows;
	$result = array();

	require '../../../connect_oracle.php';
	
	
	$s = oci_parse($c, "select count(*) from operation");
	$rs = oci_execute($s);
	
	$row = oci_fetch_row($s);
	$result["total"] = $row[0];
	
	

	$s = oci_parse($c, "select * 
						from(SELECT rownum r,oper_id,MED_ID,STATUS,OPERATION_DATE
							 from ( select j.* from operation j 
									where oper_id like '$oper_id_search%' 
									and MED_ID like '$med_id_search%' 
									and STATUS like '$status_search%'
									and OPERATION_DATE like '$operation_search%'
									order by j.$sort $order ) ) 
						where r > '$offset' and r <='$nextrow'"); //limit '$offset','$rows'
	$rs = oci_execute($s);
	$rows = array();
	
	while($row = oci_fetch_object($s)){
		array_push($rows, $row);
	}
	$result["rows"] = $rows;
	
	echo json_encode($result);

?>