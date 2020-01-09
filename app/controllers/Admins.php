<?php
  class Admins extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('admin_logins');
      }

      $this->adminModel = $this->model('Admin');
      $this->utilityModel = $this->model('Utility');
      $this->accountModel = $this->model('Account');
 
    }

 


     public function index(){

      // $trade_date = date("Ymd");

      // // $trade_date = '20191125';
    
      // $live_trade = $this->account3Model->getLiveTrades($trade_date);
      // $AllIssuers = $this->adminModel->GetAllIssuers();
      // $allannualReports = $this->adminModel->GetAllannualReports();
      // $allfinancialStatement = $this->adminModel->GetAllfinancialStatement();



      
      //     $data = [
      //   'live_trade' => $live_trade,
      //   'AllIssuers' => $AllIssuers,
      //   'allannualReports' => $allannualReports,
      //   'allfinancialStatement' => $allfinancialStatement     
      // ];

            $this->view('inc/admin_header');
           $this->view('admin/index');
          $this->view('inc/admin_footer');
          }





     public function profile(){
      $total_funds = $this->adminModel->Totalfunds($_SESSION['user_email']);

            

      $data = [
            'total_funds' => $total_funds
              ];

          $this->view('inc/user_header');
           $this->view('admin/profile', $data);
          $this->view('inc/user_footer');
    }




     public function accounts(){
      $allusers = $this->adminModel->getUsers();
      $load_roles = $this->utilityModel->getRoles();

            

      $data = [
            'allusers' => $allusers,
             'load_roles' => $load_roles
              ];

          $this->view('inc/admin_header');
           $this->view('admin/accounts', $data);
          $this->view('inc/admin_footer');
    }



    public function add_user(){


            $password = 'password123';
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
           
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);



          
            $data = [
             // 'username' => trim($_POST['username']),
              'name' => trim($_POST['name']),
              'email' => trim($_POST['email']),
              'password' => $password,
              'role' => trim($_POST['role']),
              'reg_date' => date('jS \ F Y h:i:s A'),
              'email_err' => ''
             
             
            ];

            // Validate data
            if(empty($data['email'])){
              $data['email_err'] ='Email Field is Empty';


            }

             // Check email
          if($this->adminModel->findUserByEmail($data['email'])){
            error_flash('alert_message', ''.$data['email'].' is already taken');
                    redirect('admins/accounts');
                    die();
          }
            // HASHED PASSWORD FUNCTION 
             $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

             //NAME FORMATING

             $data['name'] = ucwords($data['name']);

            

            // Make sure no errors
            if(empty($data['email_err'])){
              // Validated
              if($this->adminModel->AddUser($data)){
                  flash('alert_message', 'Account Added');
                  redirect('admins/accounts');
                
              } 

              else {
                die('Something went wrong');
              }
            } else {
              // Load view with errors
               $this->view('inc/admin_header');
              $this->view('admin/accounts', $data);
              $this->view('inc/admin_footer');
            }

          } else {
           
           $this->view('inc/admin_header');
          $this->view('admin/accounts', $data);
          $this->view('inc/admin_footer');
          }
        }




          public function edit_user($id){

           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
           
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);



          
             // Init data
                  $data =[
                     'id' => $id,
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                     'password' => trim($_POST['password']),
                    'role' => trim($_POST['role']),
                    'email_err' => '',
                   
                  ];

                  

                    // Validate Email
                  if(empty($data['email'])){
                    $data['email_err'] = 'Pleae enter Email';
                  }


                   // Check email
          if($this->adminModel->findUserByEmail($data['email'])){
            error_flash('alert_message', ''.$data['email'].' is already taken');
                    redirect('admins/accounts');
                    die();
          }

                    // EMPTY PASSWORD INPUT
                  if(empty($data['password'])){
                    $this->adminModel->updateUser($data);
                    flash('alert_message', 'Account Updated without password');
                    redirect('admins/accounts');
                
                  } 


            
                  /// Make sure errors are empty
                  if(empty($data['email_err'])){
                    // Validated
                   
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            // Make sure no errors
           
              // Validated
              if($this->adminModel->updateUserPassword($data)){
                  flash('alert_message', 'Account Updated');
                  redirect('admins/accounts');
                
              } 

              else {
                die('Something went wrong');
              }
            } else {
              // Load view with errors
               $this->view('inc/user_header');
              $this->view('admin/edit_user', $data);
              $this->view('inc/user_footer');
            }

          } else {
              $user_info = $this->adminModel->getUserById($id);

            $data = [
            'user_info' => $user_info

            ];

            
      
           $this->view('inc/user_header');
          $this->view('admin/edit_user', $data);
          $this->view('inc/user_footer');
          }
        }


     
         public function delete_user($id){
            

              if($this->adminModel->deleteUser($id)){
                flash('alert_message', 'Account Removed');
                redirect('admins/accounts');
              } 
                  else {
                    die('Something went wrong');
                  }

              }




              


        public function roles(){
     
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array       
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
            $data = [
             // 'username' => trim($_POST['username']),
              'role_title' => trim($_POST['role_title']),
              'reg_date' => date('jS \ F Y h:i:s A'),
              'role_title_err' => '' 
             
            ];

            $data['role_title'] = strtoupper($data['role_title']);

                // CHECK FOR EXISTING ROLE NAME
          if($this->adminModel->findRoleByName($data['role_title'])){
            error_flash('alert_message', ''.$data['role_title'].' is an existing role');
                    redirect('admins/roles');
                    die();
          }

            if(empty($data['role_title_err'])){
                    $this->adminModel->AddRole($data);
                   flash('alert_message', 'Role Added');
                    redirect('admins/roles');
                
                  } 
        
        
             else {


        $allroles = $this->adminModel->getRoles();    

        $data = [
              'allroles' => $allroles
                ];
              // Load view with errors
               $this->view('inc/admin_header');
              $this->view('admin/roles', $data);
              $this->view('inc/admin_footer');
            }

          } else {

        $allroles = $this->adminModel->getRoles();    

        $data = [
              'allroles' => $allroles
                ];
           
           $this->view('inc/admin_header');
          $this->view('admin/roles', $data);
          $this->view('inc/admin_footer');
          }


        }



          public function edit_role($id){

           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
           
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);



          
             // Init data
                  $data =[
                     'id' => $id,
                    'role_title' => trim($_POST['role_title']),
                    'role_title_err' => '',
                   
                  ];

                  

                    // Validate Email
                  if(empty($data['role_title'])){
                    $data['role_title_err'] = 'Pleae enter Role';
                  } 

                   

            
                  /// Make sure errors are empty
                  if(empty($data['email_err'])){
                    // Validated
                   
                $data['role_title'] = strtoupper($data['role_title']);

        
           
              // Validated
              if($this->adminModel->updateRole($data)){
                  flash('alert_message', 'Role Updated');
                  redirect('admins/roles');
                
              } 

              else {
                die('Something went wrong');
              }
            } else {
              // Load view with errors
               $this->view('inc/user_header');
              $this->view('admins/roles', $data);
              $this->view('inc/user_footer');
            }

          } else {

        $allroles = $this->adminModel->getRoles();    

        $data = [
              'allroles' => $allroles
                ];
           
           $this->view('inc/admin_header');
          $this->view('admin/roles', $data);
          $this->view('inc/admin_footer');
          }
        }




   public function delete_role($id)
    {

        if ($this
            ->adminModel
            ->deleteRole($id))
        {
            flash('alert_message', 'Role Removed');
            redirect('admins/roles');
        }
        else
        {
            die('Something went wrong');
        }

    }






  }