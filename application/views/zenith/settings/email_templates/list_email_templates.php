<?php $tournments   = $this->General_Model->get_tournments()->result();?>

<?php $this->load->view(THEME.'common/header');?>

<style>

.seat_category_check_box{
   padding: 0 15px;
    margin-top: 15px;
    margin-bottom: 15px;

}
label.error{
   font-size: 12px !important;
   color: RED;
       transform: unset !important;
}
   
   </style>
        <!-- Begin main content -->
      <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="page-title dflex-between-center mb-2">
                     <h3 class="mb-1">Email Templates</h3>
                     <div class="add_new_btn">
                        <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light add_template "    data-effect="wave"   >
                            <i class="bx bx-plus bx-flashing"></i>
                            Add New
                         </a>
                      </div>
                     <!-- <ol class="breadcrumb mb-0 mt-1">
                        <li class="breadcrumb-item">
                           <a href="../index.html">
                              <i class="bx bx-home fs-xs"></i>
                           </a>
                        </li>
                        <li class="breadcrumb-item">
                           <a href="calender.html">
                              Tickets
                           </a>
                        </li>
                        <li class="breadcrumb-item active">Ticket approval</li>
                     </ol> -->
                  </div>
               </div>
            </div>
            <!-- page content -->
            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">
                  <div class="card">
                     <div class="card-body">

                      

                        <div class="table-responsive">
                           <table id="email-datatable" class="table table-bordered table-hover table-nowrap mb-0">
                              <thead class="thead-light">
                                 <tr>
                                    <th>S.No</th>
                                    <th>Template Key</th>
                                    <th>Subject</th>
                                    <th>CC Email</th>
                                    <th>&nbsp;</th>
                                 </tr>
                              </thead>
                              <tbody>
                                
                              </tbody>
                           </table>
                        </div>
                     </div>                 
                  </div>
               </div>
            </div>
         </div>
      </div>



     <div class="modal fade" id="centermodal_edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">Email Template</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
            <div class="edit_email">
              <form id="branch-form" method="post" class="validate_form_v1 login-wrapper" action="<?php echo base_url(); ?>settings/email_templates/save_email_templates">
                    <input type="hidden" name="id"  id="template_id" value="<?php echo $emails->id; ?>">
                   <div class="row mb-3">

                         <div class="col-lg-6">
                           <div class="form-group mb-0">
                                <label for="template_key">Email Type *</label>
                                  <input type="text" id="template_key" class="form-control" name="template_key"  placeholder="Please Enter Email Type" required value="<?php echo $emails->template_key; ?>"  >
                              
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group mb-0">
                                <label for="cc_email">CC Email *</label>
                                  <input type="text" name="cc_email" id="cc_email" class="form-control" placeholder="Please Enter CC Email" required value="<?php echo $emails->cc_email; ?>" >
                               
                        </div>
                    </div>
                </div>
                        <div class="row mb-3">
                            
                            <div class="col-lg-6">
                               <div class="form-group">
                                  <label for="subject_english">Email Subject English</label>
                                  <input type="text" name="subject_english"  id="subject_english" class="form-control" placeholder="Please Enter Email Subject English" required value="<?php echo $emails->subject_english; ?>" >
                               </div>
                            </div>

                            <div class="col-lg-6">
                               <div class="form-group">
                                  <label for="subject_arabic">Email Subject Arabic</label>
                                  <input type="text" name="subject_arabic" id="subject_arabic" class="form-control" placeholder="Please Enter Email Subject Arabic" required value="<?php echo $emails->subject_arabic; ?>" >
                               </div>
                            </div>

                    </div>
                    <div class="row ">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="sellers">Status</label>
                              <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input"  name="status" id="customSwitch28" value="1" <?php if ($emails->status == '1') { ?> checked <?php } ?> >
                                <label class="custom-control-label" for="customSwitch28">Enable / Disable Template Status </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                               <label for="example-textarea">Template Content English</label>
                               <textarea id="editor4"  name="message_english" required ><?php echo $emails->message_english; ?></textarea>
                             </div>
                        </div>

                        <div class="col-lg-12">
                           <div class="form-group">
                               <label for="example-textarea">Template Content Arabic</label>
                               <textarea id="editor5" name="message_arabic" required><?php echo $emails->message_arabic; ?></textarea>
                             </div>
                        </div>
                        <!-- <div class="col-lg-12">
                           <div class="form-group">
                               <label for="simpleinput">You can use mentioned shortcodes:</label>
                               <ul>
                                  <li><span>{customer_name} -</span>Customer Name</li>
                                  <li><span>{increment_id} -</span>Increment ID</li>
                                  <li><span>{product_name} -</span>Product Name Table*</li>
                                  <li><span>{product_url} -</span>Product Url Table*</li>
                                  <li><span>{loop_start} -</span>Loop Start</li>
                                  <li><span>{loop_end} -</span>Loop End</li>
                               </ul>
                               <p class="short_codes">*To use <span>{product_name}</span> and <span>{product_url}</span> you have to put them between <span>{loop_start}</span> and <span>{loop_end}</span>
e.g. <span>{loop_start}{product_name} - {product_url}{loop_end}</span></p>
                           </div>
                        </div>  -->
                      <!--   <div class="col-lg-12">
                           <div class="form-group">
                               <label for="simpleinput">Delay Emails</label>
                               <input type="text" id="simpleinput" class="form-control" placeholder="0">
                               <p>Define delay of email notification sent to a customer. Put value in days.</p>
                           </div>
                        </div>  -->
                       <!--  <div class="col-lg-12">
                           <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2">
                              <a href="#" data-toggle="modal" data-target="#add-board-modal" class="btn btn-primary mb-2"><i class="bx bx-list-ol bx-flashing mr-1"></i> Go Back</a> 
                                 <a href="#" data-toggle="modal" data-target="#add-general-task-modal" class="btn btn-success mb-2"><i class="bx bx-list-ol bx-flashing mr-1"></i>Save</a>
                           </div>
                        </div>  -->                    
                     </div>
            
               <div class="coupon_btn_save">
                <button type="button" data-dismiss="modal"  class="btn btn-cancel">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
                 </form>
            </div>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div>
</div>

               


        <?php $this->load->view(THEME.'common/footer');?>

          <script src="<?php echo base_url(); ?>assets/zenith_assets/libs/ckeditor4/ckeditor.js"></script>
  <script src="<?php echo base_url(); ?>assets/zenith_assets/libs/ckeditor/js/ckeditor.min.js"></script>


<script>
     $(document).ready(function () {

        $("body").on('click','.dropdown-menu-custom .check_box, .seat_category_check_box',function(e){
            //    alert('dd');
            e.stopPropagation();
        });

        var Dtable = $('#email-datatable').DataTable(
            {
                'info': false,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                "ajax": {
                    url: base_url + 'settings/get_ajax_email_template',
                    data: function (d) {

                    }
                },       
                "targets": 'no-sort',
                "bSort": false,
                 language: {
                    paginate: {
                       previous: "<i class='mdi mdi-chevron-left'>",
                       next: "<i class='mdi mdi-chevron-right'>"
                    },
                    loadingRecords: '&nbsp;',
                    processing: 'Loading...'
                 },
                 drawCallback: function () {
                    // $(".dataTables_paginate").addClass("page-link"),
                    // $(".dataTables_paginate  .paginate_button").addClass("page-link")
                    $(".dataTables_paginate > .pagination").addClass("flat-rounded-pagination "), $(".dataTables_filter").find("label").addClass("search-box d-inline-flex position-relative"), $(".dataTables_filter").find(".form-control").attr("placeholder", "Search...")
                 },
                'columns': [
                    { data: 's_no' },
                    { data: 'template_key' },
                    { data: 'subject_english' },
                    { data: 'cc_email' },           
                    { data: 'action' },    
                ]
            });   

             $("body").on("click",".add_template",function(){

                    if (CKEDITOR.instances.editor4) {
                         CKEDITOR.instances.editor4.destroy();
                    }

                    if (CKEDITOR.instances.editor5) {
                         CKEDITOR.instances.editor5.destroy();
                    }


                $('#branch-form input').val("");
                 $('#branch-form textarea').val("");


                  event.preventDefault();
                   jQuery.noConflict();

            !function(e){CKEDITOR.replace("editor4"),CKEDITOR.replace("editor5")}(jQuery);

                $("#centermodal_edit").modal('show');

            });

          $("body").on("click",".edit_id",function(){
            var id  = $(this).data('id');
              $.ajax({
               url: base_url + 'settings/email_templates/get_email_template_id/' + id,
              type: "GET",// Pass the search text to the PHP script
              success: function(response) {
                
                data=jQuery.parseJSON(response);
                    if (CKEDITOR.instances.editor4) {
                     CKEDITOR.instances.editor4.destroy();
                }

                if (CKEDITOR.instances.editor5) {
                     CKEDITOR.instances.editor5.destroy();
                }
                // console.log(data);
                     $("#branch-form #template_id").val(data.id);
                   $("#branch-form #template_key").val(data.template_key);
                    $("#branch-form #cc_email").val(data.cc_email);
                    $("#branch-form #subject_english").val(data.subject_english);
                     $("#branch-form #subject_arabic").val(data.subject_arabic);
                    if(data.status =="1" ){
                       $("#branch-form #customSwitch28").prop('checked',true);
                    }
                   
                    $("#branch-form #editor4").val(data.message_english);
                    $("#branch-form #editor5").val(data.message_arabic);
                    
                   event.preventDefault();
                   jQuery.noConflict();
                   !function(e){CKEDITOR.replace("editor4"),CKEDITOR.replace("editor5")}(jQuery);
                   $("#centermodal_edit").modal('show');

              }
            });
        });

    });


          
</script>