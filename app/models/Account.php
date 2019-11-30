<?php
  class Account {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }





      public function updatePassword($data){
      $this->db->query('UPDATE issuers_accounts SET password = :password  WHERE id = :id');
      // Bind values
      $this->db->bind(':password',  $data['password']);
      $this->db->bind(':id',  $data['id']);
     
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }


     public function updateUser($data){
      $this->db->query('UPDATE issuers_accounts SET email = :email, phone = :phone, company = :company, website = :website, address = :address  WHERE id = :id');
      // Bind values
      $this->db->bind(':id',  $data['id']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':phone', $data['phone']);
      $this->db->bind(':company', $data['company']);
      $this->db->bind(':website', $data['website']);
      $this->db->bind(':address', $data['address']);
      

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }



// public function getMsgById($id){
//       $this->db->query('SELECT * FROM inbox_messages WHERE id = :id');
//       $this->db->bind(':id', $id);

//       $row = $this->db->single();

//       return $row;
//     }



    public function getMsgByCode($msg_code){
      $this->db->query('SELECT * FROM issuers_inbox_messages WHERE msg_code = :msg_code');
      $this->db->bind(':msg_code', $msg_code);

      $row = $this->db->single();

      return $row;
    }




    public function getMsgByCodeSent($msg_code){
      $this->db->query('SELECT * FROM issuers_messages WHERE msg_code = :msg_code');
      $this->db->bind(':msg_code', $msg_code);

      $row = $this->db->single();

      return $row;
    }


    public function updateMsgStatus($msg_code, $read){
       $this->db->query('UPDATE issuers_inbox_messages SET read_status = :read WHERE msg_code = :msg_code');
      // Bind values
      $this->db->bind(':msg_code', $msg_code);
      $this->db->bind(':read', $read);
     
     

   // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }




 public function Totalsent($symbol){
      $this->db->query('SELECT SUM(num) AS totalmsgsent FROM issuers_messages WHERE sender_symbol = :symbol  ');

      $this->db->bind(':symbol', $symbol);

     $results = $this->db->resultSet();

      return $results;
    }




      


    public function Totalinbox($symbol){
      $this->db->query('SELECT SUM(num) AS totalmsginbox FROM issuers_inbox_messages WHERE receiver_symbol = :symbol AND read_status = 1 ');

      $this->db->bind(':symbol', $symbol);

     $results = $this->db->resultSet();

      return $results;
    }

      





    //Add New Properties
      public function SendMessage($data){
      
      $this->db->query('INSERT INTO issuers_messages (subject, message, sender_username, sender_email, sender_symbol, receiver_symbol, msg_date, msg_code) VALUES(:subject, :message, :sender_username, :sender_email, :sender_symbol, :receiver_symbol, :msg_date, :msg_code)');
    
      // Bind Values      
      $this->db->bind(':subject', $data['subject']);
      $this->db->bind(':message', $data['message']);
      $this->db->bind(':sender_username', $data['sender_username']);
      $this->db->bind(':sender_email', $data['sender_email']);
      $this->db->bind(':sender_symbol', $data['sender_symbol']);
      $this->db->bind(':receiver_symbol', $data['receiver_symbol']);
      $this->db->bind(':msg_date', $data['msg_date']);
      $this->db->bind(':msg_code', $data['msg_code']);
      


     
    

      // Execute
      if($this->db->execute()){
        return true;
      }
      else{
        return false;
      }           
            
    }


    //Add New Properties
      public function ReplyMessage($data){
      
      $this->db->query('INSERT INTO issuers_messages (subject, message, sender_username, sender_email, sender_symbol, receiver_username, receiver_symbol , receiver_email ,  msg_date, msg_code) VALUES(:subject, :message, :sender_username, :sender_email, :sender_symbol, :receiver_username, :receiver_symbol , :receiver_email ,  :msg_date, :msg_code)');
    
      // Bind Values      
      $this->db->bind(':subject', $data['subject']);
      $this->db->bind(':message', $data['message']);
      $this->db->bind(':sender_username', $data['sender_username']);
      $this->db->bind(':sender_email', $data['sender_email']);
      $this->db->bind(':sender_symbol', $data['sender_symbol']);
      $this->db->bind(':receiver_username', $data['receiver_username']);
      $this->db->bind(':receiver_symbol', $data['receiver_symbol']);
      $this->db->bind(':receiver_email', $data['receiver_email']);
      $this->db->bind(':msg_date', $data['msg_date']);
      $this->db->bind(':msg_code', $data['reply_msg_code']);
      


     
    

      // Execute
      if($this->db->execute()){
        return true;
      }
      else{
        return false;
      }           
            
    }



    //Add New Properties
      public function SendMessageInbox($data){
      
      $this->db->query('INSERT INTO issuers_inbox_messages (subject, message, sender_username, sender_email, sender_symbol, receiver_symbol, msg_date, msg_code) VALUES(:subject, :message, :sender_username, :sender_email, :sender_symbol, :receiver_symbol,  :msg_date, :msg_code)');
    
      // Bind Values      
      $this->db->bind(':subject', $data['subject']);
      $this->db->bind(':message', $data['message']);
      $this->db->bind(':sender_username', $data['sender_username']);
      $this->db->bind(':sender_email', $data['sender_email']);
      $this->db->bind(':sender_symbol', $data['sender_symbol']);
      $this->db->bind(':receiver_symbol', $data['receiver_symbol']);
      $this->db->bind(':msg_date', $data['msg_date']);
      $this->db->bind(':msg_code', $data['msg_code']);
      


     
    

      // Execute
      if($this->db->execute()){
        return true;
      }
      else{
        return false;
      }           
            
    }



    //Add New Properties
      public function AdminSendMessageInbox($data){
      
      $this->db->query('INSERT INTO issuers_inbox_messages (subject, message, sender_username, sender_email, sender_symbol, receiver_symbol, msg_date, msg_code) VALUES(:subject, :message, :sender_username, :sender_email, :sender_symbol, :receiver_symbol,  :msg_date, :msg_code)');
    
      // Bind Values      
      $this->db->bind(':subject', $data['subject']);
      $this->db->bind(':message', $data['message']);
      $this->db->bind(':sender_username', $data['sender_username']);
      $this->db->bind(':sender_email', $data['sender_email']);
      $this->db->bind(':sender_symbol', $data['sender_symbol']);
      $this->db->bind(':receiver_symbol', $data['receiver_symbol']);
      $this->db->bind(':msg_date', $data['msg_date']);
      $this->db->bind(':msg_code', $data['msg_code']);
      


     
    

      // Execute
      if($this->db->execute()){
        return true;
      }
      else{
        return false;
      }           
            
    }



    //Add New Properties
      public function ReplyMessageInbox($data){
      
      $this->db->query('INSERT INTO issuers_inbox_messages (subject, message, sender_username, sender_email, sender_symbol, receiver_username, receiver_symbol , receiver_email ,  msg_date, msg_code) VALUES(:subject, :message, :sender_username, :sender_email, :sender_symbol, :receiver_username, :receiver_symbol , :receiver_email , :msg_date, :msg_code)');
    
      // Bind Values      
      $this->db->bind(':subject', $data['subject']);
      $this->db->bind(':message', $data['message']);
      $this->db->bind(':sender_username', $data['sender_username']);
      $this->db->bind(':sender_email', $data['sender_email']);
      $this->db->bind(':sender_symbol', $data['sender_symbol']);
      $this->db->bind(':receiver_username', $data['receiver_username']);
      $this->db->bind(':receiver_symbol', $data['receiver_symbol']);
      $this->db->bind(':receiver_email', $data['receiver_email']);
      $this->db->bind(':msg_date', $data['msg_date']);
      $this->db->bind(':msg_code', $data['reply_msg_code']);
      


     
    

      // Execute
      if($this->db->execute()){
        return true;
      }
      else{
        return false;
      }           
            
    }




 public function deleteMessageinbox($msg_code){
      $this->db->query('DELETE FROM issuers_inbox_messages WHERE msg_code = :msg_code');
      // Bind values
      $this->db->bind(':msg_code', $msg_code);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }


    public function deleteMessagesent($msg_code){
      $this->db->query('DELETE FROM issuers_messages WHERE msg_code = :msg_code');
      // Bind values
      $this->db->bind(':msg_code', $msg_code);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }




   





      public function getReport($symbol){ 
      $this->db->query('SELECT data.`TO ACCOUNT` AS BUYER_ACCOUNT , data.`TO MEMBER` AS TO_MEMBER , data.`FROM MEMBER` AS FROM_MEMBER , data.`VOLUME` AS VOLUME, data.`TRADE DATE` AS TRADE_DATE , data.`PRICE` AS PRICE    , smsNewAccount.SHAREHOLDERSNAME AS BUYER_NAME  ,
      data.`FROM ACCOUNT`  AS SELLER_ACCOUNT , smsNewAccount2.SHAREHOLDERSNAME AS SELLER_NAME
      FROM data
        INNER JOIN smsNewAccount ON data.`TO ACCOUNT` = smsNewAccount.ACCOUNTNUMBER
           INNER JOIN smsNewAccount2 ON data.`FROM ACCOUNT` = smsNewAccount2.ACCOUNTNUMBER
         WHERE data.SYMBOL=:symbol ORDER BY id DESC');

      
          

      // Bind Values
      $this->db->bind(':symbol', $symbol);

      $results = $this->db->resultSet();

      return $results;
    }


      public function SentMsg($symbol){
      $this->db->query('SELECT *  FROM issuers_messages WHERE sender_symbol = :symbol ORDER BY id DESC');

      // Bind Values
      $this->db->bind(':symbol', $symbol);

      $results = $this->db->resultSet();

      return $results;
    }



 public function InboxMsg($symbol){
      $this->db->query('SELECT *  FROM issuers_inbox_messages WHERE receiver_symbol = :symbol ORDER BY id DESC');

      // Bind Values
      $this->db->bind(':symbol', $symbol);

      $results = $this->db->resultSet();

      return $results;
    }


   public function GetallNews(){
      $this->db->query('SELECT *  FROM issuers_blog ORDER BY id DESC');
      //$this->db->bind(':ref_id', $ref_id);

      

    $results = $this->db->resultSet();

    return $results;

 
  }



  public function getNewsById($id){
      $this->db->query('SELECT * FROM issuers_blog WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }





    public function CloseDeal($symbol){
      $this->db->query('SELECT `Close Price` AS   Close_Price, `Date` AS Close_Date  FROM general_market_summary WHERE Security = :symbol');
      $this->db->bind(':symbol', $symbol);

      $results = $this->db->resultSet();

    return $results;

 
  }



public function Deals($symbol){
      $this->db->query('SELECT  `Daily Volume` AS Daily_Volume, `Date` AS Volume_Date  FROM general_market_summary WHERE Security = :symbol');
      $this->db->bind(':symbol', $symbol);

      $results = $this->db->resultSet();

    return $results;

 
  }





  public function getbasic($security){

 
      $this->db->query('SELECT  `COL 1` AS col1, `COL 2` AS col2, `COL 3` AS col3, `COL 4` AS col4, `COL 5` AS col5, `COL 6` AS col6, `COL 7` AS col7, `COL 8` AS col8, `COL 9` AS col9, `COL 10` AS col10, `COL 11` AS col11, `COL 12` AS col12, `COL 13` AS col13, `COL 14` AS col14, `COL 15` AS col15, `COL 16` AS col16, `COL 17` AS col17, `COL 18` AS col18, `COL 19` AS col19, `COL 20` AS col20 FROM security_to_traded WHERE `COL 11`= :security');
      $this->db->bind(':security', $security);

      

    
    
     
      $results = $this->db->resultSet();

    return $results;
  }





  Public function getboyka($id){

 
      $this->db->query('SELECT * FROM prices WHERE security_code =:id ');
      $this->db->bind(':id', $id);

      

    
    $results = $this->db->resultSet();

    return $results;
  }




   public function AddFinstat($data){
      
      $this->db->query('INSERT INTO issuers_fin_statement (symbol, financial_statement, upload_date) VALUES(:symbol, :financial_statement, :upload_date)');
      // Bind Values      
     
      $this->db->bind(':symbol', $data['symbol']);
      $this->db->bind(':financial_statement', $data['financial_statement']);
      $this->db->bind(':upload_date', $data['upload_date']);
      
       
           

      // Execute
      if($this->db->execute()){
        return true;
      }
      else{
        return false;
      }     
            
    }




  




    


  function sendMail_notification($data){
    // Send To Email
  $to  = strtolower(trim($data['receiver_email']));
  //$to  = strtolower(trim("root@localhost"));
  
  // subject
  $subject = 'New Message Notification';
  
  // message
  $message = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>' . SITENAME . '</title>
  <style type="text/css">

  * {
    margin:0;
    padding:0;
    font-family: Helvetica, Arial, sans-serif;
  }

  img {
    max-width: 100%;
    outline: none;
    text-decoration: none;
    -ms-interpolation-mode: bicubic;
  }

  .image-fix {
    display:block;
  }

  .collapse {
    margin:0;
    padding:0;
  }

  body {
    -webkit-font-smoothing:antialiased;
    -webkit-text-size-adjust:none;
    width: 100%!important;
    height: 100%;
    text-align: center;
    color: #747474;
    background-color: #ffffff;
  }

  h1,h2,h3,h4,h5,h6 {
    font-family: Helvetica, Arial, sans-serif;
    line-height: 1.1;
  }

  h1 small, h2 small, h3 small, h4 small, h5 small, h6 small {
    font-size: 60%;
    line-height: 0;
    text-transform: none;
  }

  h1 {
    font-weight:200;
    font-size: 44px;
  }

  h2 {
    font-weight:200;
    font-size: 32px;
    margin-bottom: 14px;
  }

  h3 {
    font-weight:500;
    font-size: 27px;
  }

  h4 {
    font-weight:500;
    font-size: 23px;
  }

  h5 {
    font-weight:900;
    font-size: 17px;
  }

  h6 {
    font-weight:900;
    font-size: 14px;
    text-transform: uppercase;
  }

  .collapse {
    margin:0!important;
  }

  td, div {
    font-family: Helvetica, Arial, sans-serif;
    text-align: center;
  }

  p, ul {
    margin-bottom: 10px;
    font-weight: normal;
    font-size:14px;
    line-height:1.6;
  }

  p.lead {
    font-size:17px;
  }

  p.last {
    margin-bottom:0px;
  }

  ul li {
    margin-left:5px;
    list-style-position: inside;
  }

  a {
    color: #747474;
    text-decoration: none;
  }

  a img {
    border: none;
  }

  .head-wrap {
    width: 100%;
    margin: 0 auto;
    background-color: #f9f8f8;
    border-bottom: 1px solid #d8d8d8;
  }

  .head-wrap * {
    margin: 0;
    padding: 0;
  }

  .header-background {
    background: repeat-x url(https://www.filepicker.io/api/file/wUGKTIOZTDqV2oJx5NCh) left bottom;
  }

  .header {
    height: 42px;
  }

  .header .content {
    padding: 0;
  }

  .header .brand {
    font-size: 16px;
    line-height: 42px;
    font-weight: bold;
  }

  .header .brand a {
    color: #464646;
  }

  .body-wrap {
    width: 505px;
    margin: 0 auto;
    background-color: #ffffff;
  }

  .soapbox .soapbox-title {
    font-size: 30px;
    color: #464646;
    padding-top: 25px;
    padding-bottom: 28px;
  }

  .content .status-container.single .status-padding {
    width: 80px;
  }

  .content .status {
    width: 90%;
  }

  .content .status-container.single .status {
    width: 300px;
  }

  .status {
    border-collapse: collapse;
    margin-left: 15px;
    color: #656565;
  }

  .status .status-cell {
    border: 1px solid #b3b3b3;
    height: 50px;
  }

  .status .status-cell.success,
  .status .status-cell.active {
    height: 65px;
  }

  .status .status-cell.success {
    background: #f2ffeb;
    color: #51da42;
  }

  .status .status-cell.success .status-title {
    font-size: 15px;
  }

  .status .status-cell.active {
    background: #fffde0;
    width: 135px;
  }

  .status .status-title {
    font-size: 16px;
    font-weight: bold;
    line-height: 23px;
  }

  .status .status-image {
    vertical-align: text-bottom;
  }

  .body .body-padded,
  .body .body-padding {
    padding-top: 5px;
  }

  .body .body-padding {
    width: 41px;
  }

  .body-padded,
  .body-title {
    text-align: left;
  }

  .body .body-title {
    font-weight: bold;
    font-size: 17px;
    color: #464646;
  }

  .body .body-text .body-text-cell {
    text-align: left;
    font-size: 14px;
    line-height: 1.6;
    padding: 9px 0 17px;
  }

  .body .body-signature-block .body-signature-cell {
    padding: 25px 0 30px;
    text-align: left;
  }

  .body .body-signature {
    font-family: "Comic Sans MS", Textile, cursive;
    font-weight: bold;
  }

  .footer-wrap {
    width: 100%;
    margin: 0 auto;
    clear: both !important;
    background-color: #e5e5e5;
    border-top: 1px solid #b3b3b3;
    font-size: 12px;
    color: #656565;
    line-height: 30px;
  }

  .footer-wrap .container {
    padding: 14px 0;
  }

  .footer-wrap .container .content {
    padding: 0;
  }

  .footer-wrap .container .footer-lead {
    font-size: 14px;
  }

  .footer-wrap .container .footer-lead a {
    font-size: 14px;
    font-weight: bold;
    color: #535353;
  }

  .footer-wrap .container a {
    font-size: 12px;
    color: #656565;
  }

  .footer-wrap .container a.last {
    margin-right: 0;
  }

  .footer-wrap .footer-group {
    display: inline-block;
  }

  .container {
    display: block !important;
    max-width: 505px !important;
    clear: both !important;
  }

  .content {
    padding: 0;
    max-width: 505px;
    margin: 0 auto;
    display: block;
  }

  .content table {
    width: 100%;
  }


  .clear {
    display: block;
    clear: both;
  }

  table.full-width-gmail-android {
    width: 100% !important;
  }

  </style>

  <style type="text/css" media="only screen">

  @media only screen {

    table[class*="head-wrap"],
    table[class*="body-wrap"],
    table[class*="footer-wrap"] {
      width: 100% !important;
    }

    td[class*="container"] {
      margin: 0 auto !important;
    }

  }

  @media only screen and (max-width: 505px) {

    *[class*="w320"] {
      width: 320px !important;
    }

    table[class="status"] td[class*="status-cell"],
    table[class="status"] td[class*="status-cell"].active {
      display: block !important;
      width: auto !important;
    }

    table[class="status-container single"] table[class="status"] {
      width: 270px !important;
      margin-left: 0;
    }

    table[class="status"] td[class*="status-cell"],
    table[class="status"] td[class*="status-cell"].active,
    table[class="status"] td[class*="status-cell"] [class*="status-title"] {
      line-height: 65px !important;
      font-size: 18px !important;
    }

    table[class="status-container single"] table[class="status"] td[class*="status-cell"],
    table[class="status-container single"] table[class="status"] td[class*="status-cell"].active,
    table[class="status-container single"] table[class="status"] td[class*="status-cell"] [class*="status-title"] {
      line-height: 51px !important;
    }

    table[class="status"] td[class*="status-cell"].active [class*="status-title"] {
      display: inline !important;
    }

  }
  </style>
</head>

<body bgcolor="#ffffff">

  <div align="center">
    <table class="head-wrap w320 full-width-gmail-android" bgcolor="#f9f8f8" cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td background="https://www.filepicker.io/api/file/UOesoVZTFObSHCgUDygC" bgcolor="#ffffff" width="100%" height="8" valign="top">
          <!--[if gte mso 9]>
          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:8px;">
            <v:fill type="tile" src="https://www.filepicker.io/api/file/UOesoVZTFObSHCgUDygC" color="#ffffff" />
            <v:textbox inset="0,0,0,0">
          <![endif]-->
          <div height="8">
          </div>
          <!--[if gte mso 9]>
            </v:textbox>
          </v:rect>
          <![endif]-->
        </td>
      </tr>
     
    </table>

    <table class="body-wrap w320">
      <tr>
        <td></td>
        <td class="container">
          <div class="content">
            <table cellspacing="0">
              <tr>
                <td>
                  <table class="soapbox">
                   
                  </table>
                  <table class="body">
                    <tr>
                      <td class="body-padding"></td>
                      <td class="body-padded">
                      
                        <table class="body-text">
                          <tr>
                            <td class="body-text-cell">
                             New message from '. strtoupper($data['sender_symbol']) .'
                            </td>
                          </tr>
                        </table>
                        <div style="text-align:left;"><!--[if mso]>
                          <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:38px;v-text-anchor:middle;width:190px;" arcsize="11%" strokecolor="#407429" fill="t">
                            <v:fill type="tile" src="https://www.filepicker.io/api/file/N8GiNGsmT6mK6ORk00S7" color="#41CC00" />
                            <w:anchorlock/>
                            <center style="color:#ffffff;font-family:sans-serif;font-size:17px;font-weight:bold;">Come on back</center>
                          </v:roundrect>
                        <![endif]--><a href="' . URLROOT . '/admins/open_message/'. $data['msg_code'] .'"
                        style="background-color:#41CC00;background-image:url(https://www.filepicker.io/api/file/N8GiNGsmT6mK6ORk00S7);border:1px solid #407429;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:17px;font-weight:bold;text-shadow: -1px -1px #47A54B;line-height:38px;text-align:center;text-decoration:none;width:190px;-webkit-text-size-adjust:none;mso-hide:all;">Read Message</a></div>
                        <table class="body-signature-block">
                          <tr>
                            
                          </tr>
                        </table>
                      </td>
                      <td class="body-padding"></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
        </td>
        <td></td>
      </tr>
    </table>

    
  </div>

</body>
</html>

  ';

  /*<html>
  <head>
    <title>Registration Information</title>
  </head>
  <body>
    <p>Welcome to ' . SITENAME . ' !</p>
    <p>Click on the link below to complete your registration.</p>
    <p><a href="' . URLROOT . 'users/compsignup/'. strtolower(trim($email)) .'" target="_blank">/users/compsignup/'.uniqid().uniqid().uniqid().uniqid().uniqid().'</a></p>
  </body>
  </html>*/
  
  // To send HTML mail, the Content-type header must be set
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  
  // Additional headers
  $headers .= 'To: '.strtolower(trim($data['receiver_email'])). "\r\n";
  // $headers .= 'From: ' . SITENAME . ' <info@' . URLROOT;
  $headers .= 'From: '.strtolower(trim($data['sender_symbol'])). "\r\n";
   $headers .= "CC: aboajahemmanuel@gmail.com";
  //$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n"; ?email='.strtolower(trim($_POST['txtEmail']))
  
  // Mail it
  
  if(mail($to, $subject, $message, $headers)){
      return true;
    }
    else{
        return false;
    }
}

   

    // public function addPost($data){
    //   $this->db->query('INSERT INTO posts (title, user_id, body) VALUES(:title, :user_id, :body)');
    //   // Bind values
    //   $this->db->bind(':title', $data['title']);
    //   $this->db->bind(':user_id', $data['user_id']);
    //   $this->db->bind(':body', $data['body']);

    //   // Execute
    //   if($this->db->execute()){
    //     return true;
    //   } else {
    //     return false;
    //   }
    // }

    // public function updatePost($data){
    //   $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
    //   // Bind values
    //   $this->db->bind(':id', $data['id']);
    //   $this->db->bind(':title', $data['title']);
    //   $this->db->bind(':body', $data['body']);

    //   // Execute
    //   if($this->db->execute()){
    //     return true;
    //   } else {
    //     return false;
    //   }
    // }

    // public function getPostById($id){
    //   $this->db->query('SELECT * FROM posts WHERE id = :id');
    //   $this->db->bind(':id', $id);

    //   $row = $this->db->single();

    //   return $row;
    // }

    // public function deletePost($id){
    //   $this->db->query('DELETE FROM posts WHERE id = :id');
    //   // Bind values
    //   $this->db->bind(':id', $id);

    //   // Execute
    //   if($this->db->execute()){
    //     return true;
    //   } else {
    //     return false;
    //   }
    // }
  }