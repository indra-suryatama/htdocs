<?php
	session_start(); 
	$conn = oci_connect('system', 'abcd1234', 'localhost/XE');
	$username = $_POST['username'];
	$password = $_POST['password'];
	echo $username;
	
	$sql = 'SELECT id FROM login WHERE name= \''.$username.'\' and password =\''.$password.'\'';
	echo $sql;
	$stid = oci_parse($conn, $sql);
	oci_execute($stid);
	
	if($row = oci_fetch_row($stid)) {
		$loginId = $row[0];
	} else {
		$loginId = 0;
	}
	/*echo "auth:".$isAuthenticationSuccess;
	$id = $row[1];*/
	echo $loginId;
	if($loginId) {
		
		$_SESSION['user'] = $loginId;
		echo 'user: '.$_SESSION['user'];
		Header("Location: main.php?user=".$username."&loginId=".$loginId);
		echo 'true';
	} 
	else {
		Header("Location: login.php?authenticationFailed=1");
		echo 'false';
	}
	oci_free_statement($stid);
	oci_close($conn);

	 echo $_POST['username']; 
	 echo $_POST['password']; 
 
?>