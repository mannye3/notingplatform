<body>

    <div class="main-wrapper">

        <!-- Content Body Start -->
        <div class="content-body m-0 p-0">

            <div class="login-register-wrap">
                <div class="row">

                    <div class="d-flex align-self-center justify-content-center order-2 order-lg-1 col-lg-5 col-12">
                        <div class="login-register-form-wrap">

                            <div class="content">
                                <h1>Sign in</h1>
                                <p>Login to manage your account</p>
                            </div>

                            <div class="login-register-form">
                                <form action="<?php echo URLROOT; ?>/users" method="post">
                                    <div class="row">
                                        <div class="col-12 mb-20">
                                            <p style=" color: red;"><?php echo $data['email_err']; ?></p>
                                            <input type="text" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" placeholder="Enter Email here" required></div>
                                            
                                        <div class="col-12 mb-20"> <p style=" color: red;"><?php echo $data['password_err']; ?></p>
                                            <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"  placeholder="Enter Password here" required></div>
                                        <div class="col-12 mb-20"><label for="remember" class="adomx-checkbox-2"><input id="remember" type="checkbox"><i class="icon"></i>Remember.</label></div>
                                        <div class="col-12">
                                            <div class="row justify-content-between">
                                                <div class="col-auto mb-15"><a href="#">Forgot Password?</a></div>
                                                
                                            </div>
                                        </div>
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

   