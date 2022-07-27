<?php
/**
 * Class: Connection
 * 
 * @description: MySQL Connector
 */
class Connection
{
    //Class Public Variable
    public $hostname = 'localhost';
    public $username = 'root';
    public $password = '';
    public $database = 'stlogin';
    public $conn;
    public $R = array();


    //Constructor to connect to MySQL Database
    function __construct()
    {
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
        if (!$this->conn) die('Can\'t connect to the database');
    }
}



/**
 * Class: Register
 * 
 * @description: User Registration
 */
class Register extends Connection
{
    /**
     * Registration
     * 
     * @description: User Registration
     * @param:
     *  $name: String
     *  $dob: Date
     *  $phone: Integer
     *  $email: String
     *  $address: String
     *  $password: String
     */
    public function registration($name, $dob, $phone, $email, $address, $password)
    {
        //Check: If Empty?
        //Note: Not focusing on extra Validation for Demo Work!!
        if ($name == "" || $dob == "" || $phone == "" || $email == "" || $address == "" || $password == "") {
            $this->R['ERR'] = true;
            $this->R['MSG'] = "All field are required!";
            goto REG_END;
        }

        //Check: If Phone Number or Email is already registred?
        $password = md5($password);
        $existUser = 'SELECT * FROM users WHERE phone = "' . $phone . '" OR email = "' . $email . '"';
        $existRegistration = mysqli_query($this->conn, $existUser);
        if (mysqli_num_rows($existRegistration) > 0) {
            $this->R['ERR'] = true;
            $this->R['MSG'] = 'Email or phone already exist!';
            goto REG_END;
        }

        //Check: Register User to Database
        $sql = 'INSERT INTO users (name, dob, phone, email, address, password) VALUES ("' . $name . '", "' . $dob . '", "' . $phone . '", "' . $email . '", "' . $address . '", "' . $password . '")';
        $result = mysqli_query($this->conn, $sql) or die('Query error');
        if ($result) {
            $this->R['ERR'] = false;
            $this->R['MSG'] = 'Account created successfully!';
            goto REG_END;
        }

        //Send Server Response
        REG_END:
        json_encode($this->R);
        return $this->R;
    }
}
/**
 * Class: Login
 * 
 * @description: User Login
 */
class Login extends Connection
{
    /**
     * Login
     * 
     * @description: User Login 
     * @param:
     * $phone: Integer
     * $password: String
     */

     //Class public variable to store session
    public $id, $name;
    public function signin($phone, $password)
    {
        //Check: If Empty?
        //Note: Not focusing on extra Validation for Demo Work!!
        if ($phone == "" || $password == "") {
            $this->R['ERR'] = true;
            $this->R['MSG'] = 'Credentials is required';
            goto REG_END;

        }

        $password = md5($password);

        $sql = 'SELECT * FROM users WHERE phone = "' . $phone . '" AND password = "' . $password . '"';
        //Check: If user exist
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->R['ERR'] = false;
                $this->R['MSG'] = 'Login successful!';
                goto REG_END;

            }
        } else {
            $this->R['ERR'] = true;
            $this->R['MSG'] = 'Invalid Credentials';
            goto REG_END;

        }

        //Send Server Response
        REG_END:
        json_encode($this->R);
        return $this->R;
    }
    // Getting user id to create session
    public function getId(){
        return $this->id;
    }
    // Getting user name to create session
    public function getName(){
        return $this->name;
    }
}
