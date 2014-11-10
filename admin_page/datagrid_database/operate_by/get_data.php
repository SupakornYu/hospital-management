<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'oper_id';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	
	$oper_id_search = isset($_POST['OPER_ID']) ? $_POST['OPER_ID'] : '';
	$hospitalstaff_id_search = isset($_POST['HOSPITALSTAFF_ID']) ? $_POST['HOSPITALSTAFF_ID'] : '';
	$hours_search = isset($_POST['HOURS']) ? $_POST['HOURS'] : '';
	
	$offset = ($page-1)*$rows;
	$nextrow = $offset + $rows;
	$result = array();

	require '../../../connect_oracle.php';
	
	
	$s = oci_parse($c, "select count(*) from operate_by");
	$rs = oci_execute($s);
	
	$row = oci_fetch_row($s);
	$result["total"] = $row[0];
	
	

	$s = oci_parse($c, "select * 
						from(SELECT rownum r,oper_id,hospitalstaff_id,hours 
							 from ( select j.* from operate_by j 
									where oper_id like '$oper_id_search%' 
									and hospitalstaff_id like '$hospitalstaff_id_search%' 
									and (hours like '$hours_search%' or hours is null)
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