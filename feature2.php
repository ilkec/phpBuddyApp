<?php
<<<<<<< HEAD
	function canLogin($email, $password){
        $conn = new mysqli("localhost", "root", "", "buddyapp");
        $email = $conn->real_escape_string($email);
		$query = "select * from users where email = '$email'";
		$result = $conn->query($query);
		$user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            return true;
        }else{
            return false;
        }
    }
	
	if(!empty($_POST)){
		
		$email = $_POST['email'];
		$password = $_POST['password'];

		
		if(!empty($email) && !empty($password)){
			
			if(canLogin($email, $password)){
				
				session_start();
				$_SESSION['user'] = $email;

				header("Location: index.php");
			}
			else{
				$error = "Email and password don't match";
			}
		}
		else{
			// indien leeg: error genereren.
			$error = "Email and password are required";
=======
function canLogin($email, $password)
{
	$conn = new mysqli("localhost", "root", "", "tempDatabase");
	$email = $conn->real_escape_string($email);
	$query = "select * from users where email = '$email'";
	$result = $conn->query($query);
	$user = $result->fetch_assoc();
	if (password_verify($password, $user['password'])) {
		return true;
	} else {
		return false;
	}
}

if (!empty($_POST)) {

	$email = $_POST['email'];
	$password = $_POST['password'];


	if (!empty($email) && !empty($password)) {

		if (canLogin($email, $password)) {

			session_start();
			$_SESSION['user'] = $email;

			header("Location: index.php");
		} else {
			$error = "Email and password don't match";
>>>>>>> a74127dadcbb111da82cefc79275a17cb37cbba3
		}
	} else {
		// indien leeg: error genereren.
		$error = "Email and password are required";
	}
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
<<<<<<< HEAD
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
=======

>>>>>>> a74127dadcbb111da82cefc79275a17cb37cbba3
</body>

</html>