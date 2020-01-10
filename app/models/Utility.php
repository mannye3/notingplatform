<?php
	class Utility {
		private $db;

		public function __construct(){
			$this->db = new Database();
		}


		public function getRoles(){
			$this->db->query( 'SELECT  * FROM roles ');

			$results = $this->db->resultSet();

			return $results;
		}



		function PasswordResetEmail($data){
    // Send To Email
  $to  = strtolower(trim($data[ 'email' ]));
 
  
  // subject
  $subject =  'New Message Notification';
  
  // message
  $message =  '
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <!--[if !mso]><!-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <!--[if !mso]><!-->
  <style type="text/css">
    @font-face {
              font-family: "flama-condensed ";
              font-weight: 100;
              src: url( "http://assets.vervewine.com/fonts/FlamaCond-Medium.eot ");
              src: url( "http://assets.vervewine.com/fonts/FlamaCond-Medium.eot?#iefix ") format( "embedded-opentype "),
                    url( "http://assets.vervewine.com/fonts/FlamaCond-Medium.woff ") format( "woff "),
                    url( "http://assets.vervewine.com/fonts/FlamaCond-Medium.ttf ") format( "truetype ");
          }
          @font-face {
              font-family:  "Muli ";
              font-weight: 100;
              src: url( "http://assets.vervewine.com/fonts/muli-regular.eot ");
              src: url( "http://assets.vervewine.com/fonts/muli-regular.eot?#iefix ") format( "embedded-opentype "),
                    url( "http://assets.vervewine.com/fonts/muli-regular.woff2 ") format( "woff2 "),
                    url( "http://assets.vervewine.com/fonts/muli-regular.woff ") format( "woff "),
                    url( "http://assets.vervewine.com/fonts/muli-regular.ttf ") format( "truetype ");
            }
          .address-description a {color: #000000 ; text-decoration: none;}
          @media (max-device-width: 480px) {
            .vervelogoplaceholder {
              height:83px ;
            }
          }
  </style>


<body bgcolor="#e1e5e8" style="margin-top:0 ;margin-bottom:0 ;margin-right:0 ;margin-left:0 ;padding-top:0px;padding-bottom:0px;padding-right:0px;padding-left:0px;background-color:#e1e5e8;">

  <center style="width:100%;table-layout:fixed;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#e1e5e8;">
    <div style="max-width:600px;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;">
      <table align="center" cellpadding="0" style="border-spacing:0;font-family: "Muli ",Arial,sans-serif;color:#333333;Margin:0 auto;width:100%;max-width:600px;">
        <tbody>
          <tr>
            <td align="center" class="vervelogoplaceholder" height="143" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;height:143px;vertical-align:middle;" valign="middle"></td>
          </tr>
          
          <tr>
            <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;background-color:#ffffff;">
             
              <table style="border-spacing:0;" width="100%">
                <tbody>
                
                  <tr>
                    <td class="inner contents center" style="padding-top:15px;padding-bottom:15px;padding-right:30px;padding-left:30px;text-align:left;">
                      <center>
                        <p class="h1 center" style="Margin:0;text-align:center;font-family: "flama-condensed ", "Arial Narrow ",Arial;font-weight:100;font-size:30px;Margin-bottom:26px;">Forgot your password?</p>
                        <!--[if (gte mso 9)|(IE)]><![endif]-->

                        <p class="description center" style="font-family: "Muli ", "Arial Narrow ",Arial;Margin:0;text-align:center;max-width:320px;color:#a1a8ad;line-height:24px;font-size:15px;Margin-bottom:10px;margin-left: auto; margin-right: auto;"><span style="color: rgb(161, 168, 173); font-family: Muli, &quot;Arial Narrow&quot;, Arial; font-size: 15px; text-align: center; background-color: rgb(255, 255, 255);">That "s okay, it happens! Click on the button below to reset your password.</span></p>
                        <span class="sg-image" data-imagelibrary="%7B%22width%22%3A%22260%22%2C%22height%22%3A54%2C%22alt_text%22%3A%22Reset%20your%20Password%22%2C%22alignment%22%3A%22%22%2C%22border%22%3A0%2C%22src%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/c1e9ad698cfb27be42ce2421c7d56cb405ef63eaa78c1db77cd79e02742dd1f35a277fc3e0dcad676976e72f02942b7c1709d933a77eacb048c92be49b0ec6f3.png%22%2C%22link%22%3A%22%23%22%2C%22classes%22%3A%7B%22sg-image%22%3A1%7D%7D"><a href="' . URLROOT . '/users/reset_password/'. $data['pass_res_token'] .'" target="_blank"><img alt="Reset your Password" height="54" src="https://marketing-image-production.s3.amazonaws.com/uploads/c1e9ad698cfb27be42ce2421c7d56cb405ef63eaa78c1db77cd79e02742dd1f35a277fc3e0dcad676976e72f02942b7c1709d933a77eacb048c92be49b0ec6f3.png" style="border-width: 0px; margin-top: 30px; margin-bottom: 50px; width: 260px; height: 54px;" width="260"></a></span>
                       </center>
                    </td>
                  </tr>
                </tbody>
              </table>
             
            </td>
          </tr>
          
          <tr>
            <td height="40">
              <p style="line-height: 40px; padding: 0 0 0 0; margin: 0 0 0 0;">&nbsp;</p>

              <p>&nbsp;</p>
            </td>
          </tr>
      
          <tr>
            <td height="25">
              <p style="line-height: 25px; padding: 0 0 0 0; margin: 0 0 0 0;">&nbsp;</p>

              <p>&nbsp;</p>
            </td>
          </tr>
         
          <tr>
            <td height="40">
              <p style="line-height: 40px; padding: 0 0 0 0; margin: 0 0 0 0;">&nbsp;</p>

              <p>&nbsp;</p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </center>
</body>

   ';

  /*<html>
  <head>
    <title>Registration Information</title>
  </head>
  <body>
    <p>Welcome to  " . SITENAME .  " !</p>
    <p>Click on the link below to complete your registration.</p>
    <p><a href=" " . URLROOT .  "users/compsignup/ ". strtolower(trim($email)) . "" target="_blank">/users/compsignup/ ".uniqid().uniqid().uniqid().uniqid().uniqid(). "</a></p>
  </body>
  </html>*/
  
  // To send HTML mail, the Content-type header must be set
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  
  // Additional headers
  $headers .= 'To: '.strtolower(trim($data['email'])). "\r\n";
  $headers .= 'From: ' . SITENAME . ' <info@' . URLROOT. "\r\n";
  // $headers .= 'From: '.strtolower(trim($data['sender_symbol'])). "\r\n";
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

}

