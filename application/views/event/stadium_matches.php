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
  <table class="toptable res_table_new table-responsive">
   <tbody>
      <tr class="accordion ui-accordion ui-widget ui-helper-reset">
         <th>Match Name</th>
         <th>Stadium</th>
         <th>Home Team</th>
         <th>Match Date</th>
         <th>Tournament</th>
         <th>Stadium</th>
         <th>&nbsp;</th>
      </tr>
      <?php foreach($matches as $match){ ?>
      <tr>
         <td data-label="Match Name"> <span class="item-name dark-inverted" data-filter-match=""><?php echo $match->match_name;?></span> </td>
         <td data-label="Home Team"><span class="light-text" data-filter-match=""><?php echo $match->stadium_name;?></span> </td>
         <td data-label="Home Team"><span class="light-text" data-filter-match=""><?php echo $match->team_name;?></span> </td>
         <td data-label="Match Date"><span class="light-text" data-filter-match=""><?php echo date('d F Y H:i',strtotime($match->match_date)); ?></span> </td>
         <td data-label="Tournament"> <span class="light-text" data-filter-match=""><?= $match->tournament_name; ?></span></td>
        <td data-label="Stadium:">
        <select name="stadium" id="stadium_<?php echo $match->m_id;?>" class="form-control" >
        <?php foreach($stadiums as $stadium){?>
        <option value="<?php echo $stadium->s_id;?>" <?php if($stadium->s_id == $match->venue){?> selected <?php } ?> ><?php echo $stadium->stadium_name;?> <?php echo $stadium->variant_name;?> <?php echo $stadium->s_id;?></option>
    <?php } ?>
        </select>

        </td>
        <td data-label="Update Stadium:">
        <a class="button is-success" href="javascript:void(0);" onclick="update_stadium_data('<?php echo $match->m_id;?>','<?php echo $match->venue;?>');">
        Update Stadium
        </a>
        </td>
       
      </tr>
  <?php } ?>
  
   </tbody>
</table>
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
          //setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
        }else if(data.status == 0) {
           notyf.error(data.msg, "Failed", "Oops!", {
          timeOut: "1800"
          });
          //setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
          
        }
      }
    })
    }

   }
    
</script>
                <?php exit;?>