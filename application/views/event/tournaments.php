        <?php $this->load->view('common/header'); ?>
         <?php $only = @$_GET['only'] ;
          $only_url =   @$_GET['only'] ? "?only=".@$_GET['only']  : "" ;
         ?>
          <style type="text/css">
            .myactive {
                background-color: #272357 !important;
                color: #fff !important;
            }
        </style>
        <!-- Content Wrapper -->
        <div id="app-project" class="view-wrapper is-webapp" data-page-title="Flex Lists" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
          <div class="page-content-wrapper">


            <div class="page-content is-relative business-dashboard course-dashboard">

                <div class="columns">
              <div class="column is-2">
<!-- 
                  <select class="form-control source_type" style="margin-top: 30px;">
                          <option value="">All</option>
                          <option value="1boxoffice" <?php echo $only == "1boxoffice" ?  "selected" : ""  ?>>1BoxOffice</option>
                          <option value="tixstock" <?php echo $only == "tixstock" ?  "selected" : ""  ?> >TixStock</option>
                        </select> -->
                        
                        </div>
                         <div class="column is-10">
              <div class="list-flex-toolbar is-reversed flex-list-v2">



                <a class="button is-circle is-primary" href="<?php echo base_url(); ?>settings/tournaments/add">
                  <span class="icon is-small">
                    <i data-feather="plus"></i>
                  </span>
                </a>
                &nbsp;

                <div class="control has-icon">
                  <form method='post' action="<?= base_url() ?>/settings/tournaments<?php echo $only_url;?>">
                    <input type='text' class="input serchText" name='search' value='<?= $search ?>' placeholder="Search...">
                    <div class="form-icon">
                      <i data-feather="search"></i>
                    </div>
                    <input type='submit' class="button h-button is-primary is-raised" name='submit' value='Search'>
                  </form>
                </div>
                  <div class="tab_head">
                        <div class="list_button order_inf">


                         <a href="<?php echo base_url();?>settings/tournaments/untrashed<?php echo $only_url;?>" class="user_buts <?php if($this->uri->segment(3) == "untrashed" || $this->uri->segment(3) == ''){?>myactive<?php } ?>">Active</a>
                         <a href="<?php echo base_url();?>settings/tournaments/trashed<?php echo $only_url;?>" class="user_buts <?php if($this->uri->segment(3) == "trashed"){?>myactive<?php } ?>">Trashed</a>

                        
                        </div>
                        </div>
                <!-- <div class="dashboard-title is-main">
                  <div class="left">
                    <h2 class="dark-inverted">Tournament List</h2>
                  </div>
                </div> -->
              </div>
            </div> </div>

              <div class="page-content-inner">
                <div class="flex-list-wrapper flex-list-v2">
                  <div class="flex-table">

                    <!--Table header-->
                    <div class="flex-table-header" data-filter-hide>
                      <span class="is-grow">Tournament Id</span>

                      <span class="is-grow">Tournament Name</span>
                      <span class="is-grow">&nbsp;Tournament Image</span>
                      <span class="is-grow">&nbsp;&nbsp;Ticket Listed</span>
                      <span class="is-grow">Sort by</span>
                      <span class="is-grow">Status</span>
                      <span class="is-grow">SEO Status</span>
                      <span class="is-grow">Seo Preview</span>
                      <span class="is-grow">Clone</span>
                      <span class="is-grow">Source Type</span>
                      <?php if($only == "tixstock") {  ?> <span class="is-grow">Tixstock Status</span><?php } ?>
                      <span class="cell-end">Actions</span>
                    </div>
                    <div class="flex-list-inner">
                      <?php
                  foreach ($tournaments as $tournament) {
                  ?>
                        <!--Table item-->
                        <div class="flex-table-item">
                          <div class="flex-table-cell is-media is-grow">
                            <div>
                              <span class="item-name dark-inverted" data-filter-match><?php echo $tournament->t_id; ?></span>
                            </div>
                          </div>
                          <div class="flex-table-cell is-media is-grow">
                            <div>
                              <span class="item-name dark-inverted" data-filter-match><?php echo $tournament->tournament; ?></span>
                            </div>
                          </div>
                          <div class="flex-table-cell is-media is-grow">
                            <div>
                              <span class="light-text" data-filter-match>
                                <?php
                            if (UPLOAD_PATH . 'uploads/tournaments/' . $tournament->tournament_image) {
                              $image = UPLOAD_PATH . 'uploads/tournaments/' . $tournament->tournament_image;
                            } else {
                              $image = base_url('assets/img/placeholders/placeholder.png');
                            }
                            ?>
                                <img class="imgTbl" src="<?= $image; ?>"></span>
                            </div>
                          </div>

                          <div class="flex-table-cell" data-th="Status">
                            <?php if ($tournament->s_no != '') {  ?>
                              <span class="tag is-success is-rounded">Yes</span>
                            <?php } else if ($tournament->s_no == '') { ?>
                              <span class="tag is-danger is-rounded">No</span>
                            <?php } ?>
                          </div>
                          
                          <div class="flex-table-cell is-media is-grow">
                            <div>
                              <span class="light-text" data-filter-match><?php echo $tournament->sort_by; ?></span>
                            </div>
                          </div>

                          <div class="flex-table-cell" data-th="Status">
                            <?php if ($tournament->status == '1') {  ?>
                              <span class="tag is-success is-rounded">Active</span>
                            <?php } else if ($tournament->status == '0') { ?>
                              <span class="tag is-danger is-rounded">Inactive</span>
                            <?php } else if ($tournament->status == '2') { ?>
                              <span class="tag is-danger is-rounded">Trashed</span>
                            <?php } ?>
                          </div>
                            <div class="flex-table-cell" data-th="SEO Status">
                            <?php if ($tournament->seo_status == 1) { ?>

                              <span class="tag is-success is-rounded"><i aria-hidden="true" class="fas fa-check"></i></span>
                            <?php } else if ($tournament->seo_status != 1) { ?>
                              <span class="tag is-warning is-rounded"><i aria-hidden="true" class="fas fa-times "></i></span>
                            <?php } ?>
                          </div>
                          <div class="flex-table-cell is-media is-grow">
                                      <a target="_blank" href="<?php echo FRONT_END_URL; ?>/<?php echo $this->session->userdata('language_code');?>/<?php echo $tournament->url_key; ?>" class="dropdown-item is-media"><i class='fa fa-eye'></i></a>
                          </div>
                           <div class="flex-table-cell" data-th="clone">
                           <a class="button is-success" href="javascript:void(0);" onclick="clone_tournament('<?php echo $tournament->t_id; ?>');">
                            Clone
                            </a>
                          </div>
                          <div class="flex-table-cell flex-table-cell is-media is-grow" data-th="Source Type">
                            <?php echo $only   =="tixstock" && $tournament->source_type  =="1boxoffice" ? "1boxoffice, tixstock " : "tixstock"  ;?>


                          </div>

                          <?php if($only == "tixstock") {  ?> 
                            <div class="flex-table-cell" data-th="Tixsstock Status">
                              <div class="switch-block no-padding-all">
                                <label class="form-switch is-primary">
                            <input type="checkbox" data-id="<?php echo $tournament->t_id;?>" class="is-switch" data-status="<?php echo $tournament->tixstock_status;?>" name="tixstock_status" value="1" 
                            <?php if($tournament->tixstock_status == '1'){?> checked <?php } ?>>
                                    <i></i>
                                </label>
                            </div>
                          </div>
                         <?php }?>

                          <div class="flex-table-cell cell-end" data-th="Actions">
                            <div class="dropdown is-spaced is-dots is-right dropdown-trigger is-pushed-mobile">
                              <div class="is-trigger" aria-haspopup="true">
                                <i data-feather="more-vertical"></i>
                              </div>
                              <div class="dropdown-menu" role="menu">
                                <div class="dropdown-content">
                                  <?php if($this->session->userdata('role') != 9){?>
                                  <a href="<?php echo base_url(); ?>settings/tournaments/edit/<?php echo $tournament->t_id; ?>" class="dropdown-item is-media">
                                    <div class="icon">
                                      <i class='fa fa-edit'></i>
                                    </div>
                                    <div class="meta">
                                      <span>Edit</span>
                                      <span>Edit Tournament Details</span>
                                    </div>
                                  </a>
                                <?php } ?>
                                 <?php if($this->session->userdata('role') != 9){?>
                                  <a href="<?php echo base_url();?>settings/tournaments/edit_settings/<?php echo base64_encode(json_encode($tournament->t_id));?>" class="dropdown-item is-media">
                                    <div class="icon">
                                      <i class='fa fa-edit'></i>
                                    </div>
                                    <div class="meta">
                                      <span>Edit</span>
                                      <span>Tournament Settings</span>
                                    </div>
                                  </a>
                                <?php } ?>
                                  <a href="<?php echo base_url(); ?>settings/tournaments/add_content_tournment/<?php echo $tournament->t_id; ?>" class="dropdown-item is-media">
                                    <div class="icon">
                                      <i class='fa fa-edit'></i>
                                    </div>
                                    <div class="meta">
                                      <span>Content</span>
                                      <span>Edit Content Details</span>
                                    </div>
                                  </a>
                                  <?php if($this->session->userdata('role') != 9){?>
                                    <?php if ($tournament->s_no == '') {  ?>
                                  <hr class="dropdown-divider">
                                  <?php if($tournament->status != 2){?>
                                  <a id="branch_<?php echo $tournament->t_id; ?>" href="javascript:void(0);" data-href="<?php echo base_url(); ?>settings/tournaments/delete/<?php echo $tournament->t_id; ?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $tournament->t_id; ?>');">
                                    <div class="icon">
                                      <i class="lnil lnil-trash-can-alt"></i>
                                    </div>
                                    <div class="meta">
                                      <span>Remove</span>
                                      <span>Remove from list</span>
                                    </div>
                                  </a>
                                <?php } ?>
                                <?php } ?>
                                <?php if($tournament->status == 2){?>
                                  <a id="branch_<?php echo $tournament->t_id; ?>" href="javascript:void(0);" data-href="<?php echo base_url(); ?>settings/tournaments/delete_trash/<?php echo $tournament->t_id; ?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $tournament->t_id; ?>');">
                                    <div class="icon">
                                      <i class="lnil lnil-trash-can-alt"></i>
                                    </div>
                                    <div class="meta">
                                      <span>Undo</span>
                                      <span>Undo from trash</span>
                                    </div>
                                  </a>
                                <?php } ?>
                                <?php } ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
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
        <?php $this->load->view('common/footer'); ?>
        <script type="text/javascript">
          
          $(".source_type").on("change",function(){
              var val = $(this).val();
              if(val == "") val = "untrashed";
              window.location.replace("<?php echo base_url();?>settings/tournaments/" + val);
          });

          $("body").on("change",".is-switch",function(){
            var id = $(this).data('id');
            var status = $(this).data('status');
         
            if(status == 1){
                $(this).data('status',0);
                status = 0;
            }else{
                $(this).data('status',1);
                status = 1;
            }
          //  console.log(status +"--"+ id);
                $.ajax({
                    type: 'POST',
                    data: { "id" :  id ,'status' : status },
                    url: "<?php echo base_url();?>settings/tournaments/status", 
                    success: function(result) {
                       
                    }
                });
                  
          });
        </script>
