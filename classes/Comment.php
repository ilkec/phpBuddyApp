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


        // to get and set a IDea

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
            return $this;
        }

        //to get the parents (so you can cry)
        
        public function getParent_id()
        {
            return $this->parent_id;
        }

        public function setParent_Id($parent_id)
        {
            $this->parent_id = $parent_id;
            return $this;
        }

        // now we gonna get and set the name of the sender (who send you a ransom note(but deep down you know your parent aren't gonna pay to 'get' you out or 'set' you free))

        public function getSenderName()
        {
            return $this->senderName;
        }

        public function setSenderName($senderName)
        {
            $this->senderName = $senderName;
            return $this;
        }

        // get and set title (of a movie we shall not name)

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

        //to get and set the a date (if she/he doesn't turn you down)

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

        public function test(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM tbl_comment");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function addComment(){
            $conn = Db::getConnection();
            $parentcomment_id = $this->getParent_id();
            $senderName = $this->getSenderName();
            $comment = $this->getComment();
            $title = $this->getTitle();
            $statement = $conn->prepare("INSERT INTO tbl_comment(parent_comment_id, comment, comment_sender_name, comment_title) VALUES (:parent_comment_id, :comment, :comment_sendername, :comment_title)");
            $statement->bindValue(":parent_comment_id", $parentcomment_id);
            $statement->bindValue(":comment", $comment);
            $statement->bindValue(":comment_sendername", $senderName);
            $statement->bindValue(":comment_title", $title);
            $result = $statement->execute();
            return $result;
        }

        public function setPinned($pinnedId){
            $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE tbl_comment SET pinned = true WHERE comment_id = :comment_id");

            $comment_id = $pinnedId;

            $statement->bindValue("comment_id", $comment_id);
            $result = $statement->execute();
            return $result;
        }

        public function getAllPinned(){ ///hier kieke
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM tbl_comment WHERE Pinned = 1 ORDER BY comment_id DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $output = '';
            foreach($result as $row){ //deze klasse hier :)
                $output .= '
                    <div class="comment_container">
                        <div class="comment_header"> <h3>' .$row["comment_sender_name"]. '</h3> </div>
                        <p> ' .$row["date"]. ' </p> 
                        <div class="comment_body"> 
                            <p> <h5> ' .$row["comment_title"]. ' </h5> </p>
                            <p> ' .$row["comment"]. ' </p>
                        </div>
                        <div class="comment_footer"><form action="" method="GET">
                            <input type="hidden" name="parent" value="'.$row["comment_id"].'">
                            <input class="reply_btn" type="submit" id="'.$row["comment_id"].'" value="Reply">
                        </form></div>
                    </div>
                ' . $this->getReplies(false, $conn, $row["comment_id"]);
            }
            return $output;
        }

        public function getReplies($isModerator, $conn, $parent_id, $margin_left = 0){
            //testing for stylising the reply box
            $reply_style = 'border: 2px solid grey;
            border-radius: 4px;
            width: 70%;
            height: 150px;
            padding-left: 15px;
            padding-bottom: 160px;
            margin-top: 25px;
            margin-bottom: 50px;';
            $statement = $conn->prepare("SELECT * FROM tbl_comment WHERE parent_comment_id = :parent_id ORDER BY comment_id DESC");
            $statement->bindValue(':parent_id', $parent_id);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $count = $statement->rowCount();
            $output = '';
            $pinAppend = '';
            if($parent_id == 0){
                $margin_left = 0;
            }else{
                $margin_left = $margin_left + 125;
            }
            if($count > 0){
                foreach($result as $row){
                    if($isModerator){
                        $pinAppend = '
                            <form action="" method="POST">
                                <input type="hidden" name="pin" value="'.$row["comment_id"].'">
                                <input class="pin_btn" type="submit" value="Pin">
                            </form>
                        ';
                    }
                    $output .= '
                    <div class="reply_container" style=" '.$reply_style.'margin-left: '.$margin_left.'px">
                        '.$pinAppend.'
                        <div class="comment_header"> <h3>' .$row["comment_sender_name"]. '</h3> </div>
                        <p> ' .$row["date"]. ' </p> 
                        <div class="comment_body"> 
                            <p> <h5> ' .$row["comment_title"]. ' </h5> </p>
                            <p> ' .$row["comment"]. ' </p>
                        </div>
                        <div class="comment_footer"><form action="" method="GET">
                            <input type="hidden" name="parent" value="'.$row["comment_id"].'">
                            <input class="reply_btn" type="submit" id="'.$row["comment_id"].'" value="Reply">
                        </form></div>
                    </div>
                ' . $this->getReplies($isModerator, $conn, $row["comment_id"]);
                }
            }
            return $output;
        }

        public function getAllComments($isModerator){
            $conn = Db::getConnection();
            //get all stand alone comments
            $statement = $conn->prepare("SELECT * FROM tbl_comment WHERE parent_comment_id = '0' ORDER BY comment_id DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $output = '';
            $pinAppend = ''; 
            foreach($result as $row){
                if($isModerator){
                    $pinAppend = '
                        <form action="" method="POST">
                            <input type="hidden" name="pin" value="'.$row["comment_id"].'">
                            <input class="pin_btn" type="submit" value="Pin">
                        </form>
                    ';
                }
                $output .= '
                    <div class="comment_container">
                        '.$pinAppend.'
                        <div class="comment_header"> <h3>' .$row["comment_sender_name"]. '</h3> </div>
                        <p> ' .$row["date"]. ' </p> 
                        <div class="comment_body"> 
                            <p> <h5> ' .$row["comment_title"]. ' </h5> </p>
                            <p> ' .$row["comment"]. ' </p>
                        </div>
                        <div class="comment_footer"><form action="" method="GET">
                            <input type="hidden" name="parent" value="'.$row["comment_id"].'">
                            <input class="reply_btn" type="submit" id="'.$row["comment_id"].'" value="Reply">
                        </form></div>
                    </div>
                ' . $this->getReplies($isModerator, $conn, $row["comment_id"]);
            }
            return $output;
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