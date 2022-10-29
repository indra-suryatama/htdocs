<?php
	session_start();

    echo 'haloo';
	$id = $_POST["id"];
	$name = $_POST["name"];
	$address = $_POST["address"];
	$phoneNumber = $_POST["phoneNumber"];
	
	echo $id.' '.$name;
	$conn = oci_connect('system', 'abcd1234', 'localhost/XE');
	
	
	$stid = oci_parse($conn, 'UPDATE phonebook set name=:myname, address=:myaddress, phoneNumber=:myphonenumber WHERE id = :id') ;
	// $query = oci_parse($conn, "UPDATE employee SET userid='" . $_POST['userid'] . "', first_name='" . $_POST['first_name'] . "', last_name='" . $_POST['last_name'] . "', city_name='" . $_POST['city_name'] . "' ,email='" . $_POST['email'] . "' WHERE userid='" . $_POST['userid'] . "'");
	oci_bind_by_name($stid, ':id', $id);
	oci_bind_by_name($stid, ':myname', $name);
	oci_bind_by_name($stid, ':myaddress', $address);
	oci_bind_by_name($stid, ':myphonenumber', $phoneNumber);
   
    //var_dump($stid);
	$r = oci_execute($stid);  // executes and commits

	if ($r) {
		print "One row updated";
	}

	oci_free_statement($stid);
	oci_close($conn);
	//header("HTTP/1.1 200 OK");
	//var_dump($data);
?>