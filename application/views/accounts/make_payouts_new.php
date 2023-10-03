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
                       
                         <div class="dashboard-title is-main">
                                <div class="left">
                                    <h2 class="dark-inverted">New Payout</h2>
                                </div>
                            </div>
                           
                              <!--Form Layout 1-->
                        <div class="form-layout form-layout_new">
                            <div class="form-outer">
                                <div class="form-header">
                                    <div class="form-header-inner">
                                        <div class="left">
                                            <div class="fieldset-heading">
                                            <h4>Payout Info</h4>
                                            <p>Fill the following Seller and Order information</p>
                                        </div>
                                        </div>
                                        <div class="right">
                                            <div class="buttons">
                                                <a href="<?php echo base_url();?>accounts/payouts" class="button h-button is-light is-dark-outlined">
                                                    <span class="icon">
                                                      <i class="lnir lnir-arrow-left rem-100"></i>
                                                  </span>
                                                    <span>Go to Payout</span>
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

                                    <form id="search-form" method="post" enctype='multipart/form-data' class="login-wrapper" action="<?php echo base_url();?>accounts/get_payout_data">

                                        <div class="columns is-multiline">

                                      <div class="column is-3">
                                        <div class="field">
                                            <label>Choose Sellers *</label>
                                            <div class="control" id="sellers_div">
                                            <select class="actionpayout roleuser form-control" required name="seller" id="seller">
                                            <option value="">-Choose Sellers-</option>
                                            <?php foreach($sellers as $seller){ ?>
                                            <option <?php if (in_array($seller->admin_id, explode(',',$match_settings->sellers)))
                                            { ?> selected <?php } ?> value="<?php echo $seller->admin_id;?>"><?php echo $seller->admin_name;?> <?php echo $seller->admin_last_name;?> (<?php echo $seller->company_name;?>)</option>
                                            <?php } ?>
                                            </select>
                                                    </div>
                                        </div>
                                    </div>
                                        <div class="column is-3">
                                        <div class="field">
                                        <label>Currency *</label>
                                        <div class="control">
                                        <select class="form-control" id="currency" name="currency">
                                        <option value="">-Choose Currency-</option>
                                        <option value="GBP">GBP</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        </select>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="columns is-multiline">
                                            <div class="column is-3">
                                                <div class="field">
                                                    <label>Event From *</label>
                                                    <div class="control has-icon">
                                                       <input name="event_from" id="pickaday-datepicker-one" class="input actionpayout" type="text" placeholder="dd/mm/yyy" required  value="">
                                                       <div class="form-icon">
                                                          <i class="fas fa-calendar-alt"></i>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="column is-3">
                                                <div class="field">
                                                    <label>Event To *</label>
                                                    <div class="control has-icon">
                                                        <input name="event_to" id="pickaday-datepicker-two" class="input actionpayout" type="text" placeholder="dd/mm/yyy" required  value="">
                                                        <div class="form-icon">
                                                          <i class="fas fa-calendar-alt"></i>
                                                      </div>
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
                                     <form id="payout-form" method="post" enctype='multipart/form-data' class="validate_form_payout login-wrapper" action="<?php echo base_url();?>accounts/save_payout_v1">
                                        <div class="table_data_payout" id="payout_orders">
                                            <h3>0 Orders Found</h3>
                                            <table class="toptable res_table_new table-responsive">
                                                <tbody>
                                                    <tr class="accordion ui-accordion ui-widget ui-helper-reset">
                                                        <th>Select</th>
                                                        <th>Order ID</th>
                                                        <th>Event Name</th>
                                                        <th>Buyer</th>
                                                        <th>Ticket Type</th>
                                                        <th>Tickets</th>
                                                        <th>Total Ticket(s) Price</th>
                                                        <th>Order Status</th>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="upload_sec">
                                        <div class="columns is-multiline">
                                            <div class="column is-4">
                                                <div class="field">
                                                <label>Upload Payout Or Bank Deposit Receipt *</label>
                                                <div class="control has-icon">
                                                    <div class="file has-name is-fullwidth">
                                                        <label class="file-label">
                                                            <input class="file-input" type="file" id="payout_receipt" name="payout_receipt" onchange="loadFile_receipt(event)">
                                                            <span class="file-cta">
                                                                <span class="file-icon">
                                                                    <i class="lnil lnil-lg lnil-cloud-upload"></i>
                                                                </span>
                                                                <span class="file-label">
                                                                    Choose a file…
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <a id="preview" style="text-decoration: underline;display: none;" href="" target="_blank">preview payment receipt</a>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="column is-3">
                                                <div class="field">
                                                    <label>Payment Reference *</label>
                                            <div class="control">
                                                <input type="text" name="payment_reference" class="input" placeholder="Reference #" required>
                                            </div>
                                        </div>
                                            </div>
                                            <div class="column is-3 rit">
                                                <div class="field">
                                                    <label>Total Payable *</label>
                                                    <div class="control" id="afiliates_div">
                                                     <span id="payable_amount">0.00</span>
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="column is-2">
                                                <div class="buttons">                                            
                                                <label>&nbsp;</label>
                                                <button type="submit" id="payout-form-btn" class="button h-button is-primary is-raised">Confirm Payout</button>
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





                    $('#search-form').validate({

  submitHandler: function(form) {
    
    var myform = $('#'+$(form).attr('id'))[0];
    //is-loading no-click
   // branch-form-btn
    var formData = new FormData(myform);
    var d1= $("#pickaday-datepicker-one").val();
    var d2= $("#pickaday-datepicker-two").val();
   /*  formData.append('payout_date_from',d1);
     formData.append('payout_date_to', d2);console.log(formData);*/
    $('#search').addClass("is-loading no-click");

    $('.has-loader').addClass('has-loader-active');
    
    var action = $(form).attr('action');
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
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
                            $('#payout_orders').html(data.response.list_orders);
                            $('#payable_amount').text(data.response.base_currency+' '+ data.response.payable_amount);
                        }
      }
    })
    return false;
  }
});

             
    
$('body').on('click', '.payable_order', function() {
    var payable_orders = [];
    $('.payable_order').each(function(index, value) {
        if($(this).is(':checked'))
        {
            payable_orders.push($(this).val());
        }
    });

    if (payable_orders.length >= 1){

    var action = "<?php echo base_url();?>accounts/calculate_payable_orders";
    $.ajax({
      type: "POST",
      url: action,
      data: {'payable_orders' : payable_orders},
      cache: false,
      dataType: "json",

      success: function(data) {
        if(data.status == 1){
        $('#payable_amount').text(data.response.base_currency+' '+ data.response.payable_amount);
        }
        else{
            alert(data.response);
        }

      }
    })

    }
})


})


                    
                </script>
<?php exit;?>
