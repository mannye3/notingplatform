<body>

    <div class="main-wrapper">

        <!-- Content Body Start -->
        <div class="content-body m-0 p-0">

            <div class="login-register-wrap">
                <div class="row">

                    <div class="d-flex align-self-center justify-content-center order-2 order-lg-1 col-lg-5 col-12">
                        <div class="login-register-form-wrap">

                            <div class="content">
                                <h1>Reset Password</h1>
                                <p>Login to manage your account</p>
                            </div>

                            <div class="login-register-form">
                                <form action="<?php echo URLROOT; ?>/users/reset_password/<?php echo $data['user_profile']->pass_res_token; ?>" method="post">
                                    <div class="row">
                                        
                                            
                                        <div class="col-12 mb-20"></p>
                                            <input type="" name="email" value="<?php echo $data['user_profile']->email; ?>">
                                            <input type="" name="pass_res_token" value="<?php echo $data['user_profile']->pass_res_token; ?>">
                                            <input type="password" id="password" name="password" class="form-control" minlength="6"  placeholder="Enter New Password here" required></div>

                                            <div class="col-12 mb-20">
                                            <input type="password" name="password" id="confirm_password" class="form-control"  placeholder="Confirm Password" required></div>
                                        <div class="col-12 mb-20"></div>
                                       
                                        <div class="col-12 mt-10"><button class="button button-primary button-outline">sign in</button></div>
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

   