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
	$blood_group_search = isset($_POST['BLOOD_GROUP']) ? $_POST['BLOOD_GROUP'] : '';
	$gender_search = isset($_POST['GENDER']) ? $_POST['GENDER'] : '';
	$birthday_search = isset($_POST['BIRTHDAY']) ? $_POST['BIRTHDAY'] : '';
	$hospitalstaffs_id_search = isset($_POST['HOSPITALSTAFFS_ID']) ? $_POST['HOSPITALSTAFFS_ID'] : '';
	
	$offset = ($page-1)*$rows;
	$nextrow = $offset + $rows;
	$result = array();

	require '../../../connect_oracle.php';
	
	
	$s = oci_parse($c, "select count(*) from PATIENTS");
	$rs = oci_execute($s);
	
	$row = oci_fetch_row($s);
	$result["total"] = $row[0];
	
	

	$s = oci_parse($c, "select * 
						from(SELECT rownum r,account_id,username,password,ssn,name,surname,blood_group,gender,birthday,hospitalstaffs_id 
							 from ( select j.* 
									from patients j 
									where account_id like '$account_search%' 
									and username like '$username_search%' 
									and password like '$password_search%'
									and ssn like '$ssn_search%'
									and name like '$name_search%'
									and surname like '$username_search%' 
									and blood_group like '$blood_group_search%'
									and gender like '$gender_search%' 
									and birthday like '$birthday_search%'
									and hospitalstaffs_id like '$hospitalstaffs_id_search%'
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