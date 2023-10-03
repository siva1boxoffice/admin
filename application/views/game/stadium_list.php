        <?php $this->load->view('common/header'); ?>

        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Stadium List" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">
            <div class="page-content-wrapper">
                <div class="page-content is-relative business-dashboard course-dashboard">
                    <div class="page-content-inner">                     
                        
                    <div class="dashboard-title is-main">
                            <div class="left">
                                <h2 class="dark-inverted">Stadium List</h2>
                            </div>
                            <div class="right">
                                <div class="list-flex-toolbar is-reversed flex-list-v2">
                        <a class="button is-circle is-primary" href="<?php echo base_url(); ?>game/stadium/add_stadium">
                            <span class="icon is-small">
                                <i data-feather="plus"></i>
                            </span>
                        </a>
                        &nbsp;
                        <div class="control has-icon">

                            <form method='post' action="<?= base_url() ?>/game/stadium/list_stadium">
                                <input type='text' class="input serchText" name='search' value='<?= $search ?>' placeholder="Search...">
                                <div class="form-icon">
                                    <i data-feather="search"></i>
                                </div>
                                <input type='submit' class="button h-button is-primary is-raised" name='submit' value='Search'>
                            </form>
                        </div>
                        
                    </div>
                            </div>
                        </div>

                        <div class="flex-list-wrapper">
                            <div class="flex-table has-loader-active">

                                <!--Table header-->
                                <div class="flex-table-header">
                                    <span>SNO</span>
                                    <span>Stadium Name in English</span>
                                    <span>Stadium Name in Arabic</span>
                                    <span>Stadium Variant</span>
                                    <span>Stadium Width</span>
                                    <span>Stadium Height</span>
                                    <span>Status</span>
                                    <span>Matches</span>
                                    <span class="cell-end">Actions</span>
                                </div>
                                <?php foreach ($stadiums as $stadium) {
                                $match_count = 0;
                                $match_count = $this->General_Model->getAllItemTable_Array('match_info', array('venue' => $stadium->s_id,'event_type' => 'match'))->num_rows();

                                ?>
                                    <div class="flex-table-item">
                                        <div class="flex-table-cell is-bold" data-th="nameEnglish">
                                            <span class="dark-text"><?php echo $stadium->s_id; ?></span>
                                        </div>
                                        <div class="flex-table-cell is-bold" data-th="nameEnglish">
                                            <span class="dark-text"><?php echo $stadium->stadium_name; ?></span>
                                        </div>
                                       
                                        <div class="flex-table-cell is-bold" data-th="nameArabic">
                                            <span class="dark-text"><?php echo $stadium->stadium_name_ar; ?></span>
                                        </div>
                                         <div class="flex-table-cell is-bold" data-th="nameArabic">
                                            <span class="dark-text"><?php echo $stadium->stadium_variant; ?></span>
                                        </div>
                                        <div class="flex-table-cell is-bold" data-th="width">
                                            <span class="dark-text"><?php echo $stadium->width; ?></span>
                                        </div>
                                        <div class="flex-table-cell is-bold" data-th="height">
                                            <span class="dark-text"><?php echo $stadium->height; ?></span>
                                        </div>
                                        <div class="flex-table-cell" data-th="Status">
                                            <?php if ($stadium->status == '1') { ?>
                                                <span class="tag is-success is-rounded">Active</span>
                                            <?php } else if ($stadium->status == '0') { ?>
                                                <span class="tag is-danger is-rounded">InActive</span>
                                            <?php } ?>
                                        </div>
                                        <div class="flex-table-cell" data-th="Matches">
                                        <?php if($match_count > 0){ ?>
                                        <a class="button is-danger" target="_blank" href="<?php echo base_url(); ?>event/stadium_matches/<?php echo $stadium->s_id; ?>">
                                                        Matches (<?php echo $match_count;?>)
                                                        </a>
                                        <?php } ?>
                                        </div>
                                        <div class="flex-table-cell cell-end" data-th="Actions">
                                            <div class="dropdown is-spaced is-dots is-right dropdown-trigger is-pushed-mobile">
                                                <div class="is-trigger" aria-haspopup="true">
                                                    <i data-feather="more-vertical"></i>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">

                                                        <a href="javascript:void(0)" class="dropdown-item is-media open_merge" data-id="<?php echo $stadium->s_id; ?>" data-name="<?php echo $stadium->stadium_name; ?>">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Merge</span>
                                                                <span>Merge Stadium </span>
                                                            </div>
                                                        </a>

                                                        <a href="<?php echo base_url(); ?>game/stadium/get_stadium/<?php echo $stadium->s_id; ?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit Stadium Details</span>
                                                            </div>
                                                        </a>

                                                        <hr class="dropdown-divider">
                                                        <a id="branch_<?php echo $stadium->s_id; ?>" href="javascript:void(0);" data-href="<?php echo base_url(); ?>game/stadium/delete_stadium/<?php echo $stadium->s_id; ?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $stadium->s_id; ?>','stadium');" data-id="stadium">
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

 
  <div id="image-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-content">
     <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title  card_title">Modal title</p>
    </header>
    <section class="modal-card-body">
        <p>Choose Stadium to Merge</p>
        <input type="hidden" name="new_stadium" id="new_stadium">
           <select name="old_stadium" id="old_stadium" class="form-control">
               <option value="">Select Stadium</option>
               <?php foreach($stadium_list as $value){
                ?>
                <option value="<?php echo $value->s_id ;?>"><?php echo $value->stadium_name ;?> - <?php echo $value->s_id ;?></option>
                <?php 
               } ?>
           </select> 
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success connect_merge">Connect</button>
      <button class="button modal-close-2">Cancel</button>
    </footer>
  </div>
    </div>
    <button id="image-modal-close" class="modal-close"></button>
  </div>

    <button class="button" id="showModal">Show</button>
              <?php $this->load->view('common/footer'); ?>

                    <script type="text/javascript">

                            var btn = document.querySelector('#showModal');
                                var modalDlg = document.querySelector('#image-modal');
                                var imageModalCloseBtn = document.querySelector('#image-modal-close');

                                $('.open_merge').on('click', function(){

                                    var id = $(this).attr("data-id");
                                    var name = $(this).attr("data-name");

                                    $("#new_stadium").val(id);
                                    $(".card_title").html(name);                                  modalDlg.classList.add('is-active');
                                });

                                imageModalCloseBtn.addEventListener('click', function(){
                                  modalDlg.classList.remove('is-active');
                                });
                                // .click(function() {
                                //   .addClass("is-active");  
                                // });

                                $(".modal-close-2").click(function() {
                                   $(".modal").removeClass("is-active");
                                });

                                 $('.connect_merge').on('click', function(){

                                   var old_stadium =   $("#old_stadium").val();
                                    var new_stadium =  $("#new_stadium").val();

                                    window.location.href = "<?php echo base_url();?>event/update_blocks/"+old_stadium+"/"+new_stadium+"";

                                 });

                            </script>
                    <?php exit;?>
