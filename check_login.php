<?php
	session_start();
	$username = $_POST['txtUsername'];
	$password = $_POST['txtPassword'];
	$select_type = $_POST['selectType'];
	$md5password = md5($password);
	require 'connect_oracle.php';
	
	if($select_type == 1){
		$table_login = 'HOSPITAL_STAFFS';
	}elseif ($select_type == 2){
		$table_login = 'patients';
	}else{
		echo "Please Login!";
		exit();
	}
	
	$s = oci_parse($c, "select * from $table_login where username = '$username' and password = '$md5password'");
	$r = oci_execute($s);
	if(!($row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)))
	{
			echo "Username and Password Incorrect!";
			echo "<br><a href='login.html'>Back to Log In Page</a><br>";
	}
	else
	{
			$_SESSION["ses_id"] = session_id();
			$_SESSION["ses_account_id"] = $row["ACCOUNT_ID"];
			$_SESSION["ses_table_login"] = $table_login;
			$_SESSION["ses_username"] = $row["USERNAME"];
			$job_id = $row["JOB_ID"];

			$s = oci_parse($c, "select * from job_type where job_id = '$job_id'");
			$r = oci_execute($s);
			$row_query_job = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS);
			$_SESSION["ses_job_name"] = $row_query_job["JOB_NAME"];
			
			session_write_close();
			
			if($_SESSION["ses_job_name"]=='admin'){
				header("location:/admin_page/datagrid_database/job_type/job_type.php");
			}else{
				header("location:logout.php");
			
			}
		
			//header("location:main.php");
			
	}
	
?>
