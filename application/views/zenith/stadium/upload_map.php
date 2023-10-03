 <?php  $this->load->view(THEME.'common/header'); 



?>
<div id="overlay" style="display: none;">
   <div id="loader">
      <!-- Add your loading spinner HTML or image here -->
      <img src="<?php echo base_url(); ?>assets/zenith_assets/img/loading.gif" alt="loader">
   </div>
</div>
<style type="text/css">
   /*.selbox{
   padding: 0;
   background:none;
   border: 0;
   margin: 0;
   line-height: unset;
   height: auto;
   -webkit-appearance: none;
   -moz-appearance: none;
   }*/
   .ds-none{  display:none !important; }
   #overlay {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background-color: rgba(0, 0, 0, 0.5);
   z-index: 9999;
   }
   .colorpicker-element .input-group-addon i, .colorpicker-element .add-on i{
   width: 25px !important;
   height: 25px !important;
   }
   .mapsvg-region-link{
    
   }

   .block_color{ height:25px ;width : 25px}
</style>
<!-- Begin main content -->
<div class="main-content">
<!-- content -->
<div class="page-content">
<!-- page header -->
<div class="page-title-box tick_details">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-8">
            <h5 class="card-title"><?php   echo $getStadium->stadium_name;?> </h5>
         </div>
         <!--   <div class="col-sm-4">
            <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
               <a href="#" data-toggle="modal" data-target="#add-board-modal" class="btn btn-primary mb-2">BACK</a>
                  <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2 ml-2">SAVE</a>
            </div>
            </div> -->
      </div>
   </div>
</div>
<!-- page content -->
<div class="page-content-wrapper mt--45 box-details">
   <div class="container-fluid">
      <div class="card">
         <div class="card-body">
            <div class="row">
               <div class="col-lg-12" >
                <div class="">
                          <h5 class="card-title">Choose the Stadium  </h5>
                          <p>Please Upload Stadium Image</p>
                        </div>
                  <ul class="nav nav-tabs nav-bordered" id="myTab" style="display:none">
                     <li class="nav-item active"><a class="active" href="#tab_settings">Choose the Stadium Image</a></li>
                     <!--   <li><a href="#tab_colors">Colors</a></li> -->
                    
                  </ul>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-3"></div>
                <div class="col-lg-6 mt-5">   

                        <form method="post" action="<?php echo base_url('stadium/upload_stadium');?>"  id="upload_stadium" enctype="multipart/form-data">
                           <div class="form-group">
                              <label>Upload Map</label> 
                              <input name="photo"  type="file" accept="image/svg+xml" class="custom-file-input" id="photo" onchange="form.submit()">
                                  <label class="custom-file-label" for="photo"  >
                           </div>
                        </form>
                           
               </div>


            </div>
         </div>
      </div>
   </div>
</div>
<?php $this->load->view(THEME.'common/footer'); ?>
<script type="text/javascript">
   $('#photo').change(function() {
  $('#upload_stadium').submit();
});
</script>

<?php exit;?>