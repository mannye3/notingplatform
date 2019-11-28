

 

                                                  







            <!-- Start Breadcrumbbar -->                    
            <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title">Live Trades</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/accounts">Home</a></li>
                               
                                <li class="breadcrumb-item active" aria-current="page">Live Trades</li>
                            </ol>
                        </div>
                    </div>
                    
                </div>          
            </div>
            <!-- End Breadcrumbbar -->
            <!-- Start Contentbar -->    
            <div class="contentbar">                
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            
                            <div class="card-body">
                               
                                <div class="table-responsive">
                                     <table id="datatable-buttons" class="table  table-bordered">
                                        <thead>
                                         <tr>
                                                                <th>#</th>
                                                                <th>SYMBOL</th>
                                                                <th>OPEN</th>
                                                                <th>HIGH</th>
                                                                <th>HIGH QTY</th>
                                                                <!--<th>HIGH VALUE (N)</th>-->
                                                                <th>LOW</th>
                                                                <th>LOW QTY</th>
                                                                <!--<th>LOW VALUE (N)</th>-->
                                                                <th>DEALS</th>
                                                                <th>TOTAL QTY</th>
                                                                <th>TOTAL VALUE</th>
                                                                <th>CLOSE</th>
                                                                <th>% CHANGE</th>
                                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 0;  foreach($data['live_trade'] as $live_trade) : 
                                                     $security =  $live_trade->Security;
                                                  $totVol = $live_trade->totVol; 
                                                  $totVal =  $live_trade->totVal;
                                                  $maxprice = $live_trade->maxprice;
                                                  $maxqty = $live_trade->maxqty;
                                                  $minprice = $live_trade->minprice;
                                                  $minqty =  $live_trade->minqty;
                                                  $countall = $live_trade->countall;


                                                   


                                                     $getthings = $this->accountModel->getbasic($security);
                                                           $obj_enc2 = json_encode($getthings);
                                                          $obj_dec2 = json_decode($obj_enc2);

                                                          foreach ($obj_dec2 as $obj2)
                                                             $col1 =  $obj2->col1;

                                                         $boyka = $this->accountModel->getboyka($col1);

                                                            $obj_enc3 = json_encode($boyka);
                                                          $obj_dec3 = json_decode($obj_enc3);

                                                    foreach($obj_dec3 as $obj3)
                                                    $refprice = $obj3->refprice;
                                                   $closeprice = $obj3->closeprice;
                                                 $pecup = $refprice * 1.1;
                                                   $pecdown = $refprice * (1-0.1);




                                                   if($totVol >= 5000 ){

                                             $vwap = number_format($totVal/$totVol,2);
                                                 if($vwap >= $pecdown || $vwap >= $pecup){
                                                      $price = $vwap;

                                                             }
                                                              else{
                                                           $price = $refprice;
                                                               }
                                                       }elseif($totVol < 5000){     
                                                            $price = $refprice;
                                                             }
                                                                  
                                                          $change =   $price - $refprice ; 

                                                         $percent = ($change / $refprice) * 100; 
                                                             $percent = number_format($percent,2);


                                           if($percent > 0){
                                            $percents = "<span style='color:#07fe00'> &#9650; ".$percent."</span>";
                                            $percentsB = "<span style='color:#07fe00'>&#9650;".$percent."</span>";
                                               }
                                             if($percent < 0){
                                             $percents = "<span style='color:red'> &#9660; ".$percent."</span>";
                                             $percentsB = "<span style='color:red'>&#9660;".$percent."</span>";
                                               }
                                           if($percent == 0){
                                            $percents = "<span style='color:#ff6839'> &#8212; ".$percent."%</span>";
                                             $percentsB = "&#8212; ".$percent;
                                            }
                                             $count++;
                                 ?>
 
 
                                              

                                           
                                             
                                              

                                        <tr>
                                                                <th scope="row"><?=$count?></th>
                                                                <td><?=$security?></td>
                                                                <td> <?=$refprice?></td>
                                                                <td><?=$maxprice?></td>
                                                                <th><?=number_format($maxqty)?></th>
                                                                <!--<td></td>-->
                                                                <td><?=$minprice?></td>
                                                                <td><?=$minqty?></td>
                                                                <!--<th></th></th>-->
                                                                <td><?=$countall?></td>
                                                                <td><?=number_format($totVol)?></td>
                                                                 <td><?=number_format($totVal)?></td>
                                                                <th scope="row"><?=$price?></th>
                                                                <td><?=$percents?></td>
                                                                
                                                            </tr>
                                        
                                         
                                     
                                        
                                    
                                  
                                  
                                     <?php endforeach; ?>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>

