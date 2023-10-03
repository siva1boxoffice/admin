        <?php $this->load->view('common/header');?>
            <style type="text/css">
    .datetimepicker-dummy .datetimepicker-dummy-wrapper .datetimepicker-dummy-input{
        max-width: 100%;
    }
</style>
        <!-- Content Wrapper -->
         <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Currency List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="page-content is-relative business-dashboard course-dashboard">

                    
                     <div class="dashboard-title is-main">
                            <div class="left">
                                <h2 class="dark-inverted">Customers List</h2>
                            </div>
                            <div class="right">
                                <div class="list-flex-toolbar is-reversed ">
                        <a class="button is-circle is-primary" href="<?php echo base_url();?>settings/customers/add_customer">
                        <span class="icon is-small">
                        <i data-feather="plus"></i>
                        </span>
                        </a>
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


                        
                                        <form  method="get" accept="">
                    <div class="columns is-multiline">
                                            
                           

                                              <div class="column is-2">
                                                <div class="field">
                                                    <label>From Date *</label>
                                                    <div class="control">
                                                        <input type="date" id="bulma-datepicker-1" name="from_date" class="input" placeholder="From Date" required value="">
                                                    </div>
                                                </div>
                                            </div>

                                              <div class="column is-2">
                                                <div class="field">
                                                    <label>To Date *</label>
                                                    <div class="control">
                                                        <input type="date" id="bulma-datepicker-10" name="to_date" class="input" placeholder="To Date" required value="">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="column is-2">
                                                <div class="field">
                                                    <label>&nbsp;</label>
                                                    <input type="submit" name="" class="button h-button is-primary is-raised">
                                                </div>
                                            </div>
                                               
                                            <div class="column is-6">
                                                <div class="field" style="text-align: right;">
                                                  <label>&nbsp;</label>
                                                <a href="<?php echo base_url();?>settings/customers/download?from_date=<?php echo $_GET['from_date'] ?  $_GET['from_date'] : "2022-01-01"  ;?>&to_date=<?php echo $_GET['to_date'] ?  $_GET['to_date'] : date('Y-m-d')  ;?>" class="button h-button is-primary download_orders">
                                                    <img src="https://phplaravel-775269-2637193.cloudwaysapps.com/dev/1bx/admin/assets/img/icon_excel.svg">&nbsp;&nbsp;Download</a>
                                                </div>
                                        </div>
                                        
                                        </div>

                                        
                                     </form>

                    <div class="page-content-inner">

                        
                        <div class="flex-list-wrapper">


                                <div class="flex-table">

                                    <!--Table header-->
                                    <div class="flex-table-header" data-filter-hide>
                                    <span class="">Name</span>
                                    <span class="is-grow">Email</span>
                                    <span class="is-grow">Mobile No.</span>
                                    <span class="">User Type</span>
                                    <span class="">Verified</span>
                                    <span class="">Status</span>
                                    <span class="cell-end">Actions</span>
                                    </div>

                                    <div class="flex-list-inner">
                                        <?php foreach($customers as $customer){
                                           // echo "<pre>";print_r($match);
                                         ?>
                                        <!--Table item-->
                                        <div class="flex-table-item">
                                            <div class="flex-table-cell is-media " data-th="Name">
                                               
                                                <div>
                                                    <span class="item-name dark-inverted" data-filter-match><?php echo $customer->first_name;?> <?php echo $customer->last_name;?></span>
                                                </div>
                                            </div>
                                            <div class="flex-table-cell is-media is-grow" data-th="Email">
                                               
                                                <div>
                                                    <span class="light-text" data-filter-match><?php echo $customer->email;?></span>
                                                </div>
                                            </div>

                                              <div class="flex-table-cell is-media is-grow" data-th="Mobile No.">
                                               
                                                <div>
                                                    <span class="light-text" data-filter-match><?php echo $customer->dialing_code;?> <?php echo $customer->mobile;?></span>
                                                </div>
                                            </div>

                                            

                                            <div class="flex-table-cell " data-th="User Type">
                                                <span class="light-text" data-filter-match><?= $customer->user_type; ?></span>
                                            </div>

                                            
                                              <div class="flex-table-cell " data-th="Verified">
                                            <?php if($customer->active == '1'){ ?>
                                            <span class="tag is-success is-rounded">Verified</span>
                                            <?php }else if($customer->active != '1'){ ?>
                                            <span class="tag is-danger is-rounded">Not Verified</span>
                                            <?php } ?>
                                        </div>

                                          <div class="flex-table-cell" data-th="Status">
                                             <?php if($customer->status == '1'){ ?>
                                            <span class="tag is-success is-rounded">Active</span>
                                            <?php }else if($customer->status != '1'){ ?>
                                            <span class="tag is-danger is-rounded">InActive</span>
                                            <?php } ?>
                                        </div>

                                         <div class="flex-table-cell cell-end" data-th="Actions">
                                            <div class="dropdown is-spaced is-dots is-right dropdown-trigger is-pushed-mobile">
                                                <div class="is-trigger" aria-haspopup="true">
                                                    <i data-feather="more-vertical"></i>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">
                                                        <a href="<?php echo base_url();?>settings/customers/add_customer/<?php echo base64_encode(json_encode($customer->id));?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit Customer Details</span>
                                                            </div>
                                                        </a>
                                                        
                                                        <hr class="dropdown-divider">
                                                        <a id="branch_<?php echo $customer->id;?>" href="javascript:void(0);" data-href="<?php echo base_url();?>settings/customers/delete_customer/<?php echo $customer->id;?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $customer->id;?>');">
                                                            <div class="icon">
                                                                <i class="lnil lnil-trash-can-alt"></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Remove</span>
                                                                <span>Remove from list</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        </div>

                                         <?php } ?>

                                          <!-- Paginate -->
                                <div class="pagination datatable-pagination pagination-datatables flex-column">
                                        <?php echo $pagination; ?>
                                </div>

                                    </div>

                                </div>


                        </div>

                    </div>

                </div>
            </div>
        </div>

                <?php $this->load->view('common/footer');?>
                <script type="text/javascript">
                      bulmaCalendar.attach("#bulma-datepicker-1", { dateFormat: "YYYY-MM-DD" ,startDate: new Date('2022-01-01'), color: themeColors.primary, lang: "en",showHeader: false,
    showButtons: false,
    showFooter: false });

          bulmaCalendar.attach("#bulma-datepicker-10", {dateFormat: "YYYY-MM-DD" ,startDate: new Date('<?php echo date('Y-m-d');?>'), color: themeColors.primary, lang: "en",showHeader: false,
    showButtons: false,
    showFooter: false });

                </script>
                <?php exit;?>

