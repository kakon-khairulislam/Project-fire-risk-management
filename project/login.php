<!DOCTYPE html>
<html>
<head>
	<title>Login</title>


</head>
<body >
    
			<form method="post" action="<?php echo ($_SERVER['PHP_SELF']);?>">
			
<?php
		$userName = $pass = "";
		$userName_Err = $pass_Err = "";
		$matchError = false;
		$errorFlag = false;
		session_start();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
				
			if (!isset($_POST['user_name']) || empty($_POST['user_name'])) {
				$userName_Err = "User Name is required";
				$errorFlag = true; 
			}else{
				$userName = $_POST['user_name'];
			}
				
			if (!isset($_POST['password']) || empty($_POST['password'])) {
				$pass_Err = "Password is required";
				$errorFlag = true;
			}else{
				$pass = $_POST['password'];
			}

			if(!$errorFlag){
				$users = json_decode(file_get_contents('users.json'), true);

				if(is_array($users)){
					$matchError = "User not found";
					foreach ($users as $key => $value) {
						if($value['username'] == $_POST['user_name']){
							if ($_POST['password'] == $value['password']){
								$_SESSION['user'] = $value['username'];
								

								if(isset($_POST['remember_me']) && $_POST['remember_me'] == 'remembered'){
									setrawcookie('user', base64_encode(json_encode($value['user'])));
								}
								header("Location: User_account.php");
							}else{
								$matchError = "Password does not match";
								break;
							}
						}
						$_SESSION['email'] = $value['email'];
						$_SESSION['gender'] = $value['gender'];
						$_SESSION['name'] = $value['name'];
						$_SESSION['password'] = $value['password'];
						
						
						

					}
			

				}else{
					$matchError = "No users found";

				}
			}
			

		}

?>
		<form method="post" action="<?php echo ($_SERVER['PHP_SELF']);?>">
			<fieldset>
				<legend><h2>LOGIN</h2></legend>

				<?php
				if($matchError){
					?>
					<span style="color: red;"><?php echo $matchError?></span>	
					<?php
				}
				?>
				<table>
					<tr>
						<td><label>User Name: </label></td>
						<td><input type="text" name="user_name" value="<?php echo $userName;?>"></td>
						<td><span class="red"><?php echo $userName_Err?></span></td>
					</tr>

					<tr>
						<td><label>Password: </label></td>
						<td><input type="password" name="password" value="<?php echo $pass;?>"></td>
						<td><span class="red"><?php echo $pass_Err?></span></td>
					</tr>
				</table><br>
				<hr>
				<input type="checkbox" name="remember_me" value="remembered">Remember me<br><br>
				<input type="submit" name="submission" value="submit">
						
			</fieldset>
		</form>

		</form>
		
</body>
</html>