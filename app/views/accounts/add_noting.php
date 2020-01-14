

        <!-- Content Body Start -->
        <div class="content-body">

            <!-- Page Headings Start -->
            <div class="row justify-content-between align-items-center mb-10">

                <!-- Page Heading Start -->
                <div class="col-12 col-lg-auto mb-20">
                    <div class="page-heading">
                        <h3>Add Noting</h3>
                    </div>
                </div><!-- Page Heading End -->

                <!-- Page Button Group Start -->
               

            </div><!-- Page Headings End -->
              <?php flash('alert_message'); ?>
            <!-- Add or Edit Product Start -->
            <div class="add-edit-product-wrap col-12">

                <div class="add-edit-product-form">
                    <form action="<?php echo URLROOT; ?>/accounts/upload_noting" enctype="multipart/form-data" method="post">

                        <h4 class="title">Add Noting</h4>

                        <div class="row">
                            <div class="col-lg-6 col-12 mb-30"><input class="form-control" type="text" name="company" placeholder="Company*"></div>
                            <div class="col-lg-6 col-12 mb-30"><input class="form-control" type="number" name="value" placeholder="Value"></div>
                            <div class="col-lg-6 col-12 mb-30"><input class="form-control" type="number" name="volume" placeholder="Volume"></div>
                            <div class="col-lg-6 col-12 mb-30"><input class="form-control" type="number" name="price" placeholder="Price"></div>
                            <div class="col-lg-6 col-12 mb-30"><input class="form-control" type="text" name="buyer" placeholder="Buyer"></div>
                            <div class="col-lg-6 col-12 mb-30"><input class="form-control" type="text" name="seller" placeholder="Seller"></div>
                            <div class="col-lg-6 col-12 mb-30"><input class="form-control" type="date" name="noting_date" placeholder="Date"></div>
                             <div class="col-lg-6 col-12 mb-30"><input class="form-control" type="text" name="broker_buyer" placeholder="Broker (Buyer)"></div>
                            <div class="col-lg-6 col-12 mb-30"><input class="form-control" type="text" name="broker_seller" placeholder="Broker (Seller)"></div>
                             
                
                        </div>

                        

                        <div class="product-upload-gallery row flex-wrap">
                            <div class="col-6 mb-30">
                                <h4 class="title">Supporting Document</h4>
                                <p class="form-help-text mt-0">Upload Maximum 800 x 800 px & Max size 2mb.</p>
                                <input class="dropify" name="file" type="file">
                            </div>

                             <div class="col-6 mb-30">
                                  <h4 class="title">Document to Registra</h4>
                                <p class="form-help-text mt-0">Upload Maximum 800 x 800 px & Max size 2mb.</p>
                               <input class="dropify" name="file2" type="file">
                            </div>
                        </div>

                                


                        <!-- Button Group Start -->
                        <div class="row">
                            <div class="d-flex flex-wrap justify-content-end col mbn-10">
                                <button name="submit" type="submit" class="button button-outline button-primary mb-10 ml-10 mr-0">Save</button>
                               
                            </div>
                        </div><!-- Button Group End -->

                    </form>
                </div>

            </div><!-- Add or Edit Product End -->

        </div><!-- Content Body End -->
