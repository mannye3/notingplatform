<?php
  class Trades extends Controller {
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

     
      $this->account3Model = $this->model('Account3');
      $this->accountModel = $this->model('Account');
      
    }

     public function index(){

       $trade_date = date("Ymd");

    //   $trade_date = '20191125';
    
      $live_trade = $this->account3Model->getLiveTrades($trade_date);

      
          $data = [
        'live_trade' => $live_trade     
      ];

                $this->view('inc/user_header');
                 $this->view('accounts/trades', $data);
                $this->view('inc/user_footer');
          }

  }