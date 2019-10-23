
            <!-- Start Breadcrumbbar -->                    
            <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title">Users</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Datatable</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="widgetbar">
                            <button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Actions</button>
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
                    
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Data Export Table</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel & Note.</h6>
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered">
                                        <thead>
                                         <tr>
                                            <th>SN</th>
                                            <th>Username</th>
                                            <th>Symbol</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Reg Date</th>
                                            <th>Action</th>
                                           
                                        </tr>

                                        </thead>
                                        <tbody>
                                         <?php  $count = 0; foreach($data['allusers'] as $allusers) :  $count++; ?>
                                       <tr>
                                            <td><?php echo $count; ?></td>
                                            <td> <?php echo $allusers->username; ?> </td>
                                            <td><?php echo $allusers->symbol; ?></td>
                                            <td><?php echo $allusers->email; ?></td>  
                                            <td><?php echo $allusers->phone; ?></td>
                                            <td><?php echo $allusers->reg_date; ?></td>
                                             <td><span class="badge badge-primary">Edit</span></td>
                                            
                                            
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