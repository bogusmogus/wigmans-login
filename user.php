<?php
// Functie: classdefinitie User 
// Auteur: willemdaniel

class User
{

    // Eigenschappen 
    public $username;
    /* public $email; */
    private $password;

    function SetPassword($password)
    {
        $this->password = $password;
    }
    function GetPassword()
    {
        return $this->password;
    }

    public function ShowUser()
    {
        echo "<br>Username: $this->username<br>";
        echo "<br>Password: $this->password<br>";
        /* echo "<br>Email: $this->email<br>"; */
    }

    public function RegisterUser()
    {
        $status = false;
        $errors = [];
        if ($this->username != "" || $this->password != "") {

            // Check user exist
            if (true) {
                array_push($errors, "Username bestaat al.");
            } else {
                // username opslaan in tabel login
                // INSERT INTO `user` (`username`, `password`, `role`) VALUES ('kjhasdasdkjhsak', 'asdasdasdasdas', '');
                // Manier 1

                $status = true;
            }
        }
        return $errors;
    }

    function ValidateUser()
    {
        $errors = [];

        if (empty($this->username)) {
            array_push($errors, "Invalid username");
        } else if (empty($this->password)) {
            array_push($errors, "Invalid password");
        }

        // Test username > 3 tekens

        return $errors;
    }
    protected static function connection()
    {
        //RETURN PDO OBJECT
        try {
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            $connection = new PDO("mysql:host=localhost;dbname=login", "root", "", $options);
        } catch (PDOException $e) {
            die("Error:" . $e->getMessage());
        }
        return $connection;
    }

    protected static function exQuery($sql)
    {
        try {
            $myConnection = self::connection();
            $result = $myConnection->query($sql);
        } catch (PDOException $e) {
            die("Error" . $e->getMessage());
        }
        return $result;
    }

    protected static function exExec($sql)
    {
        try {
            $myConnection = self::connection();
            $result = $myConnection->exec($sql);
        } catch (PDOException $e) {
            die("Error" . $e->getMessage());
        }
        return $result;
    }

    public function LoginUser($user)
    {

        // Connect database

        // Zoek user in de table user
        /* echo "Username:" . $this->username; */
        $result = false;
        $sql = "SELECT username
				FROM users 
                WHERE username LIKE '".$user->username."' AND password LIKE '".$user->password."' ";
		
	    $rset = self::exQuery($sql);
        while ($row = $rset->fetch(PDO::FETCH_ASSOC)) {
        	$result = true;
        }
        // Indien gevonden dan sessie vullen
        return $result;
    }

    // Check if the user is already logged in
    public function IsLoggedin()
    {
        // Activeer de session
	   /*  session_start(); */
        // Check if user session has been set
        if(isset($_SESSION['loggedIn'])) {
            return true;
        }
        return false;
    }

    public function GetUser($username)
    {

        // Doe SELECT * from user WHERE username = $username
        if (false) {
            //Indien gevonden eigenschappen vullen met waarden uit de SELECT
            $this->username = 'Waarde uit de database';
        } else {
            return NULL;
        }
    }

    public function Logout()
    {
        session_start();
        // remove all session variables
        session_destroy();

        // destroy the session

        header('location: index.php');
    }
}
