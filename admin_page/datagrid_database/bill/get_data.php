<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'bill_id';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	
	$bill_id_search = isset($_POST['BILL_ID']) ? $_POST['BILL_ID'] : '';
	$med_id_search = isset($_POST['MED_ID']) ? $_POST['MED_ID'] : '';
	$all_cost_search = isset($_POST['ALL_COST']) ? $_POST['ALL_COST'] : '';
	$paying_status_search = isset($_POST['PAYING_STATUS']) ? $_POST['PAYING_STATUS'] : '';
	
	$offset = ($page-1)*$rows;
	$nextrow = $offset + $rows;
	$result = array();

	require '../../../connect_oracle.php';
	
	
	$s = oci_parse($c, "select count(*) from bill");
	$rs = oci_execute($s);
	
	$row = oci_fetch_row($s);
	$result["total"] = $row[0];
	
	

	$s = oci_parse($c, "select * 
						from(SELECT rownum r,BILL_ID,MED_ID,ALL_COST,PAYING_STATUS 
							 from ( select j.* 
									from bill j 
									where BILL_ID like '$bill_id_search%' 
									and MED_ID like '$med_id_search%' 
									and ALL_COST like '$all_cost_search%'
									and PAYING_STATUS like '$paying_status_search%'
									order by j.$sort $order ) )
						where r > '$offset' and r <='$nextrow'"); //limit '$offset','$rows'  :: oper_id is null problem
	$rs = oci_execute($s);
	$rows = array();
	
	while($row = oci_fetch_object($s)){
		array_push($rows, $row);
	}
	$result["rows"] = $rows;
	
	echo json_encode($result);

?>