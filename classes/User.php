<?php

class User
{
    private $firstname;
    private $lastname;
    private $email;
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
}
