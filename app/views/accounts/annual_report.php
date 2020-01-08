
            <!-- Start Breadcrumbbar -->                    
            <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title">Upload Annual Report</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/accounts">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Upload Annual Report</li>
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
                    <div class="col-lg-7 col-xl-8">
                         <?php flash('alert_message'); ?>
                        <div class="card m-b-30">
                            
                            <div class="card-body">
                               <form id="login-form" action="<?php echo URLROOT; ?>/accounts/uploadannualreport" enctype="multipart/form-data" method="post">

                                  <input type="text" hidden="" name="symbol" value="<?= $_SESSION['user_symbol']?>" class="form-control font-20" id="productTitle"  placeholder="Title">
                         <div class="form-group row">
                             <label for="productTitle" class="col-sm-12 col-form-label">Upload Annual Report</label>
                                        <div class="col-sm-12">
                                             <input required="" type="file" name="file" class="dropify"  data-height="300"> 
                                        </div>
                                    </div>

                                <button type="type" name="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>

                        </div>
                                          
                            </div>
                            <!-- End col -->
                   

                   



                     </form>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>

            