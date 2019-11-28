<?php
  class Admin_login {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Regsiter user
    public function register($data){
      $this->db->query('INSERT INTO users (fname, lname, username, username, phone, password, country, zipcode, account_type, currency_type, reg_date) VALUES(:fname, :lname, :username, :username, :phone, :password, :country, :zipcode, :account_type, :currency_type, :reg_date)');
      // Bind values
      $this->db->bind(':fname', $data['fname']);
       $this->db->bind(':lname', $data['lname']);
       $this->db->bind(':username', $data['username']);
      $this->db->bind(':username', $data['username']);
      $this->db->bind(':phone', $data['phone']);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':country', $data['country']);
      $this->db->bind(':zipcode', $data['zipcode']);
      $this->db->bind(':account_type', $data['account_type']);
      $this->db->bind(':currency_type', $data['currency_type']);
       $this->db->bind(':reg_date', $data['reg_date']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Login User
    public function login($username, $password){
      $this->db->query('SELECT * FROM issuers_admin WHERE username = :username');
      $this->db->bind(':username', $username);

      $row = $this->db->single();

      $hashed_password = $row->password;
      if(password_verify($password, $hashed_password)){
        return $row;
      } else {
        return false;
      }
    }




      // Forget Password
    public function forgetPassword($username){
      $this->db->query('SELECT * FROM users WHERE username = :username');
      $this->db->bind(':username', $username);

      $row = $this->db->single();

 
        return $row;
    }




    // Find user by username
    public function findUserByusername($username){
      $this->db->query('SELECT * FROM issuers_admin WHERE username = :username');
      // Bind value
      $this->db->bind(':username', $username);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }



    public function findUserByPhone($phone){
      $this->db->query('SELECT * FROM users WHERE phone = :phone');
      // Bind value
      $this->db->bind(':phone', $phone);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }



     public function getUserDetail($username){
      $this->db->query('SELECT * FROM users WHERE username = :username');
      $this->db->bind(':username', $username);

      $row = $this->db->single();

      return $row;
    }



    public function updateUserPassword($data){
      $this->db->query('UPDATE users SET password = :password  WHERE username = :username');
      // Bind values
      $this->db->bind(':username',  $data['username']);
      $this->db->bind(':password', $data['password']);
    
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }




   
  }