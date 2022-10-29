<?php
session_start();
?>

<div class="container">
   <form action="auth.php" method="post">
        <div id="div_login">
            <h1>Login</h1>
            <div>
                <input type="text" class="textbox" id="txt_uname" name="username" placeholder="Username" />
            </div>
            <div>
                <input type="password" class="textbox" id="txt_uname" name="password" placeholder="Password"/>
            </div>
			<?php
				if(isset($_GET['authenticationFailed'])) {
					echo "<div>username and password wrong</div>";
				}
			?>
            <div>
                <input type="submit" value="Submit" name="but_submit" id="but_submit" />
            </div>
        </div>
    </form>
</div>