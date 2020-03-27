<?php

include_once(__DIR__ . "/Db.php");
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
  private $passwordNew;
  private $description;
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
    if (empty($firstname)) {
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
    if (empty($lastname)) {
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
    if (!empty($email)) {
      $this->email = $email;
      return $this;
    } else {
      return '';
    }
  }



  public function setGender($gender)
  {

    $this->gender = $gender;

    return $this;
  }

  public function getGender()
  {
    return $this->gender;
  }


  public function setBirthday($birthday)
  {
    if (empty($birthday)) {
      //throw new Exception("Birthday can not be empty");
    }
    $this->birthday = $birthday;
    return $this;
  }

  public function getBirthday()
  {


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
    if (empty($password)) {
      //throw new Exception("Password can not be empty");
    } else {
      if (strlen($password) < 8) {
        throw new Exception("Password must be at least 8 character");
      } else {
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
    if (empty($confPassword)) {
      //throw new Exception("Password can not be empty");
    } else {
      $this->confPassword = $confPassword;
      return $this;
    }
  }

  public function getConfPassword()
  {
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
  /**
   * Get the value of passwordNew
   */
  public function getPasswordNew()
  {
    return $this->passwordNew;
  }

  /**
   * Set the value of passwordNew
   *
   * @return  self
   */
  public function setPasswordNew($passwordNew)
  {
    $this->passwordNew = $passwordNew;

    return $this;
  }
  /**
   * Get the value of description
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set the value of description
   *
   * @return  self
   */
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }


  public function getAll()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('select * from users where id = :userid'); //: verwijst naar een placeholder waar later info in zal worden gestopt
    $userid = $this->getId();
    $statement->bindParam(":userid", $userid);
    $result = $statement->execute();
    $users = $statement->fetch(PDO::FETCH_ASSOC); //alle resultaten krijgen
    return $users;
  }
  public function updatePicture()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare("update users set picture = :profilePicture where id = :userid");
    $userid = $this->getId();
    $profilePicture = $this->getProfilePicture();
    $statement->bindValue(':userid', $userid);
    $statement->bindValue(':profilePicture', $profilePicture);
    $result = $statement->execute();

    return $result;
  }
  public function updatePassword()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare("update users set password = :password where id = :userid");
    $userid = $this->getId();
    $passwordNew = $this->getPasswordNew();
    $statement->bindValue(':userid', $userid);
    $statement->bindValue(':password', $passwordNew);
    $result = $statement->execute();

    return $result;
  }
  public function updateEmail()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare("update users set email = :email where id = :userid");
    $userid = $this->getId();
    $email = $this->getEmail();
    $statement->bindValue(':userid', $userid);
    $statement->bindValue(':email', $email);
    $result = $statement->execute();

    return $result;
  }
  public function updateProfile()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare("update users set firstname = :firstname, lastname= :lastname, description = :description where id = :userid");
    $firstname = $this->getFirstname();
    $lastname = $this->getLastname();
    $description = $this->getDescription();
    $userid = $this->getId();

    $statement->bindValue(':firstname', $firstname); //we willen op een bepaalde plaats een variabele binden
    $statement->bindValue(':lastname', $lastname);
    $statement->bindValue(':userid', $userid);

    $statement->bindValue(':description', $description);
    $result = $statement->execute();

    return $result;
  }

  public function checkPassword($oldPassword)
  {

    $conn = Db::getConnection();

    $statement = $conn->prepare("select * from users where id = :userid");
    $userid = $this->getId();
    $statement->bindParam(":userid", $userid);
    $result = $statement->execute();
    $users = $statement->fetch(PDO::FETCH_ASSOC);
    $hash = $users['password'];

    //echo $hash . "<br>";
    //echo $oldPassword . "<br>";
    if (password_verify($oldPassword, $hash)) {   //gaat het password n^x encrypten en vergelijken met de hash
      return true; //checkPassword functie wil weten of het true is
    } else {
      return false;
    }
  }

  public function saveUser()
  {
    $conn = Db::getConnection();

    $statement = $conn->prepare("insert into users (firstname,lastname,email,birthday,gender,password,register) values(:firstname,:lastname, :email, :birthday, :gender, :password, :register)");

    $firstname = $this->getFirstname();
    $lastname = $this->getLastname();
    $email = $this->getEmail();
    $birthday = $this->getBirthday();
    $gender = $this->getGender();
    $password = $this->getPassword();
    $confPassword = $this->getConfPassword();
    $register = date("d-m-Y");
    $regex = "@student.thomasmore.be";
    $dif = date_diff(date_create($birthday), date_create($register));
    $userAge = $dif->format('%y');

    $stmt = $conn->prepare("select 1 from users where `email` = ?");
    $stmt->execute([$email]);
    $found = $stmt->fetchColumn();


    if (empty($email) || empty($firstname) || empty($lastname) || empty($birthday) || empty($gender) || empty($password) || empty($confPassword)) {
      throw new Exception("All fields are required");
      //var_dump( $dif);
      //var_dump( $userAge);
      return false;
    } else {

      if (strpos($email, $regex) == false) {
        throw new Exception("Please enter a valid email!");
      } else {
        if ($userAge < "18") {
          throw new Exception("This birthday invalid!");
        } else {
          if ($password !== $confPassword) {
            throw new Exception("Password doesn't match!");
          } else {
            if ($found) {
              throw new Exception("This email already exists!");
              return false;
            } else {
              $pass = $this->getPassword();
              $password = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 13]);
              $statement->bindValue(":firstname", $firstname);
              $statement->bindValue(":lastname", $lastname);
              $statement->bindValue(":email", $email);
              $statement->bindValue(":birthday", $birthday);
              $statement->bindValue(":gender", $gender);
              $statement->bindValue(":password", $password);
              $statement->bindValue(":register", $register);
              $result = $statement->execute();
              header("Location: feature4.php");
              var_dump($result);
              return $result;
            }
          }
        }
      }
    }
  }

  public function getDatabaseId()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('select id from users where email = :email');
    $email = $this->getEmail();
    $statement->bindValue(':email', $email);
    $result = $statement->execute();
    $userId = $statement->fetch(PDO::FETCH_ASSOC);
    var_dump($userId);
  }

  public function canLogin($email, $password)
  {

    $conn = Db::getConnection();
    $statement = $conn->prepare('select * from users where email = :email');
    //echo $email;
    $statement->bindParam(':email', $email);
    $result = $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    var_dump($result);
    var_dump($user);

    $hash = $user["password"];
    if (password_verify($password, $hash)) {
      return true;
    } else {
      return false;
    }
  }

  public function saveInterests()
  {
    $conn = Db::getConnection();

    $statement = $conn->prepare("insert into users (games, films, music, location, books) values (:games, :films, :music, :location, :books)");

    $games = $this->getGames();
    $films = $this->getFilms();
    $muziek = $this->getMuziek();
    $locatie = $this->getLocatie();
    $boeken = $this->getBoeken();

    $statement->bindValue(":games", $games);
    $statement->bindValue(":films", $films);
    $statement->bindValue(":music", $muziek);
    $statement->bindValue(":location", $locatie);
    $statement->bindValue(":books", $boeken);

    $result = $statement->execute();

    return $result;
  }
}
