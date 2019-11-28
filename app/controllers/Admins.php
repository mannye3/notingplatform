<?php
  class Admins extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('admin_logins');
      }

      $this->adminModel = $this->model('Admin');
      $this->accountModel = $this->model('Account');
      $this->account3Model = $this->model('Account3');
    }

 


     public function index(){

      $trade_date = date("Ymd");

      // $trade_date = '20191125';
    
      $live_trade = $this->account3Model->getLiveTrades($trade_date);

      
          $data = [
        'live_trade' => $live_trade     
      ];

            $this->view('inc/user_header');
           $this->view('admin/index', $data);
          $this->view('inc/user_footer');
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


     public function users(){
      $allusers = $this->adminModel->getUsers();

            

      $data = [
            'allusers' => $allusers
              ];

          $this->view('inc/user_header');
           $this->view('admin/users', $data);
          $this->view('inc/user_footer');
    }


          public function edit_user($id){

           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
           
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);



          
             // Init data
                  $data =[
                     'id' => $id,
                    'symbol' => trim($_POST['symbol']),
                    'username' => trim($_POST['username']),
                     'email' => trim($_POST['email']),
                    'phone' => trim($_POST['phone']),
                    'company' => trim($_POST['company']),
                    'website' => trim($_POST['website']),
                    'address' => trim($_POST['address']),
                    'email_err' => '',
                    'phone_err' => '',
                  ];

                  

                    // Validate Email
                  if(empty($data['username'])){
                    $data['username_err'] = 'Pleae enter Username';
                  } else {
          
                  }

                  // Validate Phone
                  if(empty($data['symbol'])){
                    $data['symbol_err'] = 'Pleae Symbol';
                  } else {
                  }
                 
              

                  /// Make sure errors are empty
                  if(empty($data['username_err']) && empty($data['symbol_err'])){
                    // Validated
                   

            // Make sure no errors
           
              // Validated
              if($this->adminModel->updateUser($data)){
                  flash('alert_message', 'Account Updated');
                  redirect('admins/users');
                
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


        public function edit_userpassword($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
            $data =[
              'id' => $id,
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
          if($this->adminModel->updateUserPassword($data)){

           
            flash('alert_message', 'Password Updated');
           
            redirect('admins/users');
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
  
        $this->view('admins/users', $data);
      }
    }





 public function add_user(){


            $password = 'password123';
            $num = rand(1000, 9999);
            $username = 'SD-' . $num; 

           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
           
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);



          
            $data = [
             // 'username' => trim($_POST['username']),
              'username' => $username,
              'email' => trim($_POST['email']),
              'password' => $password,
              'phone' => trim($_POST['phone']),
              'symbol' => trim($_POST['symbol']),
              'company' => trim($_POST['company']),
              'website' => trim($_POST['website']),
              'address' => trim($_POST['address']),
              'reg_date' => date('jS \ F Y h:i:s A'),
              'symbol_err' => ''
             
             
            ];

            // Validate data
            if(empty($data['symbol'])){
              $data['symbol_err'] ='Symbol Field is Empty';


            }

             $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            

            // Make sure no errors
            if(empty($data['symbol_err'])){
              // Validated
              if($this->adminModel->AddUser($data)){
                  flash('alert_message', 'User Added');
                  redirect('admins/users');
                
              } 

              else {
                die('Something went wrong');
              }
            } else {
              // Load view with errors
               $this->view('inc/user_header');
              $this->view('admin/add_user', $data);
              $this->view('inc/user_footer');
            }

          } else {
           
           $this->view('inc/user_header');
          $this->view('admin/add_user', $data);
          $this->view('inc/user_footer');
          }
        }




         public function delete_user($id){
            

              if($this->adminModel->deleteUser($id)){
                flash('alert_message', 'Account Removed');
                redirect('admins/users');
              } 
                  else {
                    die('Something went wrong');
                  }

              }



         




    public function compose(){
      
            $msg_code= rand(100000,999999);

         
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array

            
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          
            $data = [
              'sender_email' => $_SESSION['user_email'],
              'sender_username' => $_SESSION['username'],
              'sender_symbol' => $_SESSION['user_symbol'],
              'receiver_symbol' => trim($_POST['receiver_symbol']),
              'subject' => trim($_POST['subject']),
              'message' => trim($_POST['editor1']),
              'msg_code' => $msg_code,
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
              if($this->adminModel->SendMessage($data)){

                    if($this->adminModel->SendMessageInbox($data)){
                    flash('alert_message', 'Message Sent');
                    redirect('admins/compose');
                  } 
              } 

              else {
                die('Something went wrong');
              }
            } else {
              // Load view with errors
             $this->view('inc/user_header');
           $this->view('admins/compose', $data);
          $this->view('inc/user_footer');
            }

          } else {
             $total_sent = $this->adminModel->Totalsent($_SESSION['user_symbol']);
             $total_inbox = $this->adminModel->Totalinbox($_SESSION['user_symbol']);
              $load_users = $this->utilityModel->getUsers();
           
            $data = [
              'message' => '',
              'total_sent' => $total_sent,
               'total_inbox' => $total_inbox,
               'load_users' => $load_users
            ];


      
            $this->view('inc/user_header');
           $this->view('admin/compose', $data);
          $this->view('inc/user_footer');
          }
        }






        public function reply($msg_code){
      
             $reply_msg_code= rand(100000,999999);

           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
           
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
            $data = [
              'sender_email' => $_SESSION['user_email'],
              'sender_username' => $_SESSION['username'],
              'sender_symbol' => $_SESSION['user_symbol'],
              'subject' => trim($_POST['subject']),
              'message' => trim($_POST['editor1']),
              'receiver_username' => trim($_POST['receiver_username']),
              'receiver_symbol' => trim($_POST['receiver_symbol']),
              'receiver_email' => trim($_POST['receiver_email']),
              'reply_msg_code' => $reply_msg_code,
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
              if($this->adminModel->ReplyMessage($data)){

                    if($this->adminModel->ReplyMessageInbox($data)){
                    flash('alert_message', 'Message Sent');
                    redirect('admins/inbox');
                  } 
              } 

              else {
                die('Something went wrong');
              }
            } else {
              // Load view with errors
             $this->view('inc/user_header');
           $this->view('admin/reply', $data);
          $this->view('inc/user_footer');
            }

          } else {
             $total_sent = $this->adminModel->Totalsent($_SESSION['user_symbol']);
             $total_inbox = $this->adminModel->Totalinbox($_SESSION['user_symbol']);
             $reply_msg = $this->adminModel->getMsgByCode($msg_code);

             
           
            $data = [
              'message' => '',
              'total_sent' => $total_sent,
               'total_inbox' => $total_inbox,
               'reply_msg' => $reply_msg
            ];
      
            $this->view('inc/user_header');
            $this->view('admin/reply', $data);
            $this->view('inc/user_footer');
          }
        }



            public function news(){
      $allnews = $this->adminModel->getNews();

            

      $data = [
            'allnews' => $allnews
              ];

          $this->view('inc/user_header');
           $this->view('admin/news', $data);
          $this->view('inc/user_footer');
    }



    public function add_news(){
      $allnews = $this->adminModel->getNews();

            

      $data = [
            'allnews' => $allnews
              ];

          $this->view('inc/user_header');
           $this->view('admin/add_news', $data);
          $this->view('inc/user_footer');
    }


     public function open_news($id){
                
              $open_new = $this->adminModel->getNewsById($id);
              


              $data = [
                'open_new' => $open_new
               
                    
                
              ];

              $this->view('inc/user_header');
              $this->view('accounts/open_news', $data);
              $this->view('inc/user_footer');
            }





       public function edit_news($id){


      
            $num = rand(1000, 9999);
            $username = 'SD-' . $num; 

           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
           
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);



          
            $data = [
             
              'id' => $id,
              'page_title' => trim($_POST['title']),
              'page_content' => trim($_POST['editor1']),
              'page_content_err' => ''
             
             
            ];

            // Validate data
            if(empty($data['page_content'])){
              $data['page_content_err'] = 'Content Field is Empty';
            }
            

            // Make sure no errors
            if(empty($data['page_content_err'])){
              // Validated
              if($this->adminModel->updateNews($data)){
                  flash('alert_message', 'News Updated');
                  redirect('admins/news');
                
              } 

              else {
                die('Something went wrong');
              }
            } else {
              // Load view with errors
               $this->view('inc/user_header');
              $this->view('admin/edit_news', $data);
              $this->view('inc/user_footer');
            }

          } else {
              $news_info = $this->adminModel->getNewsById($id);

            $data = [
            'news_info' => $news_info

            ];

            
      
           $this->view('inc/user_header');
          $this->view('admin/edit_news', $data);
          $this->view('inc/user_footer');
          }
        }


             public function delete_news($id){
              if($this->adminModel->deleteNews($id)){
                flash('alert_message', 'News Removed');
                redirect('admins/news');
              } 
                  else {
                    die('Something went wrong');
                  }

              }






      function uploadnews(){
              if(isset($_POST['submit']))
              {

                      $target_dir = NEWS_PIC_ROOT_PATH;
                      $RandomNum = time();
                      $target_file = $target_dir . basename($_FILES["file"]["name"]);
                      $filename = explode('.', $_FILES["file"]["name"]);
                      $picname = end($filename);
                      $new_name = rand(1000, 9999) . '.' . $picname;
                      $ImageName = str_replace(' ','-',strtolower($new_name));
                      $ImageType = $_FILES['file']['type']; //"file/png", file/jpeg etc.
                      $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                      $ImageExt = str_replace('.','',$ImageExt);
                      $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                      $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
                      $ret[$NewImageName]= $target_dir.$NewImageName;
                      move_uploaded_file($_FILES["file"]["tmp_name"],$target_dir."/".$NewImageName );

                      $data = array(
                      'page_title' => trim($_POST['title']),
                      'page_content' => trim($_POST['editor1']),
                      'picture' => $NewImageName,
                      'date_published' => date('jS \ F Y h:i:s A')
                      );

                      
                    $this->adminModel->AddNews($data);
                    }
                    flash('alert_message', 'News Uploaded');
                    redirect('admins/news');
                 
                    }








                     function edit_newspicture($id){
                    if(isset($_POST['submit']))
                    {

                      $target_dir = NEWS_PIC_ROOT_PATH;
                      $RandomNum = time();
                      $target_file = $target_dir . basename($_FILES["file"]["name"]);
                      $filename = explode('.', $_FILES["file"]["name"]);
                      $picname = end($filename);
                      $new_name = rand(1000, 9999) . '.' . $picname;
                      $ImageName = str_replace(' ','-',strtolower($new_name));
                      $ImageType = $_FILES['file']['type']; //"file/png", file/jpeg etc.
                      $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                      $ImageExt = str_replace('.','',$ImageExt);
                      $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                      $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
                      $ret[$NewImageName]= $target_dir.$NewImageName;
                      move_uploaded_file($_FILES["file"]["tmp_name"],$target_dir."/".$NewImageName );

                      $data = array(
                      'id' => $id,
                      'picture' => $NewImageName
                      );

                      
                    $this->adminModel->UpdateNewsPic($data);
                    }
                    flash('alert_message', 'News Picture Updated');
                    redirect('admins/news');
                 
                    }





        public function admin_compose(){
      
           $msg_code= rand(100000,999999);

           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

             

          
            $data = [
              
              'sender_email' => $_SESSION['user_email'],
              'sender_username' => $_SESSION['username'],
              'sender_symbol' => $_SESSION['user_symbol'],
              'receiver_symbol' => trim($_POST['receiver_symbol']),
              'subject' => trim($_POST['subject']),
              'message' => trim($_POST['message']),
              'msg_code' => $msg_code,
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
              if($this->adminModel->AdminSendMessageInbox($data)){
                flash('alert_message', 'Message Sent');
                redirect('admin/admin_compose');
              } else {
                die('Something went wrong');
              }
            } else {
              // Load view with errors
             $this->view('inc/user_header');
           $this->view('admin/admin_compose', $data);
          $this->view('inc/user_footer');
            }

          } else {
             $total_sent = $this->adminModel->Totalsent($_SESSION['user_symbol']);
             $load_users = $this->utilityModel->getUsers();
           
            $data = [
              'message' => '',
              'total_sent' => $total_sent,
              'load_users' => $load_users
            ];
      
            $this->view('inc/user_header');
           $this->view('admin/admin_compose', $data);
          $this->view('inc/user_footer');
          }
        }


    



      public function inbox(){
            $total_sent = $this->adminModel->Totalsent($_SESSION['user_symbol']);
            $inbox = $this->adminModel->InboxMsg($_SESSION['user_symbol']);
            $total_inbox = $this->adminModel->Totalinbox($_SESSION['user_symbol']);

                  

             $data = [
              'inbox' => $inbox,
              'total_sent' => $total_sent,
              'total_inbox' => $total_inbox
                  
              
            ];
         

          $this->view('inc/user_header');
           $this->view('admin/inbox', $data);
          $this->view('inc/user_footer');
    }









    public function sent(){
      $sent = $this->adminModel->SentMsg($_SESSION['user_symbol']);
       $total_sent = $this->adminModel->Totalsent($_SESSION['user_symbol']);
        $total_inbox = $this->adminModel->Totalinbox($_SESSION['user_symbol']);

            

      $data = [
            'sent' => $sent,
             'total_sent' => $total_sent,
              'total_inbox' => $total_inbox
              ];

          $this->view('inc/user_header');
           $this->view('admin/sent', $data);
          $this->view('inc/user_footer');
    }





      public function open_message($msg_code){
          $read = 0;
         $open_msg = $this->adminModel->getMsgByCode($msg_code);
      $view_pro = $this->adminModel->updateMsgStatus($msg_code,$read);
      $total_sent = $this->adminModel->Totalsent($_SESSION['user_symbol']);
      $total_inbox = $this->adminModel->Totalinbox($_SESSION['user_symbol']);



      $data = [
        'open_msg' => $open_msg,
        'total_sent' => $total_sent,
        'total_inbox' => $total_inbox
            
        
      ];

      $this->view('inc/user_header');
      $this->view('admin/open_message', $data);
      $this->view('inc/user_footer');
    }



public function open_message_sent($msg_code){
          
         $open_msg = $this->adminModel->getMsgByCodeSent($msg_code);

      $total_sent = $this->adminModel->Totalsent($_SESSION['user_symbol']);
      $total_inbox = $this->adminModel->Totalinbox($_SESSION['user_symbol']);



      $data = [
        'open_msg' => $open_msg,
        'total_sent' => $total_sent,
        'total_inbox' => $total_inbox
            
        
      ];

      $this->view('inc/user_header');
      $this->view('admin/open_message_sent', $data);
      $this->view('inc/user_footer');
    }






  }