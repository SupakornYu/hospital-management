<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'recu_id';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	
	$recu_id_search = isset($_POST['RECU_ID']) ? $_POST['RECU_ID'] : '';
	$status_search = isset($_POST['STATUS']) ? $_POST['STATUS'] : '';
	$start_rest_search = isset($_POST['START_REST']) ? $_POST['START_REST'] : '';
	$end_rest_search = isset($_POST['END_REST']) ? $_POST['END_REST'] : '';
	$med_id_search = isset($_POST['MED_ID']) ? $_POST['MED_ID'] : '';
	
	$offset = ($page-1)*$rows;
	$nextrow = $offset + $rows;
	$result = array();

	require '../../../connect_oracle.php';
	
	
	$s = oci_parse($c, "select count(*) from RECUPERATION");
	$rs = oci_execute($s);
	
	$row = oci_fetch_row($s);
	$result["total"] = $row[0];
	
	

	$s = oci_parse($c, "select * 
						from(SELECT rownum r,recu_id,status,start_rest,end_rest,med_id 
							 from ( select j.* 
									from RECUPERATION j 
									where recu_id like '$recu_id_search%' 
									and status like '$status_search%' 
									and start_rest like '$start_rest_search%'
									and end_rest like '$end_rest_search%'
									and med_id like '$med_id_search%'
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