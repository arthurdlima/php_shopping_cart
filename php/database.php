<?php


class CreateDb
{
        public $servername;
        public $username;
        private $password;
        public $dbname;
        public $tablename;
        public $con;


        // class constructor (has to have the __ )
    public function __construct(
        $dbname = "",
        $tablename = "",
        $servername = "",
        $username = "",
        $password = ''
    )
    {
      $this->dbname = $dbname;
      $this->tablename = $tablename;
      $this->servername = $servername;
      $this->username = $username;
      $this->password = $password;
      // create connection
        $this->con = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$this->con){
            die("Connection failed : " . mysqli_connect_error());
        }
    }

    // get product from the database
    public function getData(){
        $sql = "SELECT * FROM $this->tablename";

        $result = mysqli_query($this->con, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
}
