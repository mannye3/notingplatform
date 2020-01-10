<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

  
    // Login User
    public function login($email, $password){
      $this->db->query('SELECT * FROM issuers_accounts WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      $hashed_password = $row->password;
      if(password_verify($password, $hashed_password)){
        return $row;
      } else {
        return false;
      }
    }



      // Forget Password
    public function forgetPassword($email){
      $this->db->query('SELECT * FROM issuers_accounts WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

 
        return $row;
    }




    public function ResetToken($data){
      $this->db->query('UPDATE issuers_accounts SET pass_res_token = :pass_res_token  WHERE email = :email');
      // Bind values
      $this->db->bind(':pass_res_token',  $data['pass_res_token']);
      $this->db->bind(':email',  $data['email']);



          // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }





public function DeleteResetToken($data){
      $this->db->query('UPDATE issuers_accounts SET pass_res_token = :empty_token  WHERE email = :email');
      // Bind values
      $this->db->bind(':empty_token',  $data['empty_token']);
      $this->db->bind(':email',  $data['email']);



          // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }



 

    public function updateUserPassword($data){
      $this->db->query('UPDATE issuers_accounts SET password = :password  WHERE email = :email');
      // Bind values
      $this->db->bind(':email',  $data['email']);
      $this->db->bind(':password', $data['password']);
    
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }



    public function getUserDetail($pass_res_token){
      $this->db->query('SELECT * FROM issuers_accounts WHERE pass_res_token = :pass_res_token');
      $this->db->bind(':pass_res_token', $pass_res_token);

      $row = $this->db->single();

      return $row;
    }







    // Find user by email
    public function findUserByEmail($email){
      $this->db->query('SELECT * FROM issuers_accounts WHERE email = :email');
      // Bind value
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }



   
  }