<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
    <link rel = "stylesheet" href= "design.css" />
</head>
<body>
   <?php 
    $name = $email  = $gender = $userName = $pass = $con_pass = "";
	$nameErr = $emailErr = $genderErr = $con_passErr = $passErr = $userNameErr = $userExist = "" ;

	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$errorFlag = false;
		if(!isset($_POST['fname']) || empty($_POST['fname'])){
			$nameErr = "Name is required";
			$errorFlag = true;
		}else{
			$name = $_POST['fname'];
			if(!preg_match("/^[a-zA-Z-' ]*$/", $name)){
				$nameErr = "Only letters, whitespaces, - and ' are acceptable";
				$errorFlag = true;
			}
			else if(str_word_count($name)<2){
				$nameErr = "Name has to contain at least two words ";
				$errorFlag = true;
			}
		}
		if(empty($_POST['email'])){
			$emailErr = "Email is required";
			$errorFlag = true;
		}else{
			$email = $_POST['email'];
			if (preg_match("/^[a-zA-Z\d\._]+@[a-zA-Z\d\._]+[\.][a-zA-Z\d\._]+$/",$email)) {
				
			 }
			 else {
				$emailErr="*Wrong pattern in writing email.";
				$errorFlag = true;
			
			 }
		}

		if (!isset($_POST['user_name']) || empty($_POST['user_name'])) {
			$userNameErr = "User Name is required";
			$errorFlag = true;
		}else{
			$userName = $_POST['user_name'];
			if (!preg_match("/^[a-zA-z_0-9]*$/", $userName)) {
				$userNameErr = "Only characters, alphabic numeric characters, dash, underscore can be used in username";
				$errorFlag = true;
			}
			else if(strlen($userName) < 2){
				$userNameErr = "Username must contain at least 2 characters";
				$errorFlag = true;
			}
		}

		if (!isset($_POST['password']) || empty($_POST['password'])) {
			$passErr = "Password is required";
			$errorFlag = true;
		}else{
			$pass = $_POST['password'];

			if (strlen($pass) < 8) {
				$passErr = "Password must contain at least 8 characters";
				$errorFlag = true;
			}
			$special_pass_check_1 = strpos($pass, "@");
			$special_pass_check_2 = strpos($pass, "#");
			$special_pass_check_3 = strpos($pass, "%");
			$special_pass_check_4 = strpos($pass, "$");


			if($special_pass_check_1 === FALSE && $special_pass_check_2 === FALSE && $special_pass_check_3 === FALSE && $special_pass_check_4 === FALSE) {
				$passErr = "Password must contain at least one of @, $, #, %";
				$errorFlag = true;
			}
		}
		if (!isset($_POST['con_pass']) || empty($_POST['con_pass'])) {
			$con_passErr = "Password is required";
			$errorFlag = true;
		}else{
			$con_pass = $_POST['con_pass'];
		if($_POST['password'] !== $_POST['con_pass']){
			$con_passErr = "Confirm Password Doesn't Match!";
			$errorFlag = true;
		}
	}

		
		
		

		if(!$errorFlag){
			$set = [
				'name' => $_POST['fname'],
				'email' => $_POST['email'],
				'username' => $_POST['user_name'],
				'password' => $_POST['password'],
				'gender' => $_POST['gender']
				
			];

			if(!file_exists('users.json')){
				@file_put_contents('users.json', '');
			}

			$users = json_decode(file_get_contents('users.json'), true);

			foreach ($users as $key => $value) {
				if($value['email'] == $_POST['email'] || $value['username'] == $_POST['user_name'] ){
					$userExist = "User Already Exist!";
					echo "User Already Exist!";
					break;
				}
			}
			if(empty($userExist)){
				$users[] = $set;
				file_put_contents('users.json', json_encode($users));
				header("Location: login.php");
                exit();
			}
		}
	}
	?>

	<fieldset>
	<nav>
    <div>
    <p style = "font-size:40px; font-family:Arial;margin-bottom: 0px;">Fire Risk Management</p>
    <br><span style = " color:white;  font-weight: bold;">Help us to prevent unnecessary Fire</span>
<div style ="margin-top: 0px; position: absolute;right: 80px;top:55px;text-decoration: none;border-style: solid;border-width: 1.5px; border-color: red;">
    <a href="login.php"><b style = "color:white;font-size:25px; font-family:Arial;"> LOGIN ||</b></a>
    <a href="registration.php"><b style ="color:white;font-size:15px; font-family:Arial;"> SIGN UP</b></a>
</div>
    <div class = "nav1">
    <a class="active" href="#home">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <a href="#about">About</a>
  
    </div>

    </nav>
		<form method="post" action=""<?php echo ($_SERVER['PHP_SELF']);?>>
		<fieldset >
		        <label>Name</label> 
				<input type="text" name="fname"  value="<?php echo $name;?>"><span class="red"><?php echo $nameErr ?></span><br />
                 <br><hr>
				 <label>E-mail</label>
				<input type="text" name="email" value="<?php echo $email;?>"><span class="red"><?php echo $emailErr ?></span>
                <br><br><hr>
				<label>User Name</label>
				<input type="text" name="user_name" value="<?php echo $userName;?>"><span class="red"><?php echo $userNameErr ?></span>
				<br><br><hr>
				<label>Password</label>
				<input type="text" name="password" value=""><span class="red"><?php echo $passErr ?></span>
				<br><br><hr>
				<label>Confirm Password</label>
				<input type="text" name="con_pass" value=""><span class="red"><?php echo $con_passErr ?></span>
				<br><br><hr>

				<label>Gender </label><br><br>
				<input type="radio" name="gender" value="male" id="male">Male
				<input type="radio" name="gender" value="female" id="female">Female
				<input type="radio" name="gender" value="others" id="others">Others
				<span class="red"><?php echo $genderErr ?></span>	<br><br><br>
				
				
                <input type="submit" name="submit" value="Submit"><span>   </span>
			<input type="reset" name="reset" value="Reset">


				</fieldset>
</form>
<footer>
All rights reserved. &copy 2022 <br>
</footer>
</body>
</html>