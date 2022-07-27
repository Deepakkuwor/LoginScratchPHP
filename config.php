<?php

class Connection
{
    public $hostname = 'localhost';
    public $username = 'root';
    public $password = '';
    public $database = 'stlogin';
    public $conn;
    public $R = array();


    function __construct()
    {
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
        if (!$this->conn) die('Can\'t connect to the database');
    }
}

class Register extends Connection
{
    public function registration($name, $dob, $phone, $email, $address, $password)
    {
        if ($name == "" || $dob == "" || $phone == "" || $email == "" || $address == "" || $password == "") {
            $this->R['ERR'] = true;
            $this->R['MSG'] = "All field are required!";
            json_encode($this->R);
            return $this->R;
        }
        $password = md5($password);
        $existUser = 'SELECT * FROM users WHERE phone = "' . $phone . '" OR email = "' . $email . '"';
        $existRegistration = mysqli_query($this->conn, $existUser);
        if (mysqli_num_rows($existRegistration) > 0) {
            $this->R['ERR'] = true;
            $this->R['MSG'] = 'Email or phone already exist!';
            json_encode($this->R);
            return $this->R;
        }

        $sql = 'INSERT INTO users (name, dob, phone, email, address, password) VALUES ("' . $name . '", "' . $dob . '", "' . $phone . '", "' . $email . '", "' . $address . '", "' . $password . '")';
        $result = mysqli_query($this->conn, $sql) or die('Query error');
        if ($result) {
            $this->R['ERR'] = false;
            $this->R['MSG'] = 'Account created successfully!';
            json_encode($this->R);
            return $this->R;
        }
    }
}

class Login extends Connection
{
    public $id, $name;
    public function signin($phone, $password)
    {
        if ($phone == "" || $password == "") {
            $this->R['ERR'] = true;
            $this->R['MSG'] = 'Credentials is required';
            json_encode($this->R);
            return $this->R;
        }

        $password = md5($password);

        $sql = 'SELECT * FROM users WHERE phone = "' . $phone . '" AND password = "' . $password . '"';
        var_dump($sql);
        $result = mysqli_query($this->conn, $sql);
        var_dump($result);
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->R['ERR'] = false;
                $this->R['MSG'] = 'Login successful!';
                json_encode($this->R);
                return $this->R;
            }
        } else {
            $this->R['ERR'] = true;
            $this->R['MSG'] = 'Invalid Credentials';
            json_encode($this->R);
            return $this->R;
        }
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
}
