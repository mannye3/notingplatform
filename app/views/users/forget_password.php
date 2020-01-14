<body>

    <div class="main-wrapper">

        <!-- Content Body Start -->
        <div class="content-body m-0 p-0">

            <div class="login-register-wrap">
                <div class="row">

                    <div class="d-flex align-self-center justify-content-center order-2 order-lg-1 col-lg-5 col-12">
                        <div class="login-register-form-wrap">

                            <div class="content">
                                <h1>Forget Password</h1>
                                <p>Enter your email to get reset link</p>
                            </div>
                           <?php flash('alert_message'); ?>
                            <div class="login-register-form">
                                <form action="<?php echo URLROOT; ?>/users/forget_password" method="post">
                                    <div class="row">
                                        <div class="col-12 mb-20">
                                            <p style=" color: red;"><?php echo $data['email_err']; ?></p>
                                            <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" placeholder="Enter Email here" required></div>

                                             <div class="col-12">
                                            <div class="row justify-content-between">
                                                <div class="col-auto mb-15"><a href="<?php echo URLROOT; ?>">Login</a></div>
                                                
                                            </div>
                                        </div>
                                      
                                        <div class="col-12 mt-10"><button class="button button-primary button-outline">Submit</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="login-register-bg order-1 order-lg-2 col-lg-7 col-12">
                        <div class="content">
                            
                        </div>
                    </div>

                </div>
            </div>

        </div><!-- Content Body End -->

    </div>

   