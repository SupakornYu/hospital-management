<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'room_id';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	
	$room_id_search = isset($_POST['ROOM_ID']) ? $_POST['ROOM_ID'] : '';
	$room_type_search = isset($_POST['ROOM_TYPE']) ? $_POST['ROOM_TYPE'] : '';
	$available_status_search = isset($_POST['AVAILABLE_STATUS']) ? $_POST['AVAILABLE_STATUS'] : '';
	$recu_id_search = isset($_POST['RECU_ID']) ? $_POST['RECU_ID'] : '';
	
	$offset = ($page-1)*$rows;
	$nextrow = $offset + $rows;
	$result = array();

	require '../../../connect_oracle.php';
	
	
	$s = oci_parse($c, "select count(*) from ROOM");
	$rs = oci_execute($s);
	
	$row = oci_fetch_row($s);
	$result["total"] = $row[0];
	
	

	$s = oci_parse($c, "select * 
						from(SELECT rownum r,room_id,room_type,available_status,recu_id
							 from ( select j.* 
									from ROOM j 
									where room_id like '$room_id_search%' 
									and room_type like '$room_type_search%' 
									and available_status like '$available_status_search%'
									and (recu_id like '$recu_id_search%' or recu_id is null)
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