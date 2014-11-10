<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'per_id';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	
	$per_id_search = isset($_POST['PER_ID']) ? $_POST['PER_ID'] : '';
	$medicine_detail_search = isset($_POST['MEDICINE_DETAIL']) ? $_POST['MEDICINE_DETAIL'] : '';
	
	$offset = ($page-1)*$rows;
	$nextrow = $offset + $rows;
	$result = array();

	require '../../../connect_oracle.php';
	
	
	$s = oci_parse($c, "select count(*) from perscription");
	$rs = oci_execute($s);
	
	$row = oci_fetch_row($s);
	$result["total"] = $row[0];
	
	

	$s = oci_parse($c, "select *
						from (SELECT rownum r,per_id,medicine_detail 
							  from ( select j.* from perscription j where per_id like '$per_id_search%' 
							  and medicine_detail like '$medicine_detail_search%' 
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