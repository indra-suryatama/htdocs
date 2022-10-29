<?php
    $id = $_POST['id']; 
    $conn = oci_connect('system', 'abcd1234', 'localhost/XE');
	
	$sql = 'SELECT * FROM phonebook WHERE id = '.$id;
	
	$stid = oci_parse($conn, $sql);
	oci_execute($stid);
	
	if($row = oci_fetch_row($stid)) {
        $data = array("id"=> $row[0], "name"=> $row[1], "address"=>  $row[2], "phoneNumber" => $row[3]);
        echo json_encode($data);
	}
?>