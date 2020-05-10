<?php 
    include_once(__DIR__ . "/Db.php");

    class Post
    {
        private $id;
    

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