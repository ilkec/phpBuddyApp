<?php 
    include_once(__DIR__ . "/Db.php");
    include_once(__DIR__ . "/User.php");

    class Comment
    {
        private $id;
        private $parent_id;
        private $senderName;
        private $title;
        private $comment;
        private $date;

        /*variables for chatbox */

        private $message;
        private $from;
        private $receiver;
        private $datetime;


        // to get and set a Id

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }

        //to get the parents 
        
        public function getParent_id()
        {
            return $this->parent_id;
        }

        public function setParent_Id($parent_id)
        {
            $this->parent_id = $parent_id;
            return $this;
        }

        // now we gonna get and set the name of the sender 

        public function getSenderName()
        {
            return $this->senderName;
        }

        public function setSenderName($senderName)
        {
            $this->senderName = $senderName;
            return $this;
        }

        // get and set title

        public function getTitle()
        {
            return $this->title;
        }

        public function setTitle($title)
        {
            $this->title = $title;
            return $this;
        }

        //to set and get a comment

        public function getComment()
        {
            return $this->comment;
        }

        public function setComment($comment)
        {
            $this->comment = $comment;
            return $this;
        }

        //to get and set the a date 

        public function getDate()
        {
            return $this->date;
        }

        public function setDate($date)
        {
            $this->date = $date;
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

        public function test()
        {
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM comment");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function addComment()
        {
            $conn = Db::getConnection();
            $parentcomment_id = $this->getParent_id();
            $senderName = $this->getSenderName();
            $comment = $this->getComment();
            $title = $this->getTitle();
            $statement = $conn->prepare("INSERT INTO comment(parent_comment_id, comment, comment_sender_name, comment_title,upvote_count) VALUES (:parent_comment_id, :comment, :comment_sendername, :comment_title, 0)");
            $statement->bindValue(":parent_comment_id", $parentcomment_id);
            $statement->bindValue(":comment", $comment);
            $statement->bindValue(":comment_sendername", $senderName);
            $statement->bindValue(":comment_title", $title);
            $result = $statement->execute();
            return $result;
        }

        public function setPinned($pinnedId)
        {
            $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE comment SET pinned = true WHERE id = :id");

            $id = $pinnedId;

            $statement->bindValue("id", $id);
            $result = $statement->execute();
            return $result;
        }

        public function getAllPinned()
        { ///hier kieke
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM comment WHERE Pinned = 1 ORDER BY id DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getReplies($parent_id){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM comment WHERE parent_comment_id = :parent_id ORDER BY id DESC");
            $statement->bindValue(':parent_id', $parent_id);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getAllComments(){
            $conn = Db::getConnection();
            //get all stand alone comments
            $statement = $conn->prepare("SELECT * FROM comment WHERE parent_comment_id = '0' ORDER BY upvote_count DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);       
            return $result;
        }

        public function sendToDatabase()
        {
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

        public function upvoteUpdate($commentid, $upvotecount)
        {
            $conn = Db::getConnection();
            $statement = $conn->prepare('update comment set upvote_count = :upvotecount where id = :commentid');
            $upvotecount = $upvotecount;
            $id = $commentid;
            $statement->bindValue(":upvotecount", $upvotecount);
            $statement->bindValue(":commentid", $id);
            $result = $statement->execute();
            return $result;
      
        }
        public function upvoteInsert($userid, $commentid)
        {
            $conn = Db::getConnection();
            $statement = $conn->prepare('insert into upvote (user_id, comment_id, active) values(:userid, :commentid, 1)');
            $userid = $userid;
            $commentid =  $commentid;
            $statement->bindValue(":userid", $userid);
            $statement->bindValue(":commentid", $commentid);
           
            $result = $statement->execute();
            
            return $result;
        }

        public function getUpvoter(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select comment_id from upvote where user_id = :userid");
            $userid = $this->getId();
            $statement->bindValue(':userid', $userid);
            $result = $statement->execute();
            $upvoter = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $upvoter;

        }
        
    }