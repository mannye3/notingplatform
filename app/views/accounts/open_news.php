

    <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title">News</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/accounts">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">News</li>
                            </ol>
                        </div>
                    </div>
                    
                </div>           
            </div>
            <!-- Start Contentbar -->    
            <div class="contentbar">                
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            
                            <div class="card-body">
                                
                                <img src="<?php echo URLROOT; ?>/news_pics/<?php echo $data['open_new']->picture; ?>" class="img-fluid" alt="Responsive image">

                               <br><br><br><br>
                                <h5 class="card-title font-18"><?php echo $data['open_new']->page_title; ?></h5><br>
                                <p><?php echo $data['open_new']->page_content; ?></p>
                            </div>
                        </div>
                    </div>
                     
                   

                   


                   
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
            <!-- End Contentbar -->
            <!-- Start Footerbar -->
            <div class="footerbar">
                <footer class="footer">
                    <p class="mb-0">© 2019 Orbiter - All Rights Reserved.</p>
                </footer>
            </div>
            <!-- End Footerbar -->
        </div>
        <!-- End Rightbar -->
    </div>
     