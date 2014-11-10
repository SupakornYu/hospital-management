<?php
	session_start();
	
	
	
	if(!isset($_SESSION['ses_id'])){
		echo "Please Login!";
		exit();
		if($_SESSION['ses_id'] == ""){
			echo "Please Login!";
			exit();
		}	
	}
	
	require 'connect_oracle.php';
	$Username = $_SESSION["ses_username"];
	$table_login = $_SESSION["ses_table_login"];
	$s = oci_parse($c, "select * from $table_login where username = '$Username' ");
	$r = oci_execute($s);
	$row = oci_fetch_array($s, OCI_ASSOC+OCI_RETURN_NULLS)
?>
<html>
<head>
<title>My Hospital</title>
</head>
<body>
  Welcome to My Hospital! <br>
  <table border="1" style="width: 300px">
    <tbody>
      <tr>
        <td width="87"> &nbsp;Username</td>
        <td width="197"><?php echo $row["USERNAME"];?>
        </td>
      </tr>
      <tr>
        <td> &nbsp;Name</td>
        <td><?php echo $row["NAME"];?></td>
      </tr>
    </tbody>
  </table>
  <br>
  <a href="edit_profile.php">Edit</a>
  <br>
  <br>
  <form action="/table%201/table.php">
		<input type="submit" value="Hospital Table">
  </form>
  <br>
  <a href="logout.php">Logout</a>
</body>
</html>
