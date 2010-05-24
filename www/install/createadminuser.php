<?php 

require("../lib/framework/db.php");
require("../lib/users.php");

//Try to save config and import data
if($_GET['do'] == 'run') {

	$error = '';
	$user = trim($_POST['user']);
	$pass = trim($_POST['pass']);
	$mail = trim($_POST['mail']);

	if(strlen($user) == 0) {
		$error = "Invalid username";
	} else if(strlen($pass) == 0) {
		$error = "No password set";
	} else if(strlen($mail) == 0) {
		$error = "No Email set";
	}

	if(strlen($error) == 0) {
		$db = new DB;
		$usrObject = new Users();
		$test = $usrObject->add($user, $pass, $mail, 2, '', '', '');
		if(is_numeric($test)) {
			header("location: finish.php");
			exit();
		}
	}

}

include('header.html');
?>
	<h1>Admin user</h1>
	<p>You must setup a admin user. Please provide the following information</p>
	<form action="createadminuser.php?do=run" method="post">
		<table>
			<tr>
				<th>Username:</th>
				<td><input type="text" name="user" value="<?=$user?>" /></td>
			</tr>
			<tr>
				<th>Password:</th>
				<td><input type="password" name="pass" value="<?=$pass?>" /></td>
			</tr>
                        <tr>
                                <th>Email:</th>
                                <td><input type="text" name="mail" value="<?=$mail?>" /></td>
                        </tr>
			<tr> 
				<td colspan="2">
					<div align="center">
						<input type="submit" value="Step six: Clean up" />
					</div>
				</td>
			</tr>
		</table>
	<?php
		if(strlen($error) > 0) {
			echo '<div class="error">'.$error."</div>";
		}
	?>
	</form>

<?php include('footer.html'); ?>