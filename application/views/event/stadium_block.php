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

            .color_bg{
                padding: 20px;
            }
        </style>
        <!-- Content Wrapper -->
        <div id="app-project" class="view-wrapper is-webapp" data-page-title="Flex Lists" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="page-content is-relative tabs-wrapper is-slider is-squared is-inverted">

                    <div class="list-flex-toolbar is-reversed flex-list-v2">

                         <div class="control has-icon">
						 <form method='post' action="<?= base_url() ?>/event/stadium_matches/<?php echo $stadium_id;?>">
        						<input type='text' class="input serchText" name='search' value='<?= $search ?>' placeholder="Search...">
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
                       
                    </div>

                    <div class="page-content-inner">


                        <div class="tab_sec orders list_odd" id="no-more-tables">
            <div class="columns">

                            <div class="column is-6 list_add">

                                <h3><?php echo $stadiums_1->stadium_name ;?> - <?php echo $stadiums_1->s_id ;?> </h3>

                                <img src="<?php echo $stadiums_1->stadium_image ;?>" width="500" height="500" style="height: 500px;">
                                <table class="table">
                                <?php

                                foreach ($blocks_1 as $key => $value) {
                                   ?>
                                   <tr>
                                    <td><?php echo $value->block_id;?></td>
                                     <td><?php echo $value->block_id2;?></td>
                                    <td><?php echo $value->seat_category;?></td>
                                    <td><?php echo $value->block_color;?></td>
                                    <td><div class="color_bg" style="background : <?php echo $value->block_color;?>"></div></td>
                                   </tr>
                                   <?php 
                                }
                                ?>
                            </table>
                        </div>
                         <div class="column is-6 list_add">
                            <h3><?php echo $stadiums_2->stadium_name ;?>  - <?php echo $stadiums_2->s_id ;?></h3>
                             <img src="<?php echo $stadiums_2->stadium_image ;?>" width="500" height="500"  style="height: 500px;">
                             <table class="table">
                                <?php

                                foreach ($blocks_2 as $key => $value) {
                                   ?>
                                   <tr>
                                    <td><?php echo $value->block_id;?></td>
                                    <td><?php echo $value->block_id2;?></td>
                                    <td><?php echo $value->seat_category;?></td>
                                    <td><?php echo $value->block_color;?></td>
                                    <td><div class="color_bg" style="background : <?php echo $value->block_color;?>"></div></td>
                                   </tr>
                                   <?php 
                                }
                                ?>
                            </table>
                            </div>

                            <div class="col-6">
                            </div>
                        </div>

                      
                        </div>
                    </div>

                </div>
            </div>
        </div>



                <?php $this->load->view('common/footer');?>
<script type="text/javascript">
  
   function update_stadium_data(m_id,venu){
    if(m_id != ""){
        var stadium = $("#stadium_"+m_id).val();
        var action = "<?php echo base_url(); ?>event/update_stadium_data/"+m_id;
    $.ajax({
      type: "POST",
      url: action,
      data: {'stadium' : stadium,"venu" : venu},
      dataType: "json",
      success: function(data) {
        if(data.status == 1) {

          notyf.success(data.msg, "Success", {
          timeOut: "1800"
          });
          setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
        }else if(data.status == 0) {
           notyf.error(data.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
          
        }
      }
    })
    }

   }
    
</script>
                <?php exit;?>