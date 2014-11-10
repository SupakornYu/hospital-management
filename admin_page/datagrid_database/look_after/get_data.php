<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'recu_id';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	
	$recu_id_search = isset($_POST['RECU_ID']) ? $_POST['RECU_ID'] : '';
	$id_no_search = isset($_POST['ID_NO']) ? $_POST['ID_NO'] : '';
	$start_rest_search = isset($_POST['START_REST']) ? $_POST['START_REST'] : '';
	$end_rest_search = isset($_POST['END_REST']) ? $_POST['END_REST'] : '';
	
	$offset = ($page-1)*$rows;
	$nextrow = $offset + $rows;
	$result = array();

	require '../../../connect_oracle.php';
	
	
	$s = oci_parse($c, "select count(*) from look_after");
	$rs = oci_execute($s);
	
	$row = oci_fetch_row($s);
	$result["total"] = $row[0];
	
	

	$s = oci_parse($c, "select * 
						from(SELECT rownum r,RECU_ID,ID_NO,START_REST,END_REST
							 from ( select j.* from look_after j 
									where RECU_ID like '$recu_id_search%' 
									and ID_NO like '$id_no_search%' 
									and START_REST like '$start_rest_search%' 
									and END_REST like '$end_rest_search%' 
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