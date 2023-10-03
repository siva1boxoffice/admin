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

            .tab_class{
                background-color: #FFF;
                margin: 20px 0;
                padding: 10px;
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

                                <h3 align="center"><?php echo $stadiums_1->stadium_name ;?> - <?php echo $stadiums_1->s_id ;?> </h3>
                                <hr>
                                <p align="center"><img src="<?php echo $stadiums_1->stadium_image ;?>" width="500" height="500" style="height: 300px;"></p>


                            </div>
                             <div class="column is-6 list_add">

                                <h3 align="center"><?php echo $stadiums_2->stadium_name ;?> - <?php echo $stadiums_2->s_id ;?> </h3>
                                <hr>
                                <p align="center"><img src="<?php echo $stadiums_2->stadium_image ;?>" width="500" height="500" style="height: 300px;"></p>


                            </div>

                        </div>

            <div class="columns">

                            <div class="column is-12 list_add">

                                

                        <div class="field">
                              <div class="control">   


                                <form method="post">
                                    <input type="hidden" name="old_stadium_id" value="<?php echo $stadiums_1->s_id ;?>">
                                     <input type="hidden" name="new_stadium_id" value="<?php echo $stadiums_2->s_id ;?>">
                                <?php

                                foreach ($category_1 as $key => $value1) {
                                   ?>
                                <div class="col-12">    

                                    <div class="tab_class">
                                   <h2> <a href="">  <?php echo $value1->seat_category ; ?></a></h2>
                                  
                                    <?php 
                                
                                   $categories =  $this->General_Model->get_category_stadium($stadiums_1->s_id,$value1->category)->result();
                                   if($categories){
                                    foreach ($categories as $key => $value) {?>
                                        <div class="columns columns-main">    
                                            <div class="column is-3">    
                                                <?php
                                               echo  $value->block_id2."<br>";
                                               ?>
                                                 <input type="hidden" name="old_block_id[]" value="<?php echo $value->id ; ?>">
                                                 <input type="hidden" name="old_category_id[]" value="<?php echo $value1->category ; ?>">
                                           </div>
                                           <div class="column is-4">    
                                            <select class="form-control get_blokcs2 "  name="category[]">
                                    
                                                <option value="">Select Category</option>
                                                <?php

                                                foreach ($category_2 as $key => $value) {
                                                   ?>
                                                   <option value="<?php echo $value->category ; ?>"><?php echo $value->seat_category ; ?></option>
                                                   <?php 
                                                }
                                                ?>
                                                </select>
                                           </div>
                                            <div class="column is-4">    
                                                <select class="form-control  block_data"  name="block[]">
                                    
                                                <option value="">Select Block</option>
                                                
                                                </select>
                                           </div>
                                       </div>


                                       <?php 
                                    }
                                   }
                                    ?>
                                </div>
                                </div>
                                   <?php 
                                }
                                ?>
                               
                                <input type="submit" value="Submit" class="button h-button is-primary is-raised">

                            </div>
                        </form>
                        </div>
                         
                        </div>
                       
                 

                      
                        </div>
                    </div>

                </div>
            </div>
        </div>



                <?php $this->load->view('common/footer');?>
<script type="text/javascript">
    
    // $(".get_blokcs").on("change",function(){
    //     var stadium_id = "<?php echo $stadiums_1->s_id ;?>";
    //     get_blocks(stadium_id,this.value,1);
    // });

    $(".get_blokcs2").on("change",function(){
        var stadium_id = "<?php echo $stadiums_2->s_id ;?>";
        var category_id  = $(this).val();
        var that  = $(this);
        var action = "<?php echo base_url(); ?>event/category_block/"+stadium_id +"/"+category_id;
        $.ajax({
          type: "GET",
          url: action,

          success: function(data) {
            console.log("3333333333");
            $(that).parents(".columns-main").find(".block_data").html(data);
          }
        });

    });


    
</script>
                <?php exit;?>