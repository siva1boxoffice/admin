  <?php  $tournments   = $this->General_Model->get_tournments()->result();
//echo "<pre>";print_r($tournments);
  ?>

        <?php $only = @$_GET['only'] ;
          $only_url =   @$_GET['only'] ? "?only=".@$_GET['only']  : "" ;
         ?>
        <?php $this->load->view('common/header');?>
        <style type="text/css">
            .myactive {
                background-color: #272357 !important;
                color: #fff !important;
            }
            .toptable tr {
                height: 70px !important;
            }
        </style>
        <!-- Content Wrapper -->
        <div id="app-project" class="view-wrapper is-webapp" data-page-title="Flex Lists" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="page-content is-relative tabs-wrapper is-slider is-squared is-inverted">

                    <div class="list-flex-toolbar is-reversed flex-list-v2">

                        <a class="button is-circle is-primary" href="<?php echo base_url();?>event/matches/add_match<?php echo $only_url;?>">
                        <span class="icon is-small">
                        <i data-feather="plus"></i>
                        </span>
                        </a>
                        &nbsp;
                         <div class="control has-icon">
                         <form method='post' action="<?= base_url() ?>/event/matches/<?php echo $status_flag;?><?php echo $only_url;?>">
                                <input type='text' class="input serchText" name='search' value='<?= $search ?>' placeholder="Search...">
                                <input type='hidden' name='tournment_id' id="tournment_id" value=''>
                                <input type='hidden' name='tournement_defualt_id' id="tournement_defualt_id" value=''>
                                <div class="form-icon">
                                    <i data-feather="search"></i>
                                </div>
                               <!--  <input type="hidden" name="status_flag" value="<?php echo $status_flag;?>"> -->
                                <input type='submit' class="button h-button is-primary is-raised" name='submit' value='Search' id="searchFm">
                            </form>
                            <!-- <input class="input custom-text-filter" placeholder="Search..." data-filter-target=".flex-table-item">
                            <div class="form-icon">
                                <i data-feather="search"></i>
                            </div> -->
                            
                        </div>
                        <div class="tab_head">
                            <div class="filter">
                                <select class="form-control choose_tournment">
                            <option value="">All Tournment</option>
                            <?php foreach ($tournments as $tournment) { ?>
                            <option value="<?php echo $tournment->t_id;?>" <?php if($tournment->t_id == $tournment_id){?> selected <?php } ?>><?php echo $tournment->tournament_name;?></option>
                             <?php } ?>
                            </select>
                            <div class="form-check">
                            <input class="form-check-input" name="tournement_defualt" type="checkbox" value="1" id="tournement_defualt" <?php if($this->session->userdata('tournament_search') != ""){?> checked <?php } ?>>
                            <label class="form-check-label" for="tournement_defualt">
                            Keep Tournment Selected
                            </label>
                            </div>

                            </div>

                            <div class="filter">

                            <!--      <select class="form-control source_type" >
                                      <option value="">All</option>
                                      <option value="1boxoffice" <?php echo $only == "1boxoffice" ?  "selected" : ""  ?>>1BoxOffice</option>
                                      <option value="tixstock" <?php echo $only == "tixstock" ?  "selected" : ""  ?> >TixStock</option>
                                    </select> -->
                             </div>
                        <div class="list_button order_inf">
                            
                        <a href="<?php echo base_url();?>event/matches/upcoming<?php echo $only_url;?>" class="user_buts <?php if($this->uri->segment(3) == "upcoming"){?>myactive<?php } ?>">Upcoming</a>
                         <a href="<?php echo base_url();?>event/matches/expired<?php echo $only_url;?>" class="user_buts <?php if($this->uri->segment(3) == "expired"){?>myactive<?php } ?>">Expired</a>
                         <a href="<?php echo base_url();?>event/matches/trashed<?php echo $only_url;?>" class="user_buts <?php if($this->uri->segment(3) == "trashed"){?>myactive<?php } ?>">Trashed</a>
                        </div>
                        </div>

                       <!--  <div class="">

                            <div class="tabs">
                                <ul>
                                    <li <?php if(($status_flag == "upcoming" && $status_flag != "expired" )){ ?> class="is-active" <?php } ?>><a href="<?php echo base_url();?>event/matches/upcoming"><span>Upcoming</span></a></li>
                                    <li <?php if($status_flag == "expired"){ ?> class="is-active" <?php } ?>><a href="<?php echo base_url();?>event/matches/expired"><span>Expired</span></a></li>
                                    <li class="tab-naver"></li>
                                </ul>
                            </div>
                        </div> -->
                    </div>

                    <div class="page-content-inner">


                        <div class="tab_sec orders list_odd" id="no-more-tables">
  <table class="toptable res_table_new table-responsive">
   <tbody>
      <tr class="accordion ui-accordion ui-widget ui-helper-reset">
         <th>Match Name</th>
         <th>Stadium</th>
         <th>Home Team</th>
         <th>Match Date</th>
         <th>Tournament</th>
         <th>Top games</th>
         <th>Ticket Listed</th>
         <th>Status</th>
         <th>SEO Status</th>
         <th>Seo Preview</th>
         <th>Source Type</th>
         <?php if($only == "tixstock") {?><th>Tikstock Status</th><?php } ?>
         <th>Actions</th>
      </tr>
      <?php  foreach($matches as $match){ ?>
      <tr>
         <td data-label="Match Name"> <span class="item-name dark-inverted" data-filter-match=""><?php echo $match->match_name;?></span> </td>
         <td data-label="Home Team"><span class="light-text" data-filter-match=""><?php echo $match->stadium_name;?></span> </td>
         <td data-label="Home Team"><span class="light-text" data-filter-match=""><?php echo $match->team_name;?></span> </td>
         <td data-label="Match Date"><span class="light-text" data-filter-match=""><?php echo date('d F Y H:i',strtotime($match->match_date)); ?></span> </td>
         <td data-label="Tournament"> <span class="light-text" data-filter-match=""><?= $match->tournament_name; ?></span></td>
        <td data-label="Top games">   <?php if($match->top_games == '1'){  ?>
        <span class="tag is-success is-rounded">Yes</span>
        <?php }else if($match->top_games != '1'){ ?>
        <span class="tag is-danger is-rounded">No</span>
        <?php } ?></td>
              <td data-label="Status">  <?php if($match->s_no != ''){ ?>
                                            <span class="tag is-success is-rounded">Yes</span>
                                            <?php }else if($match->s_no == ''){ ?>
                                            <span class="tag is-danger is-rounded">No</span>
                                            <?php } ?></td>
         <td data-label="Ticket Listed">  <?php if($match->match_status == '1'){ ?>
                                            <span class="tag is-success is-rounded">Active</span>
                                            <?php }else if($match->match_status == '0'){ ?>
                                            <span class="tag is-danger is-rounded">InActive</span>
                                            <?php } else if($match->match_status == '2'){ ?>
                                            <span class="tag is-danger is-rounded">Trashed</span>
                                            <?php } ?></td>
   
         <td data-label="SEO Status"> <?php if ($match->seo_status == 1) { ?>

                              <span class="tag is-success is-rounded"><i aria-hidden="true" class="fas fa-check"></i></span>
                            <?php } else if ($match->seo_status != 1) { ?>
                              <span class="tag is-warning is-rounded"><i aria-hidden="true" class="fas fa-times "></i></span>
                            <?php } ?></td>
         <td data-label="Seo Preview"><a target="_blank" href="<?php echo FRONT_END_URL; ?>/<?php echo $this->session->userdata('language_code');?>/<?php echo $match->slug; ?>" class="dropdown-item is-media"><i class='fa fa-eye'></i></a></td>
         <td data-label="Soruce Type"><?php echo $only   =="tixstock" && $match->source_type  =="1boxoffice" ? "1boxoffice, tixstock " : $match->source_type  ;?></td>
         <?php if($only == "tixstock") {?><td><div class="switch-block no-padding-all">
                <label class="form-switch is-primary">
            <input type="checkbox" data-id="<?php echo $match->m_id;?>" class="is-switch" data-status="<?php echo $match->tixstock_status;?>" name="tixstock_status" value="1" 
            <?php if($match->tixstock_status == '1'){?> checked <?php } ?>>
                    <i></i>
                </label>
            </div></td><?php } ?>
         <td data-label="Actions">
             <div class="dropdown is-spaced is-dots is-right dropdown-trigger is-pushed-mobile">
                                                <div class="is-trigger" aria-haspopup="true">
                                                    <i data-feather="more-vertical"></i>
                                                </div>
                                                <div class="dropdown-menu" role="menu">
                                                    <div class="dropdown-content">
                                                        <?php if($this->session->userdata('role') != 9){?>
                                                        <a href="<?php echo base_url();?>event/matches/add_match/<?php echo base64_encode(json_encode($match->m_id));?><?php echo $only_url;?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Edit Match Details</span>
                                                            </div>
                                                        </a>
                                                    <?php } ?>
                                                        <hr class="dropdown-divider">
                                                         <a href="<?php echo base_url();?>event/matches/add_content/<?php echo base64_encode(json_encode($match->m_id));?><?php echo $only_url;?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Content</span>
                                                                <span>Edit Content Details</span>
                                                            </div>
                                                        </a>
                                                        <?php if($this->session->userdata('role') != 9){?>
                                                             <hr class="dropdown-divider">
                                                                 <a href="<?php echo base_url();?>settings/match_settings/set_match_settings/<?php echo base64_encode(json_encode($match->m_id));?><?php echo $only_url;?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-cog'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Edit</span>
                                                                <span>Match Settings</span>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">
                                                         <a href="<?php echo base_url();?>event/matches/tickets/<?php echo base64_encode(json_encode($match->m_id));?><?php echo $only_url;?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Tickets</span>
                                                                <span>View Ticket Details</span>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">
                                                         <a href="<?php echo base_url();?>event/matches/purchase_info/<?php echo base64_encode(json_encode($match->m_id));?><?php echo $only_url;?>" class="dropdown-item is-media">
                                                            <div class="icon">
                                                                <i class='fa fa-edit'></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Purchase Info</span>
                                                                <span>View Purchase Details</span>
                                                            </div>
                                                        </a>
                                                        <hr class="dropdown-divider">
                                                        <?php if($match->status != 2){?>
                                                              <?php if($match->s_no == ''){ ?>
                                                        <a id="branch_<?php echo $match->m_id;?>" href="javascript:void(0);" data-href="<?php echo base_url();?>event/matches/delete_match/<?php echo $match->m_id;?><?php echo $only_url;?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $match->m_id;?>');">
                                                            <div class="icon">
                                                                <i class="lnil lnil-trash-can-alt"></i>
                                                            </div>
                                                            <div class="meta">
                                                                <span>Remove</span>
                                                                <span>Remove from list</span>
                                                            </div>
                                                        </a>
                                                        <?php } ?>
                                                    <?php } else {?>
                                                        <a id="branch_<?php echo $match->m_id;?>" href="javascript:void(0);" data-href="<?php echo base_url();?>event/matches/undo_match/<?php echo $match->m_id;?>" class="dropdown-item is-media delete_action" onClick="delete_data('<?php echo $match->m_id;?>');">
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
         </td>
      </tr>
  <?php } ?>
  
   </tbody>
</table>
  <div class="pagination datatable-pagination pagination-datatables flex-column">
                                        <?php echo $pagination; ?>
                                </div>
</div>



                      

                    </div>

                </div>
            </div>
        </div>



                <?php $this->load->view('common/footer');?>
<script type="text/javascript">
  
    $(document).ready(function () {
        $(".choose_tournment").on('change',function() {
            var tournment_id = $(this).val();
            $("#tournement_defualt_id").val(0);
            if($("#tournement_defualt").is(":checked")){
                $("#tournement_defualt_id").val(1);
            }
            $("#tournment_id").val(tournment_id);
            submit_saerch();
            
        });
        function submit_saerch(){
            $("#searchFm").trigger('click');
        }
    });
    

          
          $(".source_type").on("change",function(){
              var val = $(this).val();
              if(val == "") val = "untrashed";
              window.location.replace("<?php echo base_url();?>event/matches/" + val);
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
            //console.log(status);
                $.ajax({
                    type: 'POST',
                     data: { "id" :  id ,'status' : status },
                    url: "<?php echo base_url();?>event/matches/status", 
                    success: function(result) {
                       
                    }
                });
                  
          });
        </script>
                <?php exit;?>
