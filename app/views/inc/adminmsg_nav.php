<?php foreach($data['total_inbox'] as $total_inbox) : ?>
         <?php endforeach; ?>

<?php foreach($data['total_sent'] as $total_sent) : ?>
         <?php endforeach; ?>

<div class="col-lg-3">
                        <div class="email-leftbar">
                            <div class="card m-b-30">
                                <div class="card-header text-center">
                                    <a href="<?php echo URLROOT; ?>/admins/compose" class="btn btn-danger-rgba btn-lg btn-block py-2 px-0 font-18"><i class="feather icon-plus mr-2"></i>Compose</a>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                      <li class="list-group-item d-flex justify-content-between align-items-center">
                                        
                                        <a href="<?php echo URLROOT; ?>/admins/inbox" class="active"><i class="feather icon-inbox mr-2"></i>Inbox</a>
                                        <span class="badge badge-primary-inverse text-primary"><?php echo number_format($total_inbox->totalmsginbox);  ?> 
                                    </span>
                                      </li>
                                      
                                
                                      <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="<?php echo URLROOT; ?>/admins/sent"><i class="feather icon-send mr-2"></i>Sent</a>
                                        <span class="badge badge-secondary-inverse">
                                          <?php echo number_format($total_sent->totalmsgsent);  ?>

                                         </span>




                                      </li>
                                      
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>