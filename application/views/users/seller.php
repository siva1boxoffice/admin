<?php $this->load->view('common/header');?>
<style type="text/css">
    table td{ color: #000 !important; }
</style>
        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="page-content is-relative business-dashboard course-dashboard">

                  <div class="dashboard-title is-main">
                        <div class="left">
                            <h2 class="dark-inverted">Seller List</h2>
                        </div>
                        <div class="right">
                            <div class="list-flex-toolbar is-reversed ">
                       
                        &nbsp;
                         <div class="control has-icon">
                            <input class="input custom-text-filter" placeholder="Search..." data-filter-target=".flex-table-item">
                            <div class="form-icon">
                                <i data-feather="search"></i>
                            </div> 
                        </div>
                  </div>
                        </div>
                  </div>

                   
                    <div class="page-content-inner">
                       
                        <div class="flex-list-wrapper">

                        

                           <div class="flex-table">

                                    <!--Table header-->
                                   <div class="flex-table-header" data-filter-hide>
                                    <span>Seller Id</span>
                                    <span>Name</span>
                        
                                    <span class="is-grow">Email</span>
                                    <span>Contact</span>
                                    
                                    <span>Status</span>
                                    <span class="cell-end">Bank Details</span>
                                </div>
                                <?php foreach ($users as $user) { //echo "<pre>";print_r($role); 
                                ?>

                                    <div class="flex-table-item">
                                        
                                        <div class="flex-table-cell is-bold" data-th="Company">
                                               <div>
                                                <span class="item-name dark-inverted" data-filter-match><?php echo $user->admin_id; ?> 
                                                
                                            </div>
                                        </div>
                                       

                                        <div class="flex-table-cell is-bold" data-th="Company">
                                               <div>
                                                <span class="item-name dark-inverted" data-filter-match><?php echo $user->admin_name; ?> <?php echo $user->admin_last_name; ?></span><br>
                                                <b><?php echo $user->company_name; ?> </b>
                                                
                                            </div>
                                        </div>
                                       

                                        <div class="flex-table-cell is-bold  is-grow" data-th="Company">
                                            <span class="light-text"><?php echo $user->admin_email; ?></span>
                                        </div>

                                        <div class="flex-table-cell is-bold" data-th="Company">
                                            <span class="light-text"><?php echo $user->phone_code; ?> <?php echo $user->admin_cell_phone; ?></span>
                                        </div>


                                       
                                        <div class="flex-table-cell" data-th="Status">
                                            <?php if ($user->admin_status == 'ACTIVE') { ?>
                                                <span class="tag is-success is-rounded">Active</span>
                                            <?php } else if ($user->admin_status != 'ACTIVE') { ?>
                                                <span class="tag is-danger is-rounded">InActive</span>

                                            <?php } ?>
                                        </div>
                                        <div class="flex-table-cell cell-end" data-th="Actions">
                                           
                                            <a href="javascript:void(0)"  class="js-modal-trigger h-modal-trigger"  data-modal="modal-js-example<?php echo $user->admin_id;?>" >View Bank Detail</a>
                                        </div>
                                    </div>

                                    <div id="modal-js-example<?php echo $user->admin_id;?>" class="modal h-modal">
                                      <div class="modal-background h-modal-close"></div>

                                      <div class="modal-content">
                                        <div class="box">
                                          <h2>Bank Details</h2>

                                          <table class="table is-bordered" style="width: 100%;">
                                              <tr>
                                                <td style="width:50%">BeneficiaryName</td>
                                                <td><?php echo $user->beneficiary_name? $user->beneficiary_name: "-" ;?></td>
                                            </tr>

                                            <tr>
                                                <td>Bank Name</td>
                                                <td><?php echo $user->bank_name? $user->bank_name: "-" ;?></td>
                                            </tr>

                                             <tr>
                                                <td>Account Number</td>
                                                <td><?php echo $user->account_number? $user->account_number: "-" ;?></td>
                                            </tr>

                                             <tr>
                                                <td>Swift Code</td>
                                                <td><?php echo $user->swift_code? $user->swift_code: "-" ;?></td>
                                            </tr>



                                            <tr>
                                                <td>Iban Number</td>
                                                <td><?php echo $user->iban_number ? $user->iban_number : "-" ;?></td>
                                            </tr>



                                            <tr>
                                                <td>Beneficiary Address</td>
                                                <td><?php echo $user->beneficiary_address ?$user->beneficiary_address : "-" ;?></td>
                                            </tr>



                                           

                                          </table>
                                        </div>
                                      </div>

                                      <button class="h-modal-close is-large" aria-label="close"></button>
                                    </div>

                                <?php } ?>
                                <!-- Paginate -->
                                <div class="pagination datatable-pagination pagination-datatables flex-column">
                                    <?php echo $pagination; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $this->load->view('common/footer'); ?>

                    <?php exit;?>