<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'account_id';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
	
	$account_search = isset($_POST['ACCOUNT_ID']) ? $_POST['ACCOUNT_ID'] : '';
	$username_search = isset($_POST['USERNAME']) ? $_POST['USERNAME'] : '';
	$password_search = isset($_POST['PASSWORD']) ? $_POST['PASSWORD'] : '';
	$ssn_search = isset($_POST['SSN']) ? $_POST['SSN'] : '';
	$name_search = isset($_POST['NAME']) ? $_POST['NAME'] : '';
	$surname_search = isset($_POST['SURNAME']) ? $_POST['SURNAME'] : '';
	$job_id_search = isset($_POST['JOB_ID']) ? $_POST['JOB_ID'] : '';
	$salary_search = isset($_POST['SALARY']) ? $_POST['SALARY'] : '';
	$start_contract_search = isset($_REQUEST['START_CONTRACT']) ? $_REQUEST['START_CONTRACT'] : '';
	$end_contract_search = isset($_POST['END_CONTRACT']) ? $_POST['END_CONTRACT'] : '';
	
	
	$offset = ($page-1)*$rows;
	$nextrow = $offset + $rows;
	$result = array();

	require '../../../connect_oracle.php';
	
	
	$s = oci_parse($c, "select count(*) from HOSPITAL_STAFFS");
	$rs = oci_execute($s);
	
	$row = oci_fetch_row($s);
	$result["total"] = $row[0];
	
	

	$s = oci_parse($c, "select * 
						from(SELECT rownum r,account_id,username,password,ssn,name,surname
							,JOB_ID,SALARY,to_char(START_CONTRACT,'dd-MON-yyyy') as START_CONTRACT,to_char(END_CONTRACT,'dd-MON-yyyy') as END_CONTRACT
							 from ( select j.* 
									from HOSPITAL_STAFFS j 
									where account_id like '$account_search%' 
									and username like '$username_search%' 
									and password like '$password_search%'
									and ssn like '$ssn_search%'
									and name like '$name_search%'
									and surname like '$surname_search%' 
									and JOB_ID like '$job_id_search%'
									and SALARY like '$salary_search%'
									and to_char(START_CONTRACT,'DD-MON-YYYY') like '$start_contract_search%' 
									and to_char(END_CONTRACT,'DD-MON-YYYY') like '$end_contract_search%'
									
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