<?php
  class Users extends Controller {
    public function __construct(){
     

     
      $this->userModel = $this->model('User');


    }

      public function index(){

       

      // Check for POST 
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        // Init data
        $data =[
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_err' => '',
          'password_err' => '',      
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password';
        }

        // Check for user/email
        if($this->userModel->findUserByEmail($data['email'])){
          // User found
        } else {
          // User not found
          $data['email_err'] = 'No user found';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['password_err'])){
          // Validated
          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);

          if($loggedInUser){
            // Create Session
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Password incorrect';

              $this->view('inc/login_header');
              $this->view('users/login', $data);
              $this->view('inc/login_footer');
          }
        } else {
          // Load view with errors
           $this->view('inc/login_header');
              $this->view('users/login', $data);
              $this->view('inc/login_footer');
        }


      } else {
        // Init data
        $data =[    
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',        
        ];

        // Load view
          $this->view('inc/login_header');
          $this->view('users/login', $data);
          $this->view('inc/login_footer');
      }
    }


  

  


      public function forget_password(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        // Init data
        $data =[
          'email' => trim($_POST['email']),
          'email_err' => '',     
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        }

       
        // Check for user/email
        if($this->userModel->findUserByEmail($data['email'])){
          // User found
        } else {
          // User not found
          $data['email_err'] = 'No user found';
        }



        // Make sure errors are empty
        if(empty($data['email_err'])){

           if($this->userModel->forgetPassword($data['email'])){
           flash('register_success', '<div class="notification success closeable">
                <p><span>check your email for the reset link</span> </p>
                <a class="close" href="#"></a>
            </div>');
            redirect('users/email/'.$data['email'].'');
          } 

        } else {
          // Load view with errors
          $this->view('users/forget_password', $data);
        }


      } else {
        // Init data
        $data =[    
          'email' => '',
          'email_err' => ''
                
        ];

        // Load view
        $this->view('users/forget_password', $data);
      }
    }

    public function createUserSession($user){
       $temp_url =   $_SESSION['url']; 
       $temp_url;

      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      $_SESSION['email'] = $user->email;
      $_SESSION['user_phone'] = $user->phone;
      $_SESSION['user_role'] = $user->role;
      $_SESSION['user_company'] = $user->company;
      $_SESSION['user_address'] = $user->address;
      $_SESSION['user_website'] = $user->website;
      $_SESSION['reg_date'] = $user->reg_date;
      $_SESSION['status '] = $user->status;

        

        if ($temp_url =="") {
          redirect('accounts');
        }


        if ($temp_url ==!"") {
          temp_redirect($temp_url);
        }

         

       
     
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['fname']);
      unset($_SESSION['lname']);
      unset($_SESSION['user_phone']);
      session_destroy();
      redirect('');
    }


   

    
  }

 