<?php
	session_start();
	$loginID = $_SESSION['user'];

	//$data = $_POST;
	$name = $_POST["name"];
	$address = $_POST["address"];
	$phoneNumber = $_POST["phoneNumber"];
	
	
	$conn = oci_connect('system', 'abcd1234', 'localhost/XE');
	
	$sql = 'SELECT max(id) FROM login';
	
	$stid = oci_parse($conn, $sql);
	oci_execute($stid);
	
	if($row = oci_fetch_row($stid)) {
		$id = $row[0] + 1;
	} 

	if (!$conn) {
	   $m = oci_error();
	   echo $m['message'], "\n";
	   exit;
	}
	else {
	   print "Connected to Oracle Database!<br><br><br>";
	}
	$stid = oci_parse($conn, 'INSERT INTO phonebook (id, loginId, name, address, phoneNumber) VALUES(:id, :loginid, :myname, :myaddress, :myphonenumber)');

	oci_bind_by_name($stid, ':id', $id);
	oci_bind_by_name($stid, ':loginid', $loginID);
	
	oci_bind_by_name($stid, ':myname', $name);
	oci_bind_by_name($stid, ':myaddress', $address);
	oci_bind_by_name($stid, ':myphonenumber', $phoneNumber);

	$r = oci_execute($stid);  // executes and commits

	if ($r) {
		print "One row inserted";
	}

	oci_free_statement($stid);
	oci_close($conn);
	//header("HTTP/1.1 200 OK");
	//var_dump($data);
?>