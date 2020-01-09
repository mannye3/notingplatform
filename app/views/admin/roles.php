
        <!-- Content Body Start -->
        <div class="content-body">

            <!-- Page Headings Start -->
            <div class="row justify-content-between align-items-center mb-10">

                <!-- Page Heading Start -->
                <div class="col-12 col-lg-auto mb-20">
                    <div class="page-heading">
                        <h3>Roles </h3>
                    </div>
                </div><!-- Page Heading End -->

                <!-- Page Button Group Start -->
                <div class="col-12 col-lg-auto mb-20">
                    <div class="buttons-group">
                       
                        <button class="button button-outline button-info"  data-toggle="modal" data-target="#exampleModal5" data-whatever="@mdo">Add New Role</button>

                         <!-- ADD NEW ACCOUNT MODAL -->
                            <div class="modal fade" id="exampleModal5">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add New Role</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="<?php echo URLROOT; ?>/admins/roles">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Role Title:</label>
                                                    <input required="" type="text" name="role_title" class="form-control" id="recipient-name">
                                                </div>
                                                
                                              
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button class="button button-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" class="button button-primary">Save changes</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>

                       
                    </div>
                </div><!-- Page Button Group End -->

            </div><!-- Page Headings End -->

            <div class="row">


                <!--Export Data Table Start-->
                <div class="col-12 mb-30">
                    <div class="box">
                     <?php flash('alert_message'); ?>
                        <div class="box-body">

                            <table class="table table-bordered data-table data-table-export">
                                <thead>
                                    <tr>
                                        <th>Role Title</th>
                                        <th>Reg Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php  $count = 0; foreach($data['allroles'] as $allroles) :  $count++; ?>
                                    <tr>
                                        <td><?php echo $allroles->role_title; ?></td>
                                        <td><?php echo $allroles->reg_date; ?></td>
                                         <td>
                                        <div class="table-action-buttons">
                                       
                                            <button class="edit button button-box button-xs button-info" data-toggle="modal" data-target="#exampleModal<?php echo $allroles->id; ?>" data-whatever="@fat"><i class="zmdi zmdi-edit"></i> </button>
                                         <!--    <a class="delete button button-box button-xs button-danger" href="#"><i class="zmdi zmdi-delete"></i></a> -->

                                            <form action="<?php echo URLROOT; ?>/admins/delete_role/<?php echo $allroles->id; ?>" method="POST">
                                    <input type="hidden" name="id" id="p_id" value="<?php echo $allroles->id; ?>">
                                    <button class="btn btn-danger" name="archive" type="submit" onclick="archiveFunction()">
                                        <i class="fa fa-trash"></i>
                                            Delete
                                    </button>
                            </form>
                                        </div>
                                    </td>
                                       
                                    </tr>
                                      <div class="modal fade" id="exampleModal<?php echo $allroles->id; ?>">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Account</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                        </div>

                                         <!-- ADD EDIT ROLE MODAL -->
                                        <div class="modal-body">
                                            <form action="<?php echo URLROOT; ?>/admins/edit_role/<?php echo $allroles->id; ?>" method="post">
                                                <div class="form-group">
                                                    <input type="hidden" value="<?php echo $allroles->id; ?>" name="id" >
                                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                                    <input  value="<?php echo $allroles->role_title; ?>" type="text" name="role_title" class="form-control" id="recipient-name">
                                                </div>
                                                 
                                        </div>
                                        <div class="modal-footer">
                                            <button class="button button-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" class="button button-primary">Save changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                                    <?php endforeach; ?>
                                 
                                </tbody>
                              
                            </table>

                        </div>
                    </div>
                </div>
                <!--Export Data Table End-->

               

            </div>

        </div><!-- Content Body End -->







       
     