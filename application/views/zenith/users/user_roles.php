        <?php $this->load->view(THEME.'common/header');?>

        <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
 <form id="profile-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url();?>home/users/save_permission">
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="page-title dflex-between-center">
                     <h3 class="mb-1">User Roles</h3>
                     <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2 tick_details">
                        <a href="<?php echo base_url();?>home/index"  class="btn btn-primary mb-2">Back</a>
                        <!-- <button  class="btn btn-success mb-2 ml-2">Save Changes</button> -->
                     </div>
                  </div>
               </div>
            </div>
            <!-- page content -->
            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">
                  <div class="card">
                     <div class="card-body">
                        <div class="table-responsive">
                           <table id="basic-datatable" class="table  table-hover table-nowrap mb-0  table-bordered ">
                             <thead class="thead-light">
                                    <tr>
                                        <th>Role</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                              <tbody>
                                <?php foreach($roles as $role){ ?>  
                                <tr>
                                    <td><?php echo  ucwords(strtolower($role->admin_role_name));?></td>
                                    <td><div class="bttns"><span class="badge <?php echo $role->status == 'ACTIVE'? 'badge-success' : 'badge-danger' ; ?>  "><?php echo ucfirst(strtolower($role->status));?></span></div></td>
                                </tr>    
                                <?php } ?>
                                    
                              </tbody>
                           </table>
                        </div>


                  
                       </div>
                     </div>                 
                  </div>
               </div>
            </div>
        </form>
         </div>
      </div>
      <!-- main content End -->
                <?php $this->load->view(THEME.'common/footer');?>


                <?php exit;?>