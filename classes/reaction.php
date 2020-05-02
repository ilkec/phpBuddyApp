<?php

include_once(__DIR__ .'../../classes/Db.php');

class Reaction{
  private $reactionId;
  private $messageId;
  private $userId;


  public function getReactionId(){
    return $this->reactionId;
  }

public function setReactionId($reactionId){
   $this->reactionId=$reactionId;
  return $this;
  }

 public function getMessageId(){
    return $this->messageId;
  }
public function setMessageId($messageId){
   $this->messageId=$messageId;
  return $this;
  }

 public function getUserId(){
    return $this->userId;
  }
public function setUserId($userId){
   $this->userId=$userId;
  return $this;
  }
  

  public function save(){
     $conn = Db::getConnection();
     $statement = $conn->prepare("INSERT INTO message_reactions ( `msg_id`, `usr_id`, `reaction_id`) VALUES (:msgId,:uId,:idReaction)");
     $messegeId = $this->getMessageId();
     $userId = $this->getUserId();
     $reactionId = $this->getReactionId();
    
    $statement->bindValue(":msgId",$messegeId);
    $statement->bindValue(":uId",$userId);
    $statement->bindValue(":idReaction",$reactionId);
    $result = $statement->execute();
    return $result;
  }
  
  public static function getAll($userId){
     $conn = Db::getConnection();
     //$statement = $conn->prepare("SELECT reaction.src FROM message_reactions,reaction, messages where message_reactions.usr_id = :uId and message_reactions.msg_id = messages.id");
     
    $statement = $conn->prepare("SELECT users.id,messages.message, users.firstname, users.lastname,message_reactions.reaction_id ,reaction.src
FROM users
INNER JOIN message_reactions ON users.id = message_reactions.usr_id 
INNER JOIN reaction ON message_reactions.reaction_id = reaction.id 
INNER JOIN messages ON message_reactions.msg_id = messages.id");
   
    $result = $statement->execute();
  
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  
  
  

}