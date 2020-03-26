<?php

include_once(__DIR__ ."/Db.php");
class User
{
  private $id;
  private $firstname;
  private $lastname;
  private $email;
  private $birthday;
  private $gender;
  private $password;
  private $confPassword;
  private $profilePicture;
  private $games;
  private $films;
  private $muziek;
  private $locatie;
  private $boeken;


  /**
     * Get the value of firstname
     */
  public function getFirstname()
  {
    return $this->firstname;
  }

  /**
     * Set the value of firstname
     *
     * @return  self
     */
  public function setFirstname($firstname)
  {
    if(empty($firstname)){
      //throw new Exception("lastname can not be empty");
    }
    $this->firstname = $firstname;
    return $this; 
  }

  /**
     * Get the value of lastname
     */
  public function getLastname()
  {
    return $this->lastname;
  }

  /**
     * Set the value of lastname
     *
     * @return  self
     */
  public function setLastname($lastname)
  {
    if(empty($lastname)){
      //throw new Exception("lastname can not be empty");
    }
    $this->lastname = $lastname;
    return $this; 
  }

  /**
     * Get the value of email
     */
  public function getEmail()
  {
    return $this->email;
  }

  /**
     * Set the value of email
     *
     * @return  self
     */
  public function setEmail($email)
  {
    if(!empty($email)){
      $this->email = $email;
      return $this; 
    }else{
      return '';
    }
  }



  public function setGender($gender)
  {

    $this->gender = $gender;

    return $this;
  }

  public function getGender(){
    return $this->gender;
  }


  public function setBirthday($birthday)
  {
    if(empty($birthday)){
      //throw new Exception("Birthday can not be empty");
    }
    $this->birthday = $birthday ;
    return $this;
  }

  public function getBirthday(){


    return $this->birthday;
  }



  /**
     * Get the value of games
     */
  public function getGames()
  {
    return $this->games;
  }

  /**
     * Set the value of games
     *
     * @return  self
     */
  public function setGames($games)
  {
    $this->games = $games;

    return $this;
  }

  /**
     * Get the value of films
     */
  public function getFilms()
  {
    return $this->films;
  }

  /**
     * Set the value of films
     *
     * @return  self
     */
  public function setFilms($films)
  {
    $this->films = $films;

    return $this;
  }

  /**
     * Get the value of muziek
     */
  public function getMuziek()
  {
    return $this->muziek;
  }

  /**
     * Set the value of muziek
     *
     * @return  self
     */
  public function setMuziek($muziek)
  {
    $this->muziek = $muziek;

    return $this;
  }

  /**
     * Get the value of locatie
     */
  public function getLocatie()
  {
    return $this->locatie;
  }

  /**
     * Set the value of locatie
     *
     * @return  self
     */
  public function setLocatie($locatie)
  {
    $this->locatie = $locatie;

    return $this;
  }

  /**
     * Get the value of boeken
     */
  public function getBoeken()
  {
    return $this->boeken;
  }

  /**
     * Set the value of boeken
     *
     * @return  self
     */
  public function setBoeken($boeken)
  {
    $this->boeken = $boeken;

    return $this;
  }


  /**
     * Set the value of password
     *
     * @return  self
     */
  public function setPassword($password)
  {
    if(empty($password)){
      //throw new Exception("Password can not be empty");
    }else{
      if(strlen($password) < 8){
        throw new Exception("Password must be at least 8 character");
      }else{
        $this->password = $password;
        return $this; 
      }

    }
  }

  /**
     * Get the value of password
     */
  public function getPassword()
  {
    return $this->password;
  }


  public function setConfPassword($confPassword)
  {
    if(empty($confPassword)){
      //throw new Exception("Password can not be empty");
    }else{
      $this->confPassword = $confPassword;
      return $this;
    }
  }

  public function getConfPassword(){
    return $this->confPassword;
  }

  /**
     * Get the value of id
     */
  public function getId()
  {
    return $this->id;
  }

  /**
     * Set the value of id
     *
     * @return  self
     */
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
     * Get the value of profilePicture
     */ 
  public function getProfilePicture()
  {
    return $this->profilePicture;
  }

  /**
     * Set the value of profilePicture
     *
     * @return  self
     */ 
  public function setProfilePicture($profilePicture)
  {
    $this->profilePicture = $profilePicture;

    return $this;
  }

  public function getAll()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('select * from users where id = :userid'); //: verwijst naar een placeholder waar later info in zal worden gestopt
    $userid = $this->getId();
    $statement->bindParam(":userid", $userid);
    $result = $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC); //alle resultaten krijgen
    return $users;
  }

  public function updateSettings()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare("update users set firstname = :firstname, lastname= :lastname, email = :email, picture = :profilePicture where id = :userid");
    $firstname = $this->getFirstname();
    $lastname = $this->getLastname();
    $email = $this->getEmail();
    $userid = $this->getId();
    $profilePicture = $this->getProfilePicture();
    $statement->bindValue(':firstname', $firstname); //we willen op een bepaalde plaats een variabele binden
    $statement->bindValue(':lastname', $lastname);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':userid', $userid);
    $statement->bindValue(':profilePicture', $profilePicture);

    $result = $statement->execute();

    return $result;
  }

  public function saveUser(){
    //$conn=new PDO('mysql:host=localhost;dbname=myBuddyApp;port=8889;',"root","root"); 
    $conn = Db::getConnection();  
    $statement=$conn->prepare("insert into users (firstname,lastname,email,birthday,gender,password,register) values(:firstname,:lastname, :email, :birthday, :gender, :password, :register)");  



    
    $firstname=$this->getFirstname();
    $lastname=$this->getLastname();
    $email=$this->getEmail();
    $birthday=$this->getBirthday();
    $gender=$this->getGender();
    $password=$this->getPassword();
    $confPassword=$this->getConfPassword();
    $register=date("d-m-Y");
    $regex="@student.thomasmore.be";
    $dif=date_diff(date_create($birthday),date_create($register)); 
    $userAge = $dif->format('%y');  

    $stmt = $conn->prepare( "select 1 from users where `email` = ?");
    $stmt->execute([$email]);
    $found = $stmt->fetchColumn();  


    if(empty($email)||empty($firstname)||empty($lastname)||empty($birthday)||empty($gender)||empty($password)||empty($confPassword)){
      throw new Exception("All fields are required");
      //var_dump( $dif);
      //var_dump( $userAge);
      return false;
    }else{

      if(strpos($email,$regex) == false){
        throw new Exception("Please enter a valid email!");
      }else{
        if($userAge < "18"){
          throw new Exception("This birthday invalid!");
        }else{
          if($password !== $confPassword){
            throw new Exception("Password doesn't match!");
          }else{

            if($found){
              throw new Exception("This email already exists!");
              return false;
            }else{
              $pass = $this->getPassword();
              $password = password_hash($pass,PASSWORD_DEFAULT,['cost'=>13]);
              $statement->bindValue(":firstname",$firstname );
              $statement->bindValue(":lastname",$lastname );
              $statement->bindValue(":email",$email);
              $statement->bindValue(":birthday",$birthday);
              $statement->bindValue(":gender",$gender);
              $statement->bindValue(":password",$password);
              $statement->bindValue(":register",$register);



              $result = $statement->execute();

              return $result;
            }


          }

        }  
      }


    }








  }

    function canLogin($email, $password){
        $conn = Db::getConnection();
        $email = $conn->real_escape_string($email);
        $query = "select * from users where email = '$email'";
        $result = $conn->query($query);
        $user = $result->fetch(PDO::FETCH_ASSOC);
    if(password_verify($password, $user['password'])){
        return true;
    }else{
        return false;
    }
}










}