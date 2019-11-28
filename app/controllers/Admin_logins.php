<?php
  class Admin_logins extends Controller {
    public function __construct(){
      $this->admin_loginModel = $this->model('Admin_login');
    }

      public function index(){
          
         
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        // Init data
        $data =[
          'username' => trim($_POST['username']),
          'password' => trim($_POST['password']),
          'username_err' => '',
          'password_err' => '',      
        ];

        // Validate username
        if(empty($data['username'])){
          $data['username_err'] = 'Pleae enter username';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password';
        }

        // Check for user/username
        if($this->admin_loginModel->findUserByusername($data['username'])){
          // User found
        } else {
          // User not found
          $data['username_err'] = 'No user found';
        }



        // Make sure errors are empty
        if(empty($data['username_err']) && empty($data['password_err'])){
          // Validated
          // Check and set logged in user
          $loggedInUser = $this->admin_loginModel->login($data['username'], $data['password']);

          if($loggedInUser){
            // Create Session
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Password incorrect';

              $this->view('inc/login_header');
              $this->view('admin_login/login', $data);
              $this->view('inc/login_footer');
          }
        } else {
          // Load view with errors
          
         
           $this->view('inc/login_header');
              $this->view('admin_login/login', $data);
              $this->view('inc/login_footer');
        }


      } else {
        // Init data
        $data =[    
          'username' => '',
          'password' => '',
          'username_err' => '',
          'password_err' => '',        
        ];

        // Load view
         $this->view('inc/login_header');
        $this->view('admin_login/login', $data);
          $this->view('inc/login_footer');
        //   $this->view('inc/login_header');
        //   $this->view('Admin_login/login', $data);
        //   $this->view('inc/login_footer');
      }
    }



    public function createUserSession($user){
       $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
       $_SESSION['username'] = $user->username;
      $_SESSION['user_phone'] = $user->phone;
      $_SESSION['user_role'] = $user->role;
      $_SESSION['user_company'] = $user->company;
      $_SESSION['user_symbol'] = $user->symbol;
       $_SESSION['user_address'] = $user->address;
       $_SESSION['user_website'] = $user->website;
        $_SESSION['reg_date'] = $user->reg_date;
        $_SESSION['status '] = $user->status;


         

       
      redirect('admins');
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_username']);
      unset($_SESSION['fname']);
      unset($_SESSION['lname']);
       unset($_SESSION['username']);
      unset($_SESSION['user_phone']);
      session_destroy();
      redirect('admin_logins');
    }

public function username($username){

  $user_profile = $this->userModel->getUserDetail($username);

     $data = [
    'user_profile' => $user_profile
      ];


      $this->view('users/username', $data);
    }





        public function reset($username){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
            $data =[
              'username' => trim($_POST['username']),
              'password' => trim($_POST['password']),
              'password_err' => '',
            ];

            // Validate username
            if(empty($data['password'])){
              $data['password_err'] = 'Pleae enter name';
            } 
            // Make sure errors are empty
            if(empty($data['password_err'])){
              // Validated
         $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          // Validated
          if($this->userModel->updateUserPassword($data)){
            flash('post_message', 'Password Updated Successfully');
            redirect('users/login');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('users/reset', $data);
        }

      } else {
      
        $user_profile = $this->userModel->getUserDetail($username);

        $data = [
         'user_profile' => $user_profile
           ];
  
        $this->view('users/reset', $data);
      }
    }

    
  }

 