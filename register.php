<?php
include_once(__DIR__ ."/classes/User.php");
if(!empty($_POST)){
  $user = new User();
  $user->setFirstname($_POST['firstname']);
  $user->setLastname($_POST['lastname']);
  $user->setEmail($_POST['email']);
  $user->setGender($_POST['gender']);
  $user->setBirthday($_POST['birthday']);
  $user->setPassword($_POST['password']);
  $user->setConfPassword($_POST['confPassword']);
  var_dump($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Registreren</title>
  </head>

  <body>
    <!-----------------------------Navbar------------------------------>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <div class="container-fluid"> <a class="navbar-brand" href="#">MyBuddyApp</a>
        <ul class="nav justify-content-end"> <a class="nav-link" href="#">Login</a> </ul>
      </div>
    </nav>
    <!------------------------Error-message------------------------->
    <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
      hier komt error message
    </div>
    <!-----------------------End-Error-message----------------------->
    <!------------------------success-message------------------------->
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      hier komt success message
    </div>
    <!-----------------------End-sucess-message------------------------->
    <!-----------------------------Form------------------------------>
    <div class="form-div">
      <!----------------------------reset-form-after-user-created successfully-------------------------->
      <form action="register.php" method="post">
        <h1 class="title">Sign up</h1>
        <!--------------Email------------>
        <div class="form-group email">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control formInputs" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Example@student.thomasmore.be" value=""> </div>
        <!--------------Name------------>
        <div class="row" id="name">
          <div class="col">
            <label for="fullName">First name</label>
            <input type="text" class="form-control formInputs" name="firstname" placeholder="first name" value=""> </div>
          <div class="col">
            <label for="fullName">Last name</label>
            <input id="lasnemText" type="text" class="form-control formInputs" placeholder="Last name" name="lastname" value=""> </div>
        </div>
        <!-------------Gender----------!-->
        <div class="form-row gender">
          <div class="col male "> Male </div>
          <input type="hidden" name="gender" class="test" value="Male">
          <input type="checkbox" name="gender" class="test" value="Female">
          <div class="col female "> Female </div>
        </div>
        <!-------------Birthday----------!-->
        <div class="form-group email ">
          <label for="fullName">Birthday</label>
          <input type="text" class="form-control formInputs" placeholder="dd/mm/yy" name="birthday" value=""> </div>
        <!-------------Password----------!-->
        <div class="form-group password ">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control formInputs" id="exampleInputPassword1" name="password" placeholder="password"> </div>
        <!-------------Confirmation-Password------------>
        <div class="form-group confPassword ">
          <label for="exampleInputConfPassword">Confirm password</label>
          <input type="password" class="form-control formInputs" id="exampleInputConfPassword" name="confPassword" placeholder="confirm password"> </div>
        <!--------------Button------------>
        <button type="submit" class="btn btn-primary button">Sign Up</button>
      </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>

</html>