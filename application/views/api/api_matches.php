<?php $this->load->view('common/header');?>
<style type="text/css">
    .form-layout_new {
    max-width: 100%;
}
.table_data_payout table td:not([align]),.table_data_payout table th:not([align]) {
    text-align: center;
}
.table_data_payout .toptable tr {
    border-bottom: 1px solid #f1f1f1;
}
.table_data_payout .toptable tr th{font-weight: normal;}
tr.accordion{border-bottom: 1px solid #f1f1f1 !important;}
span.complete {
    background: #f2f2f2;
    font-weight: bold;
    color: #000;
    text-transform: uppercase;
    padding: 3px;
    font-size: 12px;
}
span.success {
    background: #fbbe10;
    font-weight: bold;
    color: #000;
    text-transform: uppercase;
    padding: 3px;
    font-size: 12px;
}
span.cancel {
    background: red;
    font-weight: bold;
    color: #000;
    text-transform: uppercase;
    padding: 3px;
    font-size: 12px;
}
span.confirm {
    background: yellow;
    font-weight: bold;
    color: #000;
    text-transform: uppercase;
    padding: 3px;
    font-size: 12px;
}
.upload_sec {
    padding: 30px 8%;
}
.table_data_payout {
    margin: 0px 0;
    border-bottom: 1px solid #ddd;
    padding: 30px 8%;
}
.choose_option {
    border-bottom: 1px solid #ddd;
    padding: 30px 8%;
}
.upload_sec .buttons {
    float: right;
}
.upload_sec .column.is-3.rit .field {
    float: right;
}
.table_data_payout h3 {
    font-size: 16px;
    margin: 0 0 10px 0px;
}
.upload_sec .buttons .button {
    margin-bottom: 0px;
    margin-top: 5px;
    padding: 10px 10px;
    margin-top: 25px;
    height: 32px;
}
.choose_option .choices[data-type*=select-one] .choices__inner {
    padding-bottom: 0px;
}
.choose_option .choices__inner{padding: 0px;}

.choose_option .control.has-icon .form-icon {
    right: 0 !important;
    height: 32px;
    left: unset;
}
.choose_option .control.has-icon .input {
    padding-left: 10px;
    height: 32px;
}
input[type=checkbox]:checked {
    background-color:#000;
    border-left-color:#06F;
    border-right-color:#06F;
}

.form-fieldset .form-control {
    height: 32px;
    border-radius: 0px;
}
.choices__inner{min-height: 32px;border-radius: 0px !important;}
.choose_option .button.h-button{min-height: 32px;height: 32px;margin-top: 6px;}
.choose_option .button.is-primary{background-color: #00a3ea;}
.table_data_payout .toptable tr th{text-transform: capitalize;text-align: left;}
.table_data_payout table td:not([align]), .table_data_payout table th:not([align]){text-align: left;}
.table_data_payout .toptable th, td{padding: 5px 0;}
.choices__list--single{padding: 0px 16px 0px 4px;}
.radio, .checkbox{padding: 0px;}

.upload_sec .input{height: 32px;}
.radio input+span, .checkbox input+span{width: 15px;height: 15px;}


@media only screen and (min-width: 650px) and (max-width: 768px) {
    .upload_sec .column.is-3.rit .field {float: none;}
    .upload_sec .buttons {float: none;}
    .upload_sec .buttons .button{margin-top: 5px;}
 }
 @media only screen and (min-width: 550px) and (max-width: 650px) {
    .upload_sec .column.is-3.rit .field {float: none;}
    .upload_sec .buttons {float: none;}
    .upload_sec .buttons .button{margin-top: 5px;}
 }

@media only screen and (min-width: 420px) and (max-width: 550px) {
    .upload_sec .column.is-3.rit .field {float: none;}
    .upload_sec .buttons {float: none;}
    .upload_sec .buttons .button{margin-top: 5px;}
 }
 @media only screen and (min-width: 320px) and (max-width: 420px) {
    .upload_sec .column.is-3.rit .field {float: none;}
    .upload_sec .buttons {float: none;}
    .upload_sec .buttons .button{margin-top: 5px;}
 }


</style>
        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
                <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                       
                        
                           
                              <!--Form Layout 1-->
                        <div class="form-layout form-layout_new">
                            <div class="form-outer">
                                <div class="form-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <div class="fieldset-heading">
                                            <h4>Partner Events Assign</h4>
                                            <p>Choose the following information</p>
                                        </div>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                              
                                                <!-- <button type="submit" id="branch-form-btn" class="button h-button is-primary is-raised">Confirm Payout</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-body has-loader">

                                      <!--Loader-->
                                            <div class="h-loader-wrapper">
                                                <div class="loader is-small is-loading"></div>
                                            </div>
                                  
                                    <!--Fieldset-->
                                    <div class="form-fieldset" style="max-width: 100%;padding: 0px;">
                                        <div class="choose_option">

                                    <form id="search-form" method="post" enctype='multipart/form-data' class="login-wrapper" action="<?php echo base_url();?>api/ajax_api_matches">

                                   
                                        <div class="columns is-multiline">


                                             <div class="column is-4">
                                        <div class="field">
                                            <label>Choose Tournaments *</label>
                                            <div class="control" id="sellers_div">
                                            <select class=" form-control"  name="tournament" id="tournament">
                                            <option value="">Select Tournament</option>
                                          <?php foreach($tournaments as $tournament){ ?>
                                            <option  value="<?php echo $tournament->t_id;?>"><?php echo $tournament->tournament_name;?></option>
                                            <?php } ?>
                                           
                                            </select>
                                                    </div>
                                        </div>
                                    </div>


                                     <div class="column is-4">
                                        <div class="field">
                                            <label>Choose Partner  *</label>
                                            <div class="control" id="sellers_div">
                                            <select class=" form-control" required id="partner_id" name="partner_id" id="">
                                            <option value="">-Choose Partner-</option>
                                            <?php foreach($partners as $partner){ ?>
                                            <option  value="<?php echo $partner->admin_id;?>"><?php echo $partner->admin_name;?></option>
                                            <?php } ?>
                                            </select>
                                                    </div>
                                        </div>
                                    </div>

                                     
                                     
                                        <div class="column is-2">

                                                <div class="">
                                                    <label>&nbsp;</label>
                                                    <div class="buttons">

                                                    <button id="search" type="submit" class="button h-button is-primary is-bold">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                  
                                            </form>
                                        </div>
                                    </div>
                                     <form id="match-form" method="post" enctype='multipart/form-data' class="" action="<?php echo base_url();?>api/api_matches_post">
                                        <input type="hidden" id="match_tournament_id" name="tournament_id" value="">
                                        <input type="hidden" id="match_partner_id" name="partner_id" value="">
                                        <div class="table_data_payout" id="match_list">
                                            <h3>0 Events Found <button type="submit" id="match-form-btn" class="button h-button is-primary is-raised" style="display: none;">Update Events</button> </h3>
                                            <table class="toptable res_table_new table-responsive">
                                                <tbody>
                                                    <tr class="accordion ui-accordion ui-widget ui-helper-reset">
                                                        <th style="width:150px">Select</th>
                                                        <th>Event Name</th>
                                                        <th>Event Date</th>
                                                        <th>Ticket Listed</th>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="upload_sec">
                                        <div class="columns is-multiline">
                                          
                                            <div class="column is-2">
                                                <div class="buttons">                                            
                                                <label>&nbsp;</label>
                                                <button type="submit" id="match-form-btn" class="button h-button is-primary is-raised" style="display: none;">Update Events</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                    </div>
                                    <!--Fieldset-->
                                    
                                </div>
                            </div>
                        </div>

                      
                    
                    </div>

                <?php $this->load->view('common/footer');?>
                <script type="text/javascript">
                        



                    $('#match-form').validate({

                          submitHandler: function(form) {
                            var tournament_id   = $("#match_tournament_id").val();
                            var partner_id   = $("#match_partner_id").val();
                            var data_from = { 'active' : [],'inactive' : [],'partner_id' : partner_id , "tournament_id" : tournament_id};
                        $('.input-check').each(function () {
                            var id = $(this).attr('data-id');
                            if ($(this).prop('checked')) {
                               data_from['active'].push(id);
                            }
                            else{
                                 data_from['inactive'].push(id);
                            }
                        });

                     console.log(data_from);
                        // return false;
                            var myform = $('#'+$(form).attr('id'))[0];
                            //is-loading no-click
                           // branch-form-btn

                            var formData = new FormData(myform);
                           
                            var action = $(form).attr('action');
                            $.ajax({
                              type: "POST",
                             // enctype: 'multipart/form-data',
                              url: action,
                              data : data_from  ,
                          
                              dataType: "json",

                              success: function(data) {
                                alert(data.msg);
                                $('#search').removeClass("is-loading no-click");

                                $('.has-loader').removeClass('has-loader-active');
                                window.location.reload();
                              }
                            })
                            return false;
                          }
                        });


                    $('#search-form').validate({

                          submitHandler: function(form) {
                            
                            var myform = $('#'+$(form).attr('id'))[0];
                            //is-loading no-click
                           // branch-form-btn
                          

                            var formData = new FormData(myform);


        

                           var tournament   = $("#tournament").val();
                            $('#search').addClass("is-loading no-click");

                            $('.has-loader').addClass('has-loader-active');

                            var tournament   = $("#tournament").val();
                            var page         = $("#page").val();

                             var dataString = $('#'+$(form).attr('id')).serialize();
                             console.log(dataString);
                            
                            var action = $(form).attr('action');
                            $.ajax({
                              type: "POST",
                             // enctype: 'multipart/form-data',
                              url: action,
                              data: formData,
                              processData: false,
                              contentType: false,
                              cache: false,
                              dataType: "json",

                              success: function(data) {

                                $('#search').removeClass("is-loading no-click");

                                $('.has-loader').removeClass('has-loader-active');

                             if(data.status == 1){
                                        $('#match_list').html(data.match_list);
                                    }
                                    $("#match-form-btn").show();
                              }
                            })
                            return false;
                          }
                        });

             
        $("#tournament").change(function(){
            $("#match_tournament_id").val($(this).val());
        });
         $("#partner_id").change(function(){
            $("#match_partner_id").val($(this).val());
        });



          $("body").on("click",".select_all",function(){
            $(".unselect_all").show();
            $(".select_all").hide();
              
                $('.input-check').prop('checked',true);
                      
                });

            $("body").on("click",".unselect_all",function(){
        
                $(".select_all").show();
                $(".unselect_all").hide();
                $('.input-check').prop('checked',false);
                      
                });
                    
                </script>
<?php exit;?>
