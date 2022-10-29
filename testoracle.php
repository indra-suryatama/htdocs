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
echo '<tab>ID <tab>Username Password<br>';
$sql = 'SELECT * FROM login';
$stid = oci_parse($conn, $sql);
oci_execute($stid);

while (($row = oci_fetch_row($stid))) {
    echo $row[0] . " " . $row[1]. " " . $row[2] . " EOF<br>\n";

}
oci_free_statement($stid);
oci_close($conn);
?>

</body>
</html>