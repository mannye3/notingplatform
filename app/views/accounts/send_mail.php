
            <!-- End Topbar -->
            <!-- Start Breadcrumbbar -->                    
            <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title">Compose</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/accounts">Home</a></li>
                               
                                <li class="breadcrumb-item active" aria-current="page">Compose</li>
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
                    <?php require APPROOT . '/views/inc/msg_nav.php'; ?>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-lg-9">
                        <div class="email-rightbar">
                            <div class="card m-b-30">
                                <div class="card-header">
                                    <h5 class="card-title">New Message</h5>
                                </div>
                                <div class="card-body">
                                <?php flash('alert_message'); ?>                                  
                                    <form action="<?php echo URLROOT; ?>/accounts/send_mail2" method="post">
                                       <!--  <div class="form-group row">
                                            <label for="emailTo" class="col-sm-2 col-form-label">To</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="emailTo" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="emailCc" class="col-sm-2 col-form-label">CC</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="emailCc" placeholder="CC">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="emailBcc" class="col-sm-2 col-form-label">BCC</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="emailBcc" placeholder="BCC">
                                            </div>
                                        </div> -->
                                        

                                       <input type="email" name="to"><br> 
    Subject:<br>
    <input type="text" name="subject"><br><br>
    Message:
    <textarea rows="4" cols="40" name="message"> </textarea> 
    <input type="submit" name="send">
                                                <!-- <button type="submit" class="btn btn-success-rgba my-1"><i class="feather icon-save mr-2"></i>Save</button>
                                                <button type="submit" class="btn btn-danger-rgba my-1"><i class="feather icon-trash mr-2"></i>Delete</button> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
            <!-- End Contentbar -->

               
       