<?php
  class Accounts extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('users');
      }

      $this->accountModel = $this->model('Account');
      // $this->listingModel = $this->model('listing');
      $this->utilityModel = $this->model('Utility');
    }

      public function index(){
      // Get User Properties
      // $total_funds = $this->accountModel->Totalfunds($_SESSION['user_email']);

            

      // $data = [
      //       'total_funds' => $total_funds
      //         ];

              

          $this->view('inc/user_header');
           $this->view('accounts/index', $data);
          $this->view('inc/user_footer');
    }


     public function profile(){

          $this->view('inc/user_header');
           $this->view('accounts/profile', $data);
          $this->view('inc/user_footer');
    }




    public function compose(){
      
    

           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          
            $data = [
              'sender_email' => $_SESSION['user_email'],
              'sender_username' => $_SESSION['username'],
              'sender_symbol' => $_SESSION['user_symbol'],
              'subject' => trim($_POST['subject']),
              'message' => trim($_POST['message']),
              'msg_date' => date('jS \ F Y h:i:s A'),
              'subject_err' => '',
              'message_err' => ''
             
            ];

            // Validate data
            if(empty($data['message'])){
              $data['message_err'] = 'Message Field is Empty';
            }
            

            // Make sure no errors
            if(empty($data['message_err'])){
              // Validated
              if($this->accountModel->SendMessage($data)){
                flash('alert_message', 'Message Sent');
                redirect('accounts/compose');
              } else {
                die('Something went wrong');
              }
            } else {
              // Load view with errors
             $this->view('inc/user_header');
           $this->view('accounts/compose', $data);
          $this->view('inc/user_footer');
            }

          } else {
             $total_sent = $this->accountModel->Totalsent($_SESSION['user_symbol']);
           
            $data = [
              'message' => '',
              'total_sent' => $total_sent
            ];
      
            $this->view('inc/user_header');
           $this->view('accounts/compose', $data);
          $this->view('inc/user_footer');
          }
        }


        public function admin_compose(){
      
    

           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

             

          
            $data = [
              'receiver_username' => trim($_POST['receiver_username']),
              
              'sender_email' => $_SESSION['user_email'],
              'sender_username' => $_SESSION['username'],
              'sender_symbol' => $_SESSION['user_symbol'],
              'subject' => trim($_POST['subject']),
              'message' => trim($_POST['message']),
              'msg_date' => date('jS \ F Y h:i:s A'),
              'subject_err' => '',
              'message_err' => ''
             
            ];

            // Validate data
            if(empty($data['message'])){
              $data['message_err'] = 'Message Field is Empty';
            }
            

            // Make sure no errors
            if(empty($data['message_err'])){
              // Validated
              if($this->accountModel->SendMessageInbox($data)){
                flash('alert_message', 'Message Sent');
                redirect('accounts/admin_compose');
              } else {
                die('Something went wrong');
              }
            } else {
              // Load view with errors
             $this->view('inc/user_header');
           $this->view('accounts/admin_compose', $data);
          $this->view('inc/user_footer');
            }

          } else {
             $total_sent = $this->accountModel->Totalsent($_SESSION['user_symbol']);
             $load_users = $this->utilityModel->getUsers();
           
            $data = [
              'message' => '',
              'total_sent' => $total_sent,
              'load_users' => $load_users
            ];
      
            $this->view('inc/user_header');
           $this->view('accounts/admin_compose', $data);
          $this->view('inc/user_footer');
          }
        }


    



      public function inbox(){
            $total_sent = $this->accountModel->Totalsent($_SESSION['user_symbol']);
            $inbox = $this->accountModel->InboxMsg($_SESSION['username']);
            $total_inbox = $this->accountModel->Totalinbox($_SESSION['username']);

                  

             $data = [
              'inbox' => $inbox,
              'total_sent' => $total_sent,
              'total_inbox' => $total_inbox
                  
              
            ];
         

          $this->view('inc/user_header');
           $this->view('accounts/inbox', $data);
          $this->view('inc/user_footer');
    }


    public function sent(){
      $sent = $this->accountModel->SentMsg($_SESSION['user_symbol']);
       $total_sent = $this->accountModel->Totalsent($_SESSION['user_symbol']);

            

      $data = [
            'sent' => $sent,
             'total_sent' => $total_sent
              ];

          $this->view('inc/user_header');
           $this->view('accounts/sent', $data);
          $this->view('inc/user_footer');
    }





      public function open_message($id){
         $open_msg = $this->accountModel->getMsgById($id);

      $total_sent = $this->accountModel->Totalsent($_SESSION['user_symbol']);



     
      
      

      $data = [
        'open_msg' => $open_msg,
        'total_sent' => $total_sent
            
        
      ];

      $this->view('inc/user_header');
      $this->view('accounts/open_message', $data);
      $this->view('inc/user_footer');
    }




 // public function sent(){
 //      $sent = $this->accountModel->SentMsg($_SESSION['user_symbol']);
 //       $total_sent = $this->accountModel->Totalsent($_SESSION['user_symbol']);

            

 //      $data = [
 //            'sent' => $sent,
 //             'total_sent' => $total_sent
 //              ];

 //          $this->view('inc/user_header');
 //           $this->view('accounts/sent', $data);
 //          $this->view('inc/user_footer');
 //    }



    public function edit_profile(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
            $data =[
              'id' => $_SESSION['user_id'],
              'email' => trim($_POST['email']),
              'phone' => trim($_POST['phone']),
              'company' => trim($_POST['company']),
              'website' => trim($_POST['website']),
              'address' => trim($_POST['address']),
              'email_err' => '',
              'phone_err' => '',
            ];

            

            // Validate Email
            if(empty($data['email'])){
              $data['email_err'] = 'Pleae enter name';
            } else {
    
            }

            // Validate Phone
            if(empty($data['phone'])){
              $data['phone_err'] = 'Pleae enter phone';
            } else {
            }

        

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['phone_err'])){
              // Validated
              
          // Validated
          if($this->accountModel->updateUser($data)){

            $_SESSION['user_email'] = $data['email'];
            $_SESSION['user_phone'] = $data['phone'];
            $_SESSION['user_company'] = $data['company'];
            $_SESSION['user_website'] = $data['website'];
             $_SESSION['user_address'] = $data['address'];
            
            flash('post_message', 'Profile Updated');
            redirect('accounts/profile');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('accounts/profile', $data);
        }

      } else {
      

        $data =[
              'email' => '',
              'phone' => '',
              'company' => '',
              'website' => '',
              'address' => '',
              'email_err' => '',
              'phone_err' => ''
            ];
  
        $this->view('accounts/profile', $data);
      }
    }



     public function edit_password(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
            $data =[
              'id' => $_SESSION['user_id'],
              'password' => trim($_POST['password']),
              'password_err' => ''
            ];

            

            // Validate Email
            if(empty($data['password'])){
              $data['password_err'] = 'Pleae enter password';
            } else {
    
            }

           
        

            // Make sure errors are empty
            if(empty($data['password_err'])){
              // Validated

             $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
              
          // Validated
          if($this->accountModel->updatePassword($data)){

           
            flash('alert_message', 'Password Updated');
           
            redirect('accounts/profile');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('accounts/profile', $data);
        }

      } else {
      

        $data =[
              'password' => '',
              'password_err' => ''
            ];
  
        $this->view('accounts/profile', $data);
      }
    }






    public function buy(){
      // Get User Properties
     $data = [
        
      ];

          $this->view('inc/user_header');
           $this->view('accounts/buy', $data);
          $this->view('inc/user_footer');
    }

    

     public function sell(){
               $get_report = $this->accountModel->getReport($_SESSION['user_symbol']);
               // $get_brokerinfo = $this->accountModel->getBroker();
               // $get_accountinfo = $this->accountModel->getAccount();
               
                

            
             
              $data = [
            'get_report' => $get_report
            // 'get_brokerinfo' => $get_brokerinfo
             // 'get_accountinfo' => $get_accountinfo
             
              ];

              $this->view('inc/user_header');
               $this->view('accounts/sell', $data);
              $this->view('inc/user_footer');
              }


    // public function sell(){
    //   // Get User Properties
    //  $data = [
        
    //   ];

    //       $this->view('inc/user_header');
    //        $this->view('accounts/sell', $data);
    //       $this->view('inc/user_footer');
    // }



    public function news(){
      // Get User Properties
     $data = [
        
      ];

          $this->view('inc/user_header');
           $this->view('accounts/news', $data);
          $this->view('inc/user_footer');
    }



    



public function landing(){
      // Get User Properties
     $data = [
        
      ];

          
           $this->view('accounts/landing', $data);
         
    }

    


       
     


    public function profile_pic(){

           // ini_set('display_errors', '0');         # don't show any errors...
           //  error_reporting(E_ALL | E_STRICT);

           if($_FILES["file"]["name"] != '')
            {
            $target_dir = PROFILE_PIC_ROOT_PATH;
            $RandomNum = time();
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $filename = explode('.', $_FILES["file"]["name"]);
            $picname = end($filename);
            $new_name = rand(100, 999) . '.' . $picname;
            $ImageName = str_replace(' ','-',strtolower($new_name));
            $ImageType = $_FILES['file']['type']; //"file/png", file/jpeg etc.
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.','',$ImageExt);
            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
            $ret[$NewImageName]= $target_dir.$NewImageName;
            move_uploaded_file($_FILES["file"]["tmp_name"],$target_dir."/".$NewImageName );
            $data = array(
            'image' => $NewImageName,
            'id' => $_SESSION['user_id']
            );
            $this->accountModel->addProfilePicture($data);
             // $_SESSION['user_image'] = $data['image'];
             
            // echo "file Uploaded Successfully";
            
           // $this->view('accounts/index', $data);
            }
         redirect('accounts');
            }
        




          public function delete_property($ref_id){
            
              // Get existing post from model
             $pro_info = $this->listingModel->getPropertyByRef($ref_id);
            
              // Check for owner
              if($post->user_id != $_SESSION['user_id']){
                redirect('accounts');
              }

              if($this->listingModel->deleteProperty($ref_id)){
                flash('post_message', 'Post Removed');
                redirect('accounts/my_properties');
              } else {
                die('Something went wrong');
              }
              }
      


             
     
    


  }