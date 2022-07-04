<!DOCTYPE html>
<html>
<head>
	<title>User_Account</title>
</head>
<body style=" padding-top: 80px;">
    
		<table width="50%">
			<tr>
				<td width="50%">
                <h4>Dashboard</h4><hr><br>
					<ul style="list-style-type:disc;">
						<li><a href="">Dashboard</a></li>
						<li><a href="view_profile.php">View Profile</a></li>
						<li><a href="edit_profile.php">Edit Profile</a></li>
						<li><a href="change_pass.php">Change Password</a></li>
						<form method="POST" action="logout.php">
							<button type="submit" name="logout_btn">Log out</button>
						</form>
					</ul>
				</td>
				<td width="30%">
					 <?php
					session_start();
					if(isset($_SESSION['name'])){
						echo "welcome ".$_SESSION['user'];
						
					}
					
					?>
				</td>
			</tr>
		</table>
	
</body>
</html>