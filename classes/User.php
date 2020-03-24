<?php

include_once(__DIR__ . "/Db.php");
class User
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
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
        $this->email = $email;

        return $this;
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
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
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

    public function update()
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("update users set firstname = :firstname, lastname= :lastname, email = :email where id = :userid");
        $firstname = $this->getFirstname();
        $lastname = $this->getLastname();
        $email = $this->getEmail();
        $userid = $this->getId();
        $statement->bindValue(':firstname', $firstname); //we willen op een bepaalde plaats een variabele binden
        $statement->bindValue(':lastname', $lastname);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':userid', $userid);

        $result = $statement->execute();

        return $result;
    }
}
