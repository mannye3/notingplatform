 <!-- Side Header Start -->
        <div class="side-header show">
            <button class="side-header-close"><i class="zmdi zmdi-close"></i></button>
            <!-- Side Header Inner Start -->
            <div class="side-header-inner custom-scroll">

                <nav class="side-header-menu" id="side-header-menu">

                     <?php if ($_SESSION['user_role'] == 'Admin') : ?>
                    <ul>
                         <li><a href="<?php echo URLROOT; ?>/accounts"><i class="ti-home"></i> <span>Dashboard</span></a></li>
                        <li><a href="<?php echo URLROOT; ?>/accounts"><i class="ti-home"></i> <span>Accounts</span></a></li>
                      

                    </ul>



                      <?php if ($_SESSION['user_role'] == 'Legal') : ?>
                    <ul>
                         <li><a href="<?php echo URLROOT; ?>/accounts"><i class="ti-home"></i> <span>Dashboard</span></a></li>
                           <li><a href="<?php echo URLROOT; ?>/accounts"><i class="ti-home"></i> <span>Legal</span></a></li>
                      

                    </ul>
                     <?php endif; ?>
                      <?php if ($_SESSION['user_role'] == 'Audit') : ?>
                    <ul>
                         <li><a href="<?php echo URLROOT; ?>/accounts"><i class="ti-home"></i> <span>Dashboard</span></a></li>
                           <li><a href="<?php echo URLROOT; ?>/accounts"><i class="ti-home"></i> <span>Audit</span></a></li>
                      

                    </ul>
                     <?php endif; ?>

                </nav>

            </div><!-- Side Header Inner End -->
        </div><!-- Side Header End -->