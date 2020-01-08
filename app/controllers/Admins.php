<?php
  class Admins extends Controller {
    public function __construct(){
      if(!isLoggedIn()){
        redirect('admin_logins');
      }

      $this->adminModel = $this->model('Admin');
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

            

      $data = [
            'allusers' => $allusers
              ];

          $this->view('inc/admin_header');
           $this->view('admin/accounts', $data);
          $this->view('inc/admin_footer');
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

             $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            

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




         public function delete_user($id){
            

              if($this->adminModel->deleteUser($id)){
                flash('alert_message', 'Account Removed');
                redirect('admins/accounts');
              } 
                  else {
                    die('Something went wrong');
                  }

              }




               public function annual_reports(){
      $allannual_reports = $this->adminModel->getannual_reports();

            

      $data = [
            'allannual_reports' => $allannual_reports
              ];

          $this->view('inc/user_header');
           $this->view('admin/annual_reports', $data);
          $this->view('inc/user_footer');
    }




public function financial_statements(){
      $allfinancial_statement = $this->adminModel->getfinancial_statements();

            

      $data = [
            'allfinancial_statement' => $allfinancial_statement
              ];

          $this->view('inc/user_header');
           $this->view('admin/financial_statements', $data);
          $this->view('inc/user_footer');
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




function dawnload_file($path) {
    if (file_exists($path) && is_file($path)) {
        // file exist
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($path));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        set_time_limit(0);
        @readfile($path);//"@" is an error control operator to suppress errors
    } else {
        // file doesn't exist
        die('Error: The file ' . basename($path) . ' does not exist!');
    }
}

  }