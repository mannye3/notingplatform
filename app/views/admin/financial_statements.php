
            <!-- Start Breadcrumbbar -->                    
            <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title">Annual Report</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/admins">Home</a></li>
                               
                                <li class="breadcrumb-item active" aria-current="page">Annual Report</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                                               
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
                            <div class="card-header">
                                <?php flash('alert_message'); ?>
                       
                            </div>
                            <div class="card-body">
                               
                                <div class="table-responsive">
                                    <table class="table foo-filtering-table" data-filtering="true">
                                        <thead>
                                        <tr>
                                            <th data-breakpoints="xs">SN</th>
                                           
                                            <th>Issuer</th>
                                          
                                            <th>Document</th>
                                             <th>Upload Date</th>
                                            <th>Actions</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                             <?php  $count = 0; foreach($data['allfinancial_statement'] as $allfinancial_statement) :  $count++; ?>
                                        <tr>

                                            

                                            <td><?php echo $count;  ?></td>
                                            
                                            <td><a href="<?php echo URLROOT; ?>/admins/open_news/<?php echo $allfinancial_statement->id; ?>"><?php echo $allfinancial_statement->symbol; ?></a></td>
                                           
                                            <td><?php echo $allfinancial_statement->financial_statement;  ?></td>
                                              <td><?php echo $allfinancial_statement->upload_date;  ?></td>
                                           <td>
                                                    <!-- <div class="button-list">
                                                        <a href="<?php echo URLROOT; ?>/public/financial_statement/<?php echo $allfinancial_statement->financial_statement; ?>"  class="btn btn-success-rgba" download><i class="fa fa-search-plus"></i></a>
                                                        
                                                    </div> -->

                                                    <div class="button-list">
                                                        <a href="<?php echo URLROOT; ?>/public/<?php echo $allfinancial_statement->financial_statement; ?>"  class="btn btn-success-rgba" download><i class="fa fa-search-plus"></i></a>
                                                        
                                                    </div>
                                            </td>
                                            
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

