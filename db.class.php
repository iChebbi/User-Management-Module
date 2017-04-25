<?php
class DB {

    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'client';
    private $db;

    public function __construct($host = null, $username = null, $password = null, $database = null){
        if($host != null)
        {
            $this->host = $host;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;

        }
        try{
            $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                PDO::ATTR_ERRMODE =>PDO::ERRMODE_WARNING));
        }catch(PDOException $e)
        {
            echo "<div class='alert alert-danger col-lg-6'>
Can't Connect to the Database</div>";
		}
    }

    public function query($sql, $data = array()){
        try {
        $req = $this->db->prepare($sql);
        $paramIndex = 1;
        foreach ($data as $param) {
            $req->bindParam($paramIndex++,$param);
        }
        $req->execute($data);
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger col-lg-6'>Invalid query</div>";
        }
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}