
<!DOCTYPE html>
<html>
<head>
	<title>User_Account</title>


</head>
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
			
 <?php 
session_start();
$name = $email = $dob = $gender = "";
$nameErr = $emailErr = $dobErr= $genderErr = "" ;

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
        $email_pattern = "/@gmail.com/i";
        $email_matching_result = preg_match($email_pattern, $email);
        if($email_matching_result == 0){
            $emailErr = "Email format is not valid";
            $errorFlag = true;
        }
    }
    
 

    if(!$errorFlag){
        $users = json_decode(file_get_contents('users.json'), true);
        
        foreach ($users as $key => $value) {
            if ($value['name'] == $_SESSION['name']) {
                $set = [
                    'name' => $_SESSION['name'],
                    'email' => $_POST['email'],
                    'username'=> $_POST['fname'],
                    'password'=> $_SESSION['password'],
                    'gender' => $_SESSION['gender']
                    
                ];
                $_SESSION['name'] = $set;
                 $users[$key] = $_SESSION['name'];
                file_put_contents('users.json', json_encode($users));
                header("Location: login.php");
                exit();
                if(isset($_COOKIE['user'])){
                    setrawcookie('user', base64_encode(json_encode($_SESSION['user'])));
                }
               
            }
        }
    }
}
?>

<fieldset width="60%">
						<legend>EDIT PROFILE</legend>
						<form method="post" action="">
								
								
							

								<legend>UserName</legend>
								<input type="text" name="fname" value="<?php $_SESSION['user']?>"><span style="color: red;"><?php echo $nameErr ?></span>
								<hr>
								<legend>Email</legend>
								<input type="text" name="email" value="<?php $_SESSION['email']?>"><span style="color: red;"><?php echo $emailErr ?></span>
								<hr>
                                
							<p>After changing profile you have to re login</p>

							
								
								<hr>
						
							
								
								<hr>
							

								<input type="submit" name="submit" value="Submit">

						</fieldset>
		


			
		
</body>
</html>