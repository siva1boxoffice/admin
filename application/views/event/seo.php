  <?php  $tournments   = $this->General_Model->get_tournments()->result();
//echo "<pre>";print_r($tournments);
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

                       
                        &nbsp;
                         <div class="control has-icon">
						 <form method='post' action="<?= base_url() ?>/event/matches/<?php echo $status_flag;?>">
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
         <th>Title</th>
         <th>Description</th>
         <th>Status</th>
         <th>View</th>
         <th>Lasted Updated</th>
      </tr>
      <?php  foreach($matches as $match){ ?>
      <tr>
         <td data-label="Match Name"> <span class="item-name dark-inverted" data-filter-match=""><?php echo $match->match_name;?></span> </td>
         <td data-label="Title"><span class="light-text" data-filter-match=""><?php echo $match->meta_title;?></span> </td>
         <td data-label="Match Description"><span class="light-text" data-filter-match=""><?php echo $match->meta_description;?></span> </td>
     

         <td data-label="SEO Status"> <?php if ($match->seo_status == 1) { ?>

                  <span class="tag is-success is-rounded"><i aria-hidden="true" class="fas fa-check"></i></span>
                <?php } else if ($match->seo_status != 1) { ?>
                  <span class="tag is-warning is-rounded"><i aria-hidden="true" class="fas fa-times "></i></span>
                <?php } ?></td>
         <td data-label="Seo Preview"><a target="_blank" href="<?php echo FRONT_END_URL; ?>/<?php echo $this->session->userdata('language_code');?>/<?php echo $match->slug; ?>" class="dropdown-item is-media"><i class='fa fa-eye'></i></a></td>
         <td data-label="Actions">
            <?php $create_date =   date("d M Y",$match->create_date) ;?>
            <?php echo date("d F Y",strtotime(time_zone_calc(@$_COOKIE["client_time_zone"],$create_date))).' '.@$_COOKIE["time_zone"];?>
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
    
</script>
                <?php exit;?>