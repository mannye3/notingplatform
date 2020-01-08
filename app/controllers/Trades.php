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





          public function snap(){

       // $trade_date = date("Ymd");

    
    
      $mkt_snapshot = $this->accountModel->getmktsnap();

      $today = $this->accountModel->getPresentDay();
      $yesterday = $this->accountModel->getPresentLate();
      

      

           
          



          // echo  $refprice = $boyka->refprice; die();


      //    $refprice = $boyka->refprice;
      //   $closeprice = $boyka->closeprice;
      //   $pecup = $refprice * 1.1;
      //   $pecdown = $refprice * (1-0.1);


       


        //var_dump($getthings) . "<br>";

        // echo $security . "<br>";
        // echo $totVal . "<br>";
        // echo $id . "<br>";
        // echo $pecup . "<br>";
        // echo $pecdown . "<br>";


        // if($totVol >= 5000 ){
        //  $vwap = number_format( $totVal/$totVol,2);
        //    if($vwap >= $pecdown || $vwap >= $pecup){
        //       $price = $vwap;
        //         }
        //         else{
        //             $price = $refprice;
        //          }
        //           }elseif($totVol < 5000){
                                                                        
                                                                      
        //           $price = $refprice;
        //                                 }
        //            $change =   $price - $refprice ; 
        //            $percent = ($change / $refprice) * 100; 
        //            $percent = number_format($percent,2);


         // echo $boyka->id . "<br>";
         // echo $boyka->refprice* 1.1 . "<br>";
         // echo $boyka->closeprice* (1-0.1) . "<br>";








     //  echo $obj_dec;die();

     //    var_dump($properties_info); die();

     //  $catnam = $this->accountModel->eric($getthings->ID);




     // var_dump($getthings); die();


    
  
      
     
       
          $data = [
        'mkt_snapshot' => $mkt_snapshot,
        'today' => $today,
        'yesterday' => $yesterday
      
         
      ];



      // $data = [
      //   'properties_info' => $properties_info,
      //   'getthings' => $getthings,
      //   'boyka' => $boyka
                 
      // ];


     



    // echo   $data['properties_info']->Security; die();

     
 

                $this->view('inc/user_header');
                 $this->view('accounts/snap', $data);
                $this->view('inc/user_footer');
          }

  }