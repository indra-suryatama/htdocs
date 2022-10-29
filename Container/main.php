<?php
session_start(); 
	if (isset($_SESSION['user'])) {
?>
<html>
<body>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>CRUD FROM API</title>

    <link href="index.css" rel="stylesheet">
  </head>
  <body>
    
    <nav class="navbar navbar-dark bg-mynav">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">My App</a>
		 <a class="navbar-brand" href="/logout.php">Logout</a>
      </div>
	 
    </nav>

    <div class="container">
      <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight"><h2>Users</div>
        <div class="p-2 bd-highlight">
          <button type="button" class="btn btn-secondary" onclick="showUserCreateBox()">Create</button>
        </div>
      </div>
      
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Address</th>
              <th scope="col">Phone Number</th>
			  <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody id="mytable">
            <tr>
			<?php
				// Create connection to Postgres
        $myPDO = new PDO('pgsql:host=10.1.137.140;dbname=testdb','postgres','abcd1234');
        


				//$loginId = $_GET['loginId'];
				$sql = 'SELECT * FROM phonebook WHERE loginid=\''.$_SESSION['user'].'\'';
        $row = $myPDO->prepare($sql);
        $row->execute();
        
        $rows = $query->fetchAll(PDO::FETCH_CLASS, 'ArrayObject');
				$count = 0;
				foreach ($rows as $row) {
					$count++;
					echo '<tr>';
					echo '<td>'.$count .'</td><td>'.$row[1] . '</td> <td>' . $row[2]. '</td> <td>' . $row[3] . ' </td>
					<td><button type="button" class="btn btn-outline-secondary" onclick="showUserEditBox()">Edit</button>
					<button type="button" class="btn btn-outline-danger" onclick="userDelete()">Del</button></td>';
					echo '</tr>';
				}

		
			?> 
            </tr>
          </tbody>
        </table>
      </div>
    </div>
	<script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </body>

</body>
</html>
<?php
	} else {
		Header("Location: login.php");
	}
?>