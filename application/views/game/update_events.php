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
 }z


</style>
        <!-- Content Wrapper -->
        <div id="app-onboarding" class="view-wrapper is-webapp" data-page-title="Welcome" data-naver-offset="214" data-menu-item="#layouts-navbar-menu" data-mobile-item="#home-sidebar-menu-mobile">

            <div class="page-content-wrapper">
      <div class="page-content is-relative business-dashboard course-dashboard">

                   
                     <div class="page-content-inner">
                       
                         <div class="dashboard-title is-main">
                                <div class="left">
                                    <h2 class="dark-inverted">Pull Events & Tickets From Tixstock</h2>
                                </div>
                            </div>
                           
                              <!--Form Layout 1-->
                        <div class="form-layout form-layout_new">
                            <div class="form-outer">
                                <div class="form-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <div class="fieldset-heading">
                                            <h4>Events Info</h4>
                                            <p>Choose the following information</p>
                                        </div>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url();?>event/matches/upcoming?only=tixstock" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Events</span>
                                                </a>
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

                                    <form id="search-form" method="post" enctype='multipart/form-data' class="login-wrapper" action="<?php echo base_url();?>tixstock/updateFeedsEvents/true">

                                   
                                        <div class="columns is-multiline">
                                     <div class="column is-3">
                                        <div class="field">
                                            <label>Choose Parent Category *</label>
                                            <div class="control" id="sellers_div">
                                            <select class="actionpayout roleuser form-control" required name="parent_category" id="parent_category">
                                            <option value="">-Choose Parent Category-</option>
                                            <?php foreach($categories as $category){ ?>
                                            <option  value="<?php echo $category->category_id;?>"><?php echo $category->category;?></option>
                                            <?php } ?>
                                            </select>
                                                    </div>
                                        </div>
                                    </div>

                                    <div class="column is-3">
                                        <div class="field">
                                            <label>Choose Category *</label>
                                            <div class="control" id="category_div">
                                            <select class="actionpayout roleuser form-control"  name="category" id="category">
                                            <option value="">-Choose Category-</option>
                                            </select>
                                                    </div>
                                        </div>
                                    </div>

                                      <div class="column is-3">
                                        <div class="field">
                                            <label>Choose Tournaments *</label>
                                            <div class="control" id="sellers_div">
                                            <select class="actionpayout roleuser form-control"  name="tournament" id="tournament">
                                            <option value="">-Choose Tournament-</option>
                                           
                                            </select>
                                                    </div>
                                        </div>
                                    </div>
                                     <div class="column is-2">
                                        <div class="field">
                                            <label>Page Number *</label>
                                            <div class="control" id="sellers_div">
                                            <input type="text" class="form-control" required name="page" id="page" required value="1">
                                                    </div>
                                        </div>
                                    </div>
                                        <div class="column is-1">

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
                                     <form id="payout-form" method="post" enctype='multipart/form-data' class="login-wrapper" action="<?php echo base_url();?>tixstock/updateFeedsTickets/true">
                                        <div class="table_data_payout" id="payout_orders">
                                            <h3>0 Events Found</h3>
                                            <table class="toptable res_table_new table-responsive">
                                                <tbody>
                                                    <tr class="accordion ui-accordion ui-widget ui-helper-reset">
                                                        <th>Select</th>
                                                        <th>Event Name</th>
                                                        <th>Event Date</th>
                                                        <th>Tournament Name</th>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="upload_sec">
                                        <div class="columns is-multiline">
                                          
                                            <div class="column is-2">
                                                <div class="buttons">                                            
                                                <label>&nbsp;</label>
                                                <button type="submit" id="payout-form-btn" class="button h-button is-primary is-raised">Update Events</button>
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
                     var loadFile_receipt = function(event) {
                   
                     document.getElementById('preview').style.display = 'block';
                    var output = document.getElementById('preview');
                    output.href = URL.createObjectURL(event.target.files[0]);
                    output.onload = function() {
                    URL.revokeObjectURL(output.href) // free memory
                    }
                    };

                    $(document).ready(function(){

                   

                        if ($('#sellers').length) new Choices('#sellers', { removeItemButton: !0 });
                      
                      
                      new Pikaday({ field: document.getElementById("pickaday-datepicker-one"), format: "D MMM YYYY", onSelect: function () {$('.actionpayout').trigger('change');} });
                      new Pikaday({ field: document.getElementById("pickaday-datepicker-two"), format: "D MMM YYYY", onSelect: function () {$('.actionpayout').trigger('change');} });




    $('#payout-form').validate({

  submitHandler: function(form) {
    
    var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
  

    var formData = new FormData(myform);


    $('#search').addClass("is-loading no-click");

    $('.has-loader').addClass('has-loader-active');

    var tournament   = $("#tournament").val();
    var page         = $("#page").val();
   formData.append("tournament",tournament);
   formData.append("page",page);

    
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
                            $('#payout_orders').html(data.matches);
                        }
      }
    })
    return false;
  }
});

             
$('body').on('change', '#parent_category', function() {
    var parent_category_id = $(this).val();
     var action = "<?php echo base_url();?>game/get_tixstock_category";
    $.ajax({
      type: "POST",
      url: action,
      data: {'parent_category_id' : parent_category_id},
      cache: false,
      dataType: "json",

      success: function(data) {
        if(data.status == 1){
              $("#category").html('<option value="">-Choose Category-</option>');
             $.each(data.categories,function(key, value)
                {
                   
                    $("#category").append('<option value=' + value.category_id + '>' + value.category + '</option>');
                });

        }
      }
    })

});


$('body').on('change', '#category', function() {
    var parent_category_id = $(this).val();
     var action = "<?php echo base_url();?>game/get_tixstock_category";
    $.ajax({
      type: "POST",
      url: action,
      data: {'parent_category_id' : parent_category_id},
      cache: false,
      dataType: "json",

      success: function(data) {
        if(data.status == 1){
              $("#tournament").html('<option value="">-Choose Tournaments -</option>');
             $.each(data.categories,function(key, value)
                {
                 
                    $("#tournament").append("<option value='" + value.category + "'>" + value.category + "</option>");
                });

        }
      }
    })

});


// ajax call to show based on seller or api partner

$("input[name='sellerTypes']").click(function(){

    let partnerType = $(this).val();
    let action = "<?php echo base_url();?>accounts/partnerType";
    // alert(partnerType)
    $.ajax({
      type: "POST",
      url: action,
      data: {'partnerType' : partnerType},
      cache: false,
      dataType: "json",

      success: function(response) {
        var len = response.length;
        console.log(response)
        for( var i = 0; i<len; i++){
            var id = response[i]['admin_id'];
            var name = response[i]['company_name']
            $("#seller").empty()
        // alert(response[i]['admin_id'])
        $("#seller").append("<option value='"+id+"'>"+name+"</option>");

        }

      }
    })
});


})


                    
                </script>
<?php exit;?>
