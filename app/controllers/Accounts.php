<?php
  class Accounts extends Controller {
    public function __construct(){

   if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
     $url = "https://";   
    else  
      $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];    
    // Append the requested resource location to the URL   
      $url.= $_SERVER['REQUEST_URI'];    
       $_SESSION['url'] = $url;


      if(!isLoggedIn()){
        redirect('users');
      }

      $this->accountModel = $this->model('Account');
      // $this->listingModel = $this->model('listing');
      $this->utilityModel = $this->model('Utility');
    }

      public function index(){
      
      $Close_Deal = $this->accountModel->CloseDeal($_SESSION['user_symbol']);

       $Deals = $this->accountModel->Deals($_SESSION['user_symbol']);

            

      $data = [
            'Close_Deal' => $Close_Deal,
             'Deals' => $Deals
              ];




              

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
      
            $msg_code= rand(100000,999999);

            $receiver_symbol = 'ADMINCODE';
            $receiver_email = 'eaboajah@nasdng.com';

           if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array

            
           
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          
            $data = [
              'sender_email' => $_SESSION['user_email'],
              'sender_username' => $_SESSION['username'],
              'sender_symbol' => $_SESSION['user_symbol'],
              'receiver_symbol' => $receiver_symbol,
              'receiver_email' => $receiver_email,
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
              if($this->accountModel->SendMessage($data)){

                  if($this->accountModel->SendMessageInbox($data)){
                   

                    if($this->accountModel->sendMail_notification($data)){
                      
                   flash('alert_message', 'Message Sent');
                    redirect('accounts/compose');
                 }

                  } 
              } 

             

              else {
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
             $total_inbox = $this->accountModel->Totalinbox($_SESSION['user_symbol']);
           
            $data = [
              'message' => '',
              'total_sent' => $total_sent,
               'total_inbox' => $total_inbox
            ];
      
            $this->view('inc/user_header');
           $this->view('accounts/compose', $data);
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
              if($this->accountModel->ReplyMessage($data)){

                    if($this->accountModel->ReplyMessageInbox($data)){
                    flash('alert_message', 'Message Sent');
                    redirect('accounts/inbox');
                  } 
              } 

              else {
                die('Something went wrong');
              }
            } else {
              // Load view with errors
             $this->view('inc/user_header');
           $this->view('accounts/reply', $data);
          $this->view('inc/user_footer');
            }

          } else {
             $total_sent = $this->accountModel->Totalsent($_SESSION['user_symbol']);
             $total_inbox = $this->accountModel->Totalinbox($_SESSION['user_symbol']);
             $reply_msg = $this->accountModel->getMsgByCode($msg_code);

             
           
            $data = [
              'message' => '',
              'total_sent' => $total_sent,
               'total_inbox' => $total_inbox,
               'reply_msg' => $reply_msg
            ];
      
            $this->view('inc/user_header');
            $this->view('accounts/reply', $data);
            $this->view('inc/user_footer');
          }
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
              if($this->accountModel->AdminSendMessageInbox($data)){
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
            $inbox = $this->accountModel->InboxMsg($_SESSION['user_symbol']);
            $total_inbox = $this->accountModel->Totalinbox($_SESSION['user_symbol']);

                  

             $data = [
              'inbox' => $inbox,
              'total_sent' => $total_sent,
              'total_inbox' => $total_inbox
                  
              
            ];
         

          $this->view('inc/user_header');
           $this->view('accounts/inbox', $data);
          $this->view('inc/user_footer');
    }


     public function send_mail(){
            // $total_sent = $this->accountModel->Totalsent($_SESSION['user_symbol']);
            // $inbox = $this->accountModel->InboxMsg($_SESSION['user_symbol']);
            // $total_inbox = $this->accountModel->Totalinbox($_SESSION['user_symbol']);

                  

            //  $data = [
            //   'inbox' => $inbox,
            //   'total_sent' => $total_sent,
            //   'total_inbox' => $total_inbox
                  
              
            
         

          $this->view('inc/user_header');
           $this->view('accounts/send_mail');
          $this->view('inc/user_footer');
    }









    public function sent(){
      $sent = $this->accountModel->SentMsg($_SESSION['user_symbol']);
       $total_sent = $this->accountModel->Totalsent($_SESSION['user_symbol']);
        $total_inbox = $this->accountModel->Totalinbox($_SESSION['user_symbol']);

            

      $data = [
            'sent' => $sent,
             'total_sent' => $total_sent,
              'total_inbox' => $total_inbox
              ];

          $this->view('inc/user_header');
           $this->view('accounts/sent', $data);
          $this->view('inc/user_footer');
    }





      public function open_message($msg_code){
          $read = 0;
         $open_msg = $this->accountModel->getMsgByCode($msg_code);
      $view_pro = $this->accountModel->updateMsgStatus($msg_code,$read);
      $total_sent = $this->accountModel->Totalsent($_SESSION['user_symbol']);
      $total_inbox = $this->accountModel->Totalinbox($_SESSION['user_symbol']);



      $data = [
        'open_msg' => $open_msg,
        'total_sent' => $total_sent,
        'total_inbox' => $total_inbox
            
        
      ];

      $this->view('inc/user_header');
      $this->view('accounts/open_message', $data);
      $this->view('inc/user_footer');
    }



      public function open_message_sent($msg_code){
                
               $open_msg = $this->accountModel->getMsgByCodeSent($msg_code);

            $total_sent = $this->accountModel->Totalsent($_SESSION['user_symbol']);
            $total_inbox = $this->accountModel->Totalinbox($_SESSION['user_symbol']);



            $data = [
              'open_msg' => $open_msg,
              'total_sent' => $total_sent,
              'total_inbox' => $total_inbox
                  
              
            ];

            $this->view('inc/user_header');
            $this->view('accounts/open_message_sent', $data);
            $this->view('inc/user_footer');
          }




 


          // public function edit_profile(){
          //   if($_SERVER['REQUEST_METHOD'] == 'POST'){

          //     // Sanitize POST array
          //     $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          //     // Init data
          //         $data =[
          //           'id' => $_SESSION['user_id'],
          //           'email' => trim($_POST['email']),
          //           'phone' => trim($_POST['phone']),
          //           'company' => trim($_POST['company']),
          //           'website' => trim($_POST['website']),
          //           'address' => trim($_POST['address']),
          //           'email_err' => '',
          //           'phone_err' => '',
          //         ];

                

          //         // Validate Email
          //         if(empty($data['email'])){
          //           $data['email_err'] = 'Pleae enter name';
          //         } else {
          
          //         }

          //         // Validate Phone
          //         if(empty($data['phone'])){
          //           $data['phone_err'] = 'Pleae enter phone';
          //         } else {
          //         }


              

          //         // Make sure errors are empty
          //         if(empty($data['email_err']) && empty($data['phone_err'])){
          //           // Validated
                    
          //       // Validated
          //       if($this->accountModel->updateUser($data)){



          //         $_SESSION['user_email'] = $data['email'];
          //         $_SESSION['user_phone'] = $data['phone'];
          //         $_SESSION['user_company'] = $data['company'];
          //         $_SESSION['user_website'] = $data['website'];
          //          $_SESSION['user_address'] = $data['address'];
                  
          //         flash('post_message', 'Profile Updated');
          //         redirect('accounts/profile');
          //       } else {
          //         die('Something went wrong');
          //       }
          //     } else {
          //       // Load view with errors
          //       $this->view('accounts/profile', $data);
          //     }

          //   } else {
            

          //     $data =[
          //           'email' => '',
          //           'phone' => '',
          //           'company' => '',
          //           'website' => '',
          //           'address' => '',
          //           'email_err' => '',
          //           'phone_err' => ''
          //         ];
        
          //     $this->view('accounts/profile', $data);
          //   }
          // }







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
                 
              

                  /// Make sure errors are empty
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





    

           public function tradeHistory(){
                     $get_report = $this->accountModel->getReport($_SESSION['user_symbol']);
                     // $get_brokerinfo = $this->accountModel->getBroker();
                     // $get_accountinfo = $this->accountModel->getAccount();
                     
                      

                  
                   
                    $data = [
                  'get_report' => $get_report
                  // 'get_brokerinfo' => $get_brokerinfo
                   // 'get_accountinfo' => $get_accountinfo
                   
                    ];

                    $this->view('inc/user_header');
                     $this->view('accounts/tradeHistory', $data);
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

           $get_news = $this->accountModel->GetallNews();

           $data = [

             'get_news' => $get_news
              
            ];

                $this->view('inc/user_header');
                 $this->view('accounts/news', $data);
                $this->view('inc/user_footer');
          }



            public function open_news($id){
                
              $open_new = $this->accountModel->getNewsById($id);
              


              $data = [
                'open_new' => $open_new
               
                    
                
              ];

              $this->view('inc/user_header');
              $this->view('accounts/open_news', $data);
              $this->view('inc/user_footer');
            }



               public function fin_stat(){
       

                $this->view('inc/user_header');
                 $this->view('accounts/fin_stat', $data);
                $this->view('inc/user_footer');
          }



     function uploadfinstat(){
              if(isset($_POST['submit']))
              {

                      $target_dir = FINANCIAL_STAT_ROOT_PATH;
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
                      'symbol' => trim($_POST['symbol']),
                      'financial_statement' => $NewImageName,
                      'upload_date' => date('jS \ F Y h:i:s A')
                      );

                      
                    $this->accountModel->AddFinstat($data);
                    }
                    flash('alert_message', 'Financial Statement Uploaded');
                    redirect('accounts/fin_stat');
                 
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
              




              public function delete_msg_inbox($msg_code){
                
                  // Get existing post from model
                 $msg_info = $this->accountModel->getMsgByCode($msg_code);
                
                  // Check for owner
                  if($post->user_id != $_SESSION['user_id']){
                    redirect('accounts');
                  }

                  if($this->accountModel->deleteMessageinbox($msg_code)){
                    flash('alert_message', 'Message Removed');
                    redirect('accounts/inbox');
                  } else {
                    die('Something went wrong');
                  }
                  }



                   public function delete_msg_sent($msg_code){
                
                  // Get existing post from model
                 $msg_info = $this->accountModel->getMsgByCodeSent($msg_code);
                
                  // Check for owner
                  if($post->user_id != $_SESSION['user_id']){
                    redirect('accounts');
                  }

                  if($this->accountModel->deleteMessagesent($msg_code)){
                    flash('alert_message', 'Message Removed');
                    redirect('accounts/sent');
                  } else {
                    die('Something went wrong');
                  }
                  }
          


        function send_mail2(){
    if(isset($_POST['send']))
        {
    $to_email=$_POST['to'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];

    
      
    $to = $to_email;
        $subject = $subject;
        $txt = $message;
        $headers = "From: afasina@nasdotcng.com" . "\r\n" .
        "CC: eaboajah@nasdng.com";
    mail($to,$subject,$txt,$headers);
    }

    flash('alert_message', 'Message Sent');
                    redirect('accounts/send_mail');
        // $this->view->render('accounts/send_mail');
  }
     
    


  }