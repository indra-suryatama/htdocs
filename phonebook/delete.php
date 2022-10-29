<?php
	session_start();
	$id = $_POST["id"];

	$conn = oci_connect('system', 'abcd1234', 'localhost/XE');
		
	$stid = oci_parse($conn, 'DELETE phonebook WHERE id = :id') ;
	oci_bind_by_name($stid, ':id', $id);

	$r = oci_execute($stid);  // executes and commits

	if ($r) {
		print "One row updated";
	}

	oci_free_statement($stid);
	oci_close($conn);
?>