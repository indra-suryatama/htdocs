<?php
	session_start(); 
	$myPDO = new PDO('pgsql:host=10.1.137.140;dbname=testdb','postgres','abcd1234');
	$username = $_POST['username'];
	$password = $_POST['password'];
	//echo $username;
	
	$sql = 'SELECT id FROM login WHERE name= \''.$username.'\' and password =\''.$password.'\'';
	echo $sql;
	$row = $myPDO->prepare($sql);
    $row->execute();

	if($result = $row->fetchAll()) {
		$loginId = $result[0];
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

	 echo $_POST['username']; 
	 echo $_POST['password']; 
 
?>