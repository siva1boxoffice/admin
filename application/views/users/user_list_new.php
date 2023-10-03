<?php  $this->load->view(THEME.'common/header'); ?>
    <!-- Begin main content -->
      <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-sm-5 col-xl-6">
                        <div class="page-title">
                           <h3 class="mb-1 font-weight-bold">Welcome back, <?php echo $this->session->userdata('storefront')->company_name; ?></h3>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- page content -->
            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">
                  <!-- Widget  -->
                 
                  <!-- Row 3-->
                  <div class="row">
                     <!-- Begin recent orders -->
                     <div class="col-12 col-lg-12">
                        <div class="card">
                           <div class="card-header dflex-between-center">
                              <h5 class="card-title">Recent Orders</h5>
                              <div class="export-fnc">
                                 <a href="<?php echo base_url(); ?>game/orders/list_order/all"><button type="button" class="btn btn-primary waves-effect waves-light" data-effect="wave">View More</button></a>
                                 <!-- game/orders/list_order/all -->
                              </div>
                           </div>
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table class="table table-hover table-nowrap mb-0">
                                    <thead class="thead-light">
                                       <tr>
                                          <th>USER</th>
                                          <th>LOCATION</th>
                                          <th>CONTACT</th>
                                          <th>ROLE</th>
                                          <th>STATUS</th>
                                          <th>ACTIONS</th>
                                       </tr>
                                    </thead>
                                    <tbody>

                                    <?php if ($users) {
                                                foreach ($users as $user) {
                                    ?>
                                         <tr>
                                          <td><?php echo $user->company_name; ?></td>
                                          <td><?php echo $user->city_name; ?></td>
                                          <td><?php echo $user->admin_cell_phone; ?></td>
                                          <td> <?php echo $user->admin_status; ?></td>
                                          <td> edit</td>
                                          <td>Edit</td>
                                       </tr>
                                    <?php
                                                }
                                            }
                                            else{ ?>
                                            <tr><td colspan="9"><h3>No Recent Orders.</h3></td></tr>
                                           <?php }
                                    ?>

                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div><!-- End recent orders -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- main content End -->
<?php $this->load->view(THEME.'common/footer'); ?>