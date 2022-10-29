<html>
<body>

<?php

// Create connection to Oracle
$conn = oci_connect('system', 'abcd1234', 'localhost/XE');

if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
else {
   print "Connected to Oracle Database!<br><br><br>";
}
$stid = oci_parse($conn, 'INSERT INTO LOGIN (id, name, password) VALUES(:myid, :myname, :mypassword)');

$id = 4;
$name = 'Keiko Valerie Suryatama';
$password = 'aws1234';

oci_bind_by_name($stid, ':myid', $id);
oci_bind_by_name($stid, ':myname', $name);
oci_bind_by_name($stid, ':mypassword', $password);

$r = oci_execute($stid);  // executes and commits

if ($r) {
    print "One row inserted";
}

oci_free_statement($stid);
oci_close($conn);
?>

</body>
</html>