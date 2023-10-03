    $( document ).ready(function() {

      $("body").on("keyup",".stadium_color",function(){
         var id  =  $(this).parents("tr").attr('data-id');
         var staduim_id  = $("#hiddenStadiumId").val();
         var category_id = $(this).parents("tr").find('.stadium_category_by_color').val();
         var color_code = $(this).val();
         $(this).parents("tr").find(".mapsvg-region-color").val(rgb2hex(color_code));
         $(this).parents("tr").find(".category_picker i").css("background",color_code);
         var old_category  = $(this).parents("tr").attr('data-category');

          $('.mapsvg-region-link option[value="'+category_id+'"]').attr("data-color", color_code);

         update_color_category(id,staduim_id,category_id,color_code,old_category);

          if(category_id){
               $(".cc-" + category_id ).find(".myjscolor").val(rgb2hex(color_code))
               $(".map-" + category_id ).css({fill: color_code});
           }
      });


   function call_color_text(){
      if($(".stadium_color").length  >0){
         $('.stadium_color').each(function(key,value) {
              var color_code =  $(this).val();
             // console.log(color_code);
              $(this).parents("tr").find(".mapsvg-region-color").val(rgb2hex(color_code))       ;                    });

          var elements = document.getElementsByClassName("pandi_color");
         for (var i = 0; i < elements.length; i++) {
             elements[i].addEventListener('input', call_color, false);
            // console.log(elements[i].value);
         }
      }
   }

   function call_color(event){   
       var input = event.target.value;
       var input_rgba = hexToRgbA2(event.target.value);
       $(this).parents("tr").find(".stadium_color").val(input_rgba);
         var staduim_id  = $("#hiddenStadiumId").val();
         var category = $(this).parents("tr").find('.stadium_category_by_color').val();;
         var color_name =input_rgba;
         var old_category  = $(this).parents("tr").attr('data-category');
         //  var color_name =  $(this).parents("tr").find('.stadium_color').val();
         var id  =  $(this).parents("tr").attr('data-id');
      // console.log(color_name);
         
         $("#default_category").attr('data-color',''  );

         $('.mapsvg-region-link option[value="'+category+'"]').attr("data-color", color_name);

         $(".cc-" + category ).find(".myjscolor").val(input);
         $(".map-" + category ).css({fill: color_name});

         $.ajax({
             type: "POST",
             url: base_url + '/stadium/stadium_color_category/update' ,
             data: { "stadium_id"  : staduim_id, "color_code": color_name, "category_id" : category ,'id' : id,'old_category' :  old_category},
             dataType: 'json',
           success: function(data){
               console.log(data.stadium_category);
                var option_s ="<option value=''>Select Category</option>";
                     if(data.stadium_category){
                        $.each(data.stadium_category, function(key,val) {
                            option_s += "<option data-color='"+val.color_code+"' data-name='"+val.seat_category+"' value='"+val.stadium_seat_id+"' >"+val.seat_category+"</option>"
                        });
                        $("#default_category").html(option_s);
                     }
                  //window.location.reload();
              }
         });
   }

   function update_color_category(id,staduim_id,category_id,color_code,old_category=""){
       $.ajax({
              type: "POST",
              url: base_url + '/stadium/stadium_color_category/update' ,
              data: { 
                  "stadium_id"  : staduim_id, 
                  "color_code": color_code, 
                  "category_id" : category_id ,
                  old_category : old_category,
                  "id" : id 
               },
              dataType: 'json',
              success: function(data){
                  console.log(data.stadium_category);
                  var option_s ="<option value=''>Select Category</option>";
                        if(data.stadium_category){
                           $.each(data.stadium_category, function(key,val) {
                               option_s += "<option data-color='"+val.color_code+"' data-name='"+val.seat_category+"' value='"+val.stadium_seat_id+"' >"+val.seat_category+"</option>";
                           });
                           $("#default_category").html(option_s);
                        }
                     //window.location.reload();
                 }
          });
   }
   
   if($("#color_category").length > 0){
      var stadium_id = $("#hiddenStadiumId").val();
       $.ajax({
                 type: "POST",
                 url: base_url + '/stadium/stadium_color_category/view' ,
               
                 data: { "stadium_id"  : stadium_id },
                 dataType: 'json',
                 success: function(data){
                 // console.log(data.html)

                     $("#color_category tbody").html(data.html);
                     call_color_text()
                    //location.reload(); 
                 }
             });
    }


      $("body").on("click",".save_category",function(){
       var category_id = $(".all_category").val();
       var stadium_id = $("#hiddenStadiumId").val();

       var category_text =  $(".all_category").find("option:selected").text();
      
      // alert(category_id);
       if(category_id){

         $.ajax({
              type: "POST",
              url: base_url + '/stadium/stadium_color_category/add' ,
            
              data: { "stadium_id"  : stadium_id, "category_id"  : category_id  },
              dataType: 'json',
              success: function(data){
                    $(".mapsvg-region-link").append($("<option></option>").attr("value",category_id).text(category_text).attr("data-color","rgba(0, 0, 0, 1)").attr("data-name",category_text));
                  //  console.log(data.html);
                     $("#color_category tbody").html(data.html);
                      var option_s ="<option value=''>Select Category</option>";
                     if(data.stadium_category){
                        $.each(data.stadium_category, function(key,val) {
                            option_s += "<option data-color='"+val.color_code+"' data-name='"+val.seat_category+"' value='"+val.stadium_seat_id+"' >"+val.seat_category+"</option>"
                        });
                        $("#default_category").html(option_s);
                        call_color_text()
                     }
                  $(".mapsvg-region-link").sort(function (option1, option2) {
                     return $(option1).text() < $(option2).text() ? -1 : 1;
                  });
                 $(".all_category").val("");
                 //location.reload(); 
              }
          });
       }
       else{
          swal('Failed !', "Please Choose Category", 'error');
       }

   });


 });