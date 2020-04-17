<?php

include_once(__DIR__ . "/phpMailer/src/Exception.php");
include_once(__DIR__ . "/phpMailer/src/PHPMailer.php");
include_once(__DIR__ . "/phpMailer/src/SMTP.php");
include_once(__DIR__ . "/Db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
  private $music;
  private $location;
  private $books;
  private $buddy;
  private $reden;

  //variables used for message system
  private $message;
  private $fromUser;
  private $toUser;
  private $time;







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
    if (!empty($birthday)) {
    $regex="/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/";
      if(preg_match($regex,$birthday)){
      }else{
       throw new Exception("Birthday is not in the correct format. It must be like YYYY-MM-DD");
      }
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
   * Get the value of music
   */
  public function getMusic()
  {
    return $this->music;
  }

  /**
   * Set the value of music
   *
   * @return  self
   */
  public function setMusic($music)
  {
    $this->music = $music;

    return $this;
  }

  /**
   * Get the value of location
   */
  public function getLocation()
  {
    return $this->location;
  }

  /**
   * Set the value of location
   *
   * @return  self
   */
  public function setLocation($location)
  {
    $this->location = $location;

    return $this;
  }

  /**
   * Get the value of books
   */
  public function getBooks()
  {
    return $this->books;
  }

  /**
   * Set the value of books
   *
   * @return  self
   */
  public function setBooks($books)
  {
    $this->books = $books;

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


  /**
   * Get the value of buddy
   */
  public function getBuddy()
  {
    return $this->buddy;
  }

  /**
   * Set the value of buddy
   *
   * @return  self
   */
  public function setBuddy($buddy)
  {
    $this->buddy = $buddy;

    return $this;
  }


  /**
   * Get the value of message
   */
  public function getMessage()
  {
    return $this->message;
  }

  /**
   * Set the value of message
   *
   * @return  self
   */
  public function setMessage($message)
  {
    $this->message = $message;

    return $this;
  }

  /**
   * Get the value of fromUser
   */
  public function getFromUser()
  {
    return $this->fromUser;
  }

  /**
   * Set the value of fromUser
   *
   * @return  self
   */
  public function setFromUser($fromUser)
  {
    $this->fromUser = $fromUser;

    return $this;
  }

  /**
   * Get the value of toUser
   */
  public function getToUser()
  {
    return $this->toUser;
  }

  /**
   * Set the value of toUser
   *
   * @return  self
   */
  public function setToUser($toUser)
  {
    $this->toUser = $toUser;

    return $this;
  }
  /**
   * Get the value of time
   */
  public function getTime()
  {
    return $this->time;
  }

  /**
   * Set the value of time
   *
   * @return  self
   */
  public function setTime($time)
  {
    $this->time = $time;

    return $this;
  }


  /**
   * Get the value of reden
   */
  public function getReden()
  {
    return $this->reden;
  }

  /**
   * Set the value of reden
   *
   * @return  self
   */
  public function setReden($reden)
  {
    $this->reden = $reden;

    return $this;
  }

  public function countUsers()
  {

    $conn = Db::getConnection();
    $statement = $conn->prepare('select count(*) as registeredUsers from users');
    $result = $statement->execute();
    $users = $statement->fetch(PDO::FETCH_ASSOC);
    return $users;
  }

  public function sendMatchRequest()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare("insert into matches (user_id1, user_id2, buddy_match) values(:userId, :buddyId, false)");
    $fromUser = $this->getFromUser();
    $toUser = $this->getToUser();
    $statement->bindValue(":userId", $fromUser);
    $statement->bindValue(":buddyId", $toUser);
    $result = $statement->execute();
    //var_dump($result);
    return $result;
  }

  public function receiveMatchRequest()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare("select distinct users.firstname, ' ' ,users.lastname from matches,users where matches.user_id1 = :userid and matches.buddy_match='0' and users.id = matches.user_id2");
    $userid = $this->getId();
    $statement->bindParam(":userid", $userid);
    $result = $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);
    return $users;
  }

  public function acceptMatchRequest()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare("update matches set buddy_match = '1' where user_id1 = :userid and users_id2 = :buddyid");
    $userid = $this->getFromUser();
    $buddyid = $this->getToUser();
    $statement->bindParam(":userid", $userid);
    $statement->bindParam(":buddyid", $buddyid);
    $result = $statement->execute();
    // var_dump($result);
    return $result;
  }

  public function deleteMatchRequest()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare("update matches set buddy_match = '0' where user_id1 = :userid and user_id2 = :buddyid");
    $userid = $this->getId();
    $buddyid = $this->getToUser();
    $statement->bindParam(":userid", $userid);
    $statement->bindParam(":buddyid", $buddyid);
    $result = $statement->execute();
    // var_dump($result);
    return $result;
  }

  public function geefReden()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare("update matches set reden = :reden where user_id1 = :userid and user_id2 = :buddyid and buddy_match = '0'");
    $userid = $this->getId();
    $buddyid = $this->getToUser();
    $reden = $this->getReden();
    $statement->bindParam(":reden", $reden);
    $statement->bindParam(":userid", $userid);
    $statement->bindParam(":buddyid", $buddyid);
    $result = $statement->execute();
    // var_dump($result);
    return $result;
  }

  public function checkBuddy()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare("select distinct users.firstname, ' ' ,users.lastname from matches,users where matches.user_id1 = :userid and matches.buddy_match='1' and users.id = matches.user_id2");
    $userid = $this->getId();
    // $buddyid = $this->getBuddy();
    $statement->bindParam(":userid", $userid);
    // $statement->bindParam(":buddyid", $buddyid);
    $result = $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result);
    return $users;
  }

  
  public function sendMatchMail()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare("select email from users where id = :buddyId");
    $toUser = $this->getToUser();
    $statement->bindValue(":buddyId", $toUser);
    $result = $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $mail = new PHPMailer(true);
    var_dump($result);

    try {
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->isSMTP();
      $mail->SMTPAuth   = true;
      $mail->setFrom('noreply@noreply.com', 'Mailer');
      $mail->addAddress($result);
      $mail->isHTML(true);
      $mail->Subject = 'Buddy request';
      $mail->Body    = 'Check your buddy app, you have recieved a new friend request';
      $mail->AltBody = 'Check your buddy app, you have recieved a new friend request';

      $mail->send();
      echo 'Message has been sent';
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    return $result;
  }

  public function newMessage(){
    $conn = Db::getConnection();
    $statement = $conn->prepare('select * from messages where message_status = 1');
    $result = $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($users);
    return $users;
    
  }
  public function updateNotification(){
    $conn = Db::getConnection();
    $statement = $conn->prepare('update messages set message_status = 0 where (from_user = :fromUser  and to_user = :toUser and message_status = 1) or (from_user = :toUser and to_user = :fromUser and message_status = 1)');
    $fromUser = $this->getFromUser();
    $toUser = $this->getToUser();
    $statement->bindValue(":fromUser", $fromUser);
    $statement->bindValue(":toUser", $toUser);
    $result = $statement->execute();
    return $result;
  }

  public function chatNames(){
    $conn = Db::getConnection();
    $statement = $conn->prepare('select matches.user_id1, matches.user_id2, user1.firstname as user1, user2.firstname as user2 from users as user1, matches, users as user2 where (matches.user_id1 = :fromUser and matches.user_id1 = user1.id and user_id2 = user2.id) or (matches.user_id2 = :fromUser and matches.user_id1 = user1.id and user_id2 = user2.id)');
    $fromUser = $this->getId();
    $statement->bindValue(":fromUser", $fromUser);
    $result = $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC); //alle resultaten krijgen
    return $users;
  
  }


  public function sendMessage()
  {

    $conn = Db::getConnection();
    $statement = $conn->prepare('insert into messages (from_user, to_user, message, date_time, message_status) values(:fromUser, :toUser, :message, :time, 1)');
    $fromUser = $this->getFromUser();
    $toUser = $this->getToUser();
    $message = $this->getMessage();
    $time = $this->getTime();
    $statement->bindValue(":fromUser", $fromUser);
    $statement->bindValue(":toUser", $toUser);
    $statement->bindValue(":message", $message);
    $statement->bindValue(":time", $time);
    $result = $statement->execute();

    return $result;
  }

  public function messagesFromDatabase()
  {

    $conn = Db::getConnection();

    $statement = $conn->prepare('select messages.message, messages.from_user, messages.to_user, user1.firstname as fromUser, user2.firstname as toUser 
    from users as user1, messages, users as user2 
    where (from_user = :fromUser  and to_user = :toUser and messages.from_user = user1.id and messages.to_user = user2.id) or (from_user = :toUser and to_user = :fromUser and messages.from_user = user1.id and messages.to_user = user2.id) ORDER BY date_time ASC');
    $fromUser = $this->getFromUser();
    $toUser = $this->getToUser();
    $statement->bindValue(":fromUser", $fromUser);
    $statement->bindValue(":toUser", $toUser);
    $result = $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC); //alle resultaten krijgen
    return $users;
    var_dump($users);
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
              //header("Location: feature4.php");
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
    return $userId;
    //var_dump($userId);


  }


  public function getConnectedUserFirstname()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('select firstname from users where email = :email');
    $email = $this->getEmail();
    $statement->bindValue(':email', $email);
    $result = $statement->execute();
    $userFirstname = $statement->fetch(PDO::FETCH_ASSOC);
    return $userFirstname;
    var_dump($userFirstname);
  }
  public function getConnectedUserLastname()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('select lastname from users where email = :email');
    $email = $this->getEmail();
    $statement->bindValue(':email', $email);
    $result = $statement->execute();
    $userLastname = $statement->fetch(PDO::FETCH_ASSOC);
    return $userLastname;
    var_dump($userLastname);
  }

  public function getConnectedUserPicture()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('select picture from users where email = :email');
    $email = $this->getEmail();
    $statement->bindValue(':email', $email);
    $result = $statement->execute();
    $userPicture = $statement->fetch(PDO::FETCH_ASSOC);
    return $userPicture;
    var_dump($userPicture);
  }

  public function getConnectedUserGame()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('select games from users where email = :email');
    $email = $this->getEmail();
    $statement->bindValue(':email', $email);
    $result = $statement->execute();
    $userGame = $statement->fetch(PDO::FETCH_ASSOC);
    return $userGame;
    var_dump($userGame);
  }


  public function getConnectedUserMovie()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('select films from users where email = :email');
    $email = $this->getEmail();
    $statement->bindValue(':email', $email);
    $result = $statement->execute();
    $userMovie = $statement->fetch(PDO::FETCH_ASSOC);
    return $userMovie;
    var_dump($userMovie);
  }

  public function getConnectedUserBook()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('select books from users where email = :email');
    $email = $this->getEmail();
    $statement->bindValue(':email', $email);
    $result = $statement->execute();
    $userBook = $statement->fetch(PDO::FETCH_ASSOC);
    return $userBook;
    var_dump($userBook);
  }

  public function getConnectedUserLocation()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('select location from users where email = :email');
    $email = $this->getEmail();
    $statement->bindValue(':email', $email);
    $result = $statement->execute();
    $userLocation = $statement->fetch(PDO::FETCH_ASSOC);
    return $userLocation;
    var_dump($userLocation);
  }

  public function getConnectedUserMusic()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('select music from users where email = :email');
    $email = $this->getEmail();
    $statement->bindValue(':email', $email);
    $result = $statement->execute();
    $userMusic = $statement->fetch(PDO::FETCH_ASSOC);
    return $userMusic;
    var_dump($userMusic);
  }
  
  public function getConnectedUserBuddyChoice()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('select buddy from users where email = :email');
    $email = $this->getEmail();
    $statement->bindValue(':email', $email);
    $result = $statement->execute();
    $userBuddyChoice = $statement->fetch(PDO::FETCH_ASSOC);
    return $userBuddyChoice;
   var_dump($userBuddyChoice);
  }



  public function canLogin($email, $password)
  {

    $conn = Db::getConnection();
    $statement = $conn->prepare('select * from users where email = :email');
    //echo $email;
    $statement->bindParam(':email', $email);
    $result = $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    //var_dump($result);
    //var_dump($user);

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
    $statement = $conn->prepare("update users set games = :games, films = :films, music = :music, location = :location, books = :books where id = :id");

    $games = $this->getGames();
    $films = $this->getFilms();
    $music = $this->getMusic();
    $location = $this->getLocation();
    $books = $this->getBooks();
    $id = $this->getId();

    $statement->bindValue(":games", $games);
    $statement->bindValue(":films", $films);
    $statement->bindValue(":music", $music);
    $statement->bindValue(":location", $location);
    $statement->bindValue(":books", $books);
    $statement->bindValue(":id", $id);

    $result = $statement->execute();
    //var_dump($result);

    return $result;
  }


  public function matchUser()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('SELECT id, picture, firstname, lastname, games, films, music, location, books FROM users WHERE (games = :games OR films = :films OR music = :music OR location = :location OR books = :books) AND email <> :email');

    $games = $this->getGames();
    $films = $this->getFilms();
    $music = $this->getMusic();
    $location = $this->getLocation();
    $books = $this->getBooks();
    $email = $this->getEmail();

    $statement->bindValue(":games", $games);
    $statement->bindValue(":films", $films);
    $statement->bindValue(":music", $music);
    $statement->bindValue(":location", $location);
    $statement->bindValue(":books", $books);
    $statement->bindValue(":email", $email);



    $statement->execute();

    // $result = $statement->fetchAll();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
    // return $result;
  }

  public function saveChoice()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('update users set buddy = :buddy where id = :id');

    $buddy = $this->getBuddy();
    $id = $this->getId();

    $statement->bindValue(":buddy", $buddy);
    $statement->bindValue(":id", $id);

    $statement->execute();
  }


  public function showMatches()
  {
    $conn = Db::getConnection();
    $statement = $conn->prepare('select matches.id, user1.picture as picture1, user1.firstname as firstname1, user1.lastname as lastname1, user2.picture as picture2, user2.firstname as firstname2, user2.lastname as lastname2 from users as user1, users as user2, matches where matches.user_id1 = user1.id and matches.user_id2 = user2.id and buddy_match = 1');
    $result = $statement->execute();
    $matches = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $matches;
    //var_dump($matches);
  }
}
