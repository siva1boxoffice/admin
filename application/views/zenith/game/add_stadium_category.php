<?php $this->load->view(THEME.'common/header'); ?>
        <style type="text/css">
            .myjscolor, .pandi_color {
    padding: 0;
    margin: 0;
    border: none;
    box-shadow: unset;
    background: none;
    width: 30px !important;
    height: 33px !important;
}
.pandi{
        position: absolute;
    right: 2px;
    top: 3px;
}
        </style>
     <div class="main-content">
         <!-- content -->
         <div class="page-content">
            <!-- page header -->
            <div class="page-title-box">
               <div class="container-fluid">
                  <div class="row align-items-center">
                     <div class="col-sm-12 col-xl-12">
                        <div class="page-title">
                           <h3 class="mb-1 font-weight-bold">Seat Category</h3>
                        </div>
                     </div>
                    
                  </div>
               </div>
            </div>
            <!-- page content -->

            <div class="page-content-wrapper mt--45">
               <div class="container-fluid">

            
                    <div class="card">
                     <div class="card-body">
                         <div class="col-sm-12 col-xl-12  mt-2 mt-sm-0">
                        <div class="">
                          <h5 class="card-title">Seat Category Info</h5>
                          <p>Fill the following category information</p>
                        </div>

                      <form id="category-form" method="post" class="login-wrapper form_req_validation <?php echo $category_details->id ? "validate_form_edit" : "validate_form_v2" ;?>" action="<?php echo base_url(); ?>game/stadium_category/save">


                        <input type="hidden" name="category_id" value="<?php if (isset($category_details->id)) {
            echo $category_details->id;
        } ?>">
                         <div class="row column_modified">
                            <div class="col-lg-3">
                                  <div class="form-group">
                                   <label for="seat_position">Seat Position</label>
                                   <input type="text" name="seat_position" id="seat_position" class="form-control" placeholder="Enter Seat Position" value="<?php echo $category_details->seat;?>" required>
                                  </div>
                            </div>

                                         
                  

                            <div class="col-lg-3">

                              


                              

                                  <div class="form-group">
                                   <label for="seat_position">Color Code</label>
                                      <div class="input-group">
                                     <input type="text" name="category_color" class="category_color  form-control" id="category_color" value="<?php echo $category_details->category_color ? $category_details->category_color : ""; ?>">
                                      <div class="input-group-append pandi">
                                       <input type="color" name="category_color_input" id="category_color_input" class=" pandi_color " placeholder="Enter Color Code" value="" required>
                                      </div>
                                </div>
                                  </div>
                            </div>


                            <div class="col-lg-3">
                                 <div class="form-group">
                                   <label for="event">For event</label>

                                <select class="custom-select " id="event" name="event" required >
                                       <option value="match" <?php if (isset($category_details->event_type)) {
                                        if ($category_details->event_type == 'match') {
                                            echo "selected";
                                        }
                                                    } ?>>Match</option>
                                    <option value="other" <?php if (isset($category_details->event_type)) {
                                if ($category_details->event_type == 'other') {
                                    echo "selected";
                                    }
                                } ?>>Other</option>
                                        
                                    </select> 
                                </div>
                               </div>

                               <div class="col-lg-3">
                                <div class="form-group">
                                   <label for="sellers">Status *</label>
                                   <div class="custom-control custom-switch">
                                     <input type="checkbox" class="custom-control-input" id="customSwitch18"  value="1" <?php if($category_details->status == '1' ||$category_details->id == "" ){?> checked <?php } ?> name="is_status">
                                     <label class="custom-control-label" for="customSwitch18">In Active / Active</label>
                                   </div>
                                </div>
                             </div>

                             <div class="col-lg-12">
                                <div class="float-sm-right mt-2 mt-sm-0 ml-sm-1 mx-sm-2 tick_details">

                                     <a href="<?php echo base_url('game/stadium_category');?>" class="btn btn-primary mb-2 mt-3">Back</a>

                                     <button type="submit" id="branch-form-btn" class="btn btn-success  mt-2  submit_match button h-button is-primary is-raised">Save</button>
                                </div>
                             </div>
                           </div>
                       </form>
                     </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

<?php $this->load->view(THEME.'common/footer'); ?>

<script type="text/javascript">

    $("body").on("keyup","#category_color",function(){
        var a = $(this).val();
        $(".pandi_color").val(rgb2hex(a));
    });


    var elements = document.getElementsByClassName("pandi_color");
     for (var i = 0; i < elements.length; i++) {
         elements[i].addEventListener('input', call_color, false);
        // console.log(elements[i].value);
     }


    function call_color(event){   
       var input = event.target.value;
       var input_rgba = hexToRgbA2(event.target.value);
               console.log(input_rgba);
        $("#category_color").val(input_rgba);
   }
   if($("#category_color").val().length > 0){
        var cc = $("#category_color").val();
        $(".pandi_color").val(rgb2hex(cc))
   }


   function rgb2hex(orig) {
      var rgb = orig.replace(/\s/g, '').match(/^rgba?\((\d+),(\d+),(\d+)/i);
      return (rgb && rgb.length === 4) ? "#" +
              ("0" + parseInt(rgb[1], 10).toString(16)).slice(-2) +
              ("0" + parseInt(rgb[2], 10).toString(16)).slice(-2) +
              ("0" + parseInt(rgb[3], 10).toString(16)).slice(-2) : orig;
  }


   function hexToRgbA2(hex) {
   var c;
   if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)) {
       c = hex.substring(1).split('');
       if (c.length == 3) {
           c = [c[0], c[0], c[1], c[1], c[2], c[2]];
       }
       c = '0x' + c.join('');
       return 'rgba(' + [(c >> 16) & 255, (c >> 8) & 255, c & 255].join(',') + ',1)';
   }
   throw new Error('Bad Hex');
   }

</script>
