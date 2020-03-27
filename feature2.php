<?php
	
	include_once(__DIR__ .'/classes/User.php');
	include_once(__DIR__ . '/classes/Db.php');
	
	if(!empty($_POST)){
		
		$user = new User();
		$email = $_POST['email'];
		$password = $_POST['password'];
		$getAllUser = $user->getAll();
		
		
		if(!empty($email) && !empty($password)){
			
			if($user->canLogin($email, $password)){	
				//$user->setEmail($email);
				//$user->setPassword($password);
				session_start();
				
				$_SESSION['user'] = $email;
				$user->setEmail($_SESSION['user'] );
				
				

				header("Location: profile.php");
			}
			else{
				$error = "Email and password don't match";
			}
		}
		else{
			// indien leeg: error genereren.
			$error = "Email and password are required";
		}
	} else {
		// indien leeg: error genereren.
		$error = "Email and password are required";
	}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Document</title>
</head>

<body>
<form action="" method="post">
        <h2 form__title>Sign up for an account</h2>
        <?php if( isset($error) ): ?>
            <p>
                <?php echo $error; ?>
            </p>
        <?php endif; ?>
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="Log in">
    </form>
</body>

</html>