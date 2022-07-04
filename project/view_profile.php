
<!DOCTYPE html>
<html>
<head>
	<title>User_Account</title>
<body style=" padding-top: 80px;">
		
		
		
			
				
                <h4>Account For Medi_Team_Member</h4><hr><br>
					<ul style="list-style-type:disc;">
						<li><a href="user_account.php ">Dashboard</a></li>
						<li><a href="view_profile.php">View Profile</a></li>
						<li><a href="edit_profile.php">Edit Profile</a></li>
						<li><a href="change_pass.php">Change Password</a></li>
						<form method="POST" action="logout.php">
							<li><button type="submit" name="logout_btn">Log out</button></li>
						</form>
					</ul>
				
				
				<fieldset>
						
						<table width="100%">
							<tr>
								<td width="25%">Name</td>
								<td><span>:</span><?php
								session_start();
								 echo"".$_SESSION['user']?></td>
								
							</tr>

							<tr>
								<td width="25%">Email</td>
								<td><span>:</span><?php  echo"".$_SESSION['email']?></td>
							</tr>
<tr>
								<td width="25%">Username</td>
								<td><span>:</span><?php 

								 echo"".$_SESSION['user']?></td>
							</tr>
							<tr>
								<td width="25%">Password</td>
								<td><span>:</span><?php 

								 echo"".$_SESSION['password']?></td>
							</tr>
							<tr>
								<td width="25%">Gender</td>
								<td><span>:</span><?php 

								 echo"".$_SESSION['gender']?></td>
							</tr>
							

							
						</table><hr>
						
					</fieldset>
</body>
</html>