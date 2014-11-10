<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'med_id';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	
	$med_id_search = isset($_POST['MED_ID']) ? $_POST['MED_ID'] : '';
	$pa_id_search = isset($_POST['PA_ID']) ? $_POST['PA_ID'] : '';
	$detail_search = isset($_POST['DETAIL']) ? $_POST['DETAIL'] : '';
	$per_id_search = isset($_POST['PER_ID']) ? $_POST['PER_ID'] : '';
	$status_search = isset($_POST['STATUS']) ? $_POST['STATUS'] : '';
	$timestamp_search = isset($_POST['TIMESTAMP']) ? $_POST['TIMESTAMP'] : '';
	
	$offset = ($page-1)*$rows;
	$nextrow = $offset + $rows;
	$result = array();

	require '../../../connect_oracle.php';
	
	
	$s = oci_parse($c, "select count(*) from medication");
	$rs = oci_execute($s);
	
	$row = oci_fetch_row($s);
	$result["total"] = $row[0];
	
	

	$s = oci_parse($c, "select * 
						from(SELECT rownum r,MED_ID,PA_ID,DETAIL,PER_ID,status,to_char(TIMESTAMP,'dd-MON-yyyy hh.mi.ss.FF AM') as TIMESTAMP
							 from ( select j.* from medication j 
									where MED_ID like '$med_id_search%' 
									and PA_ID like '$pa_id_search%' 
									and DETAIL like '$detail_search%' 
									and STATUS like '$status_search%'
									and (PER_ID like '$per_id_search%'
									OR PER_ID is null)
									and to_char(TIMESTAMP,'dd-MON-yyyy hh.mi.ss.FF AM') like '$timestamp_search%'
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