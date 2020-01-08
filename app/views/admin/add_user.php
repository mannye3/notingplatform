
            <!-- Start Breadcrumbbar -->                    
            
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
                            
                            </div>
                            <div class="card-body">
                               
                                <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h2 class="text-center">Add New Issuer</h2>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 col-xl-6">
                                        <form id="basic-form-wizard" method="post" action="<?php echo URLROOT; ?>/admins/add_user" >
                                            <div>
                                                <h3>Contact Details</h3>
                                                <section>
                                                    <div class="form-group">
                                                        <label for="username">Symbol</label>
                                                        <p style=" color: red;"><?php echo $data['symbol_err']; ?></p>
                                                        <input name="symbol"  type="text" class="form-control <?php echo (!empty($data['symbol_err'])) ? 'is-invalid' : ''; ?>" id="username" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Email</label>
                                                        <input name="email" type="email" class="form-control" id="password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="confirmPassword">Phone</label>
                                                        <input name="phone" type="number" class="form-control" id="confirmPassword">
                                                    </div>
                                                </section>
                                                <h3>Company Details</h3>
                                                <section>
                                                   
                                                    <div class="form-group">
                                                        <label for="firstname">Company Name</label>
                                                        <input name="company" required="" type="text" class="form-control" id="firstname">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lastname">Website</label>
                                                        <input name="website" type="text" class="form-control" id="lastname">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <textarea name="address" class="form-control" name="address"></textarea>
                                                        
                                                    </div>
                                                </section>
                                               
                                             
                                            </div>

                                        </form>  
                                    </div>  
                                </div>                             
                            </div>
                        </div>
                    </div> 
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>





