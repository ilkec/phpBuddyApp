<?php 
include_once(__DIR__ . "/Db.php");

class Comment{

    private $message;
    private $from;
    private $receiver;
    private $datetime;
  

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
     * Get the value of from
     */ 
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set the value of from
     *
     * @return  self
     */ 
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get the value of receiver
     */ 
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set the value of receiver
     *
     * @return  self
     */ 
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get the value of datetime
     */ 
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set the value of datetime
     *
     * @return  self
     */ 
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

   

    public function sendToDatabase(){
        $conn = Db::getConnection();
        $statement = $conn->prepare('insert into messages (from_user, to_user, message, date_time, message_status) values(:from, :receiver, :message, :time, 1)');
        $from = $this->getFrom();
        $receiver = $this->getReceiver();
        $message = $this->getMessage();
        $time = $this->getDatetime();
        $statement->bindValue(":from", $from);
        $statement->bindValue(":receiver", $receiver);
        $statement->bindValue(":message", $message);
        $statement->bindValue(":time", $time);
        $result = $statement->execute();
    
        return $result;
    }
}