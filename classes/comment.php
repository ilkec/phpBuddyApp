<?php 
    include_once(__DIR__ . "/Db.php");
    include_once(__DIR__ . "/User.php");

    class comment
    {
        private $id;
        private $parent_id;
        private $senderName;
        private $title;
        private $comment;
        private $date;

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

        public function getAllComments(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM tbl_comment WHERE parent_comment_id = '0' ORDER BY comment_id DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $output = '';
            foreach($result as $row){
                $output .= '
                    <div class="comment_container">
                        <div class="comment_header"> <h2>' .$row["comment_title"]. '</h2> </div>
                        <div class="comment_body"> <p> ' .$row["comment"]. ' </p>
                        <p> ' .$row["comment_sender_name"]. ' </p>
                        <p> ' .$row["date"]. ' </p> </div>
                        <div class="comment_footer"><button type="button" id="'.$row["comment_id"].'">Reply</button></div>
                    </div>
                ';
            }
            return $output;
        }
    }
?>