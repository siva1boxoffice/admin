setTimeout(function () {
   // BLOCK LIST ON TABLE ( EDIT MAP TAB)
   var blocks_list = {};
     $('[data-section]').each(function(e,val){
       // console.log("map-stadium");
      $(this).find(".block").css("stroke","#CCC");
          var seatMatch = $(this).attr("data-section");
          if(seatMatch){
            var block_id  = split_block(seatMatch) ;
            var new_caregory = seatMatch.split("_");
            var main_explode = seatMatch.replaceAll("-", "_").toLowerCase();
            // console.log(new_caregory);
            //  var main_block_category = "";

            var  category_name = new_caregory[0].replaceAll("-", " ");
            var main_block_category  = toTitleCase(category_name) +" - "+  new_caregory[1];
            var data_section = $(this).parents("g").attr("data-category");
            var new_json =  { 'id' : block_id  , 'category' : data_section, "main_category" : seatMatch, main_block_category : main_block_category,main_explode : main_explode  }
            blocks_list[seatMatch] =  new_json;
            //  console.log(seatMatch);
          }
    
    });
   var output =  { "regions"  : blocks_list } 
   var template  = Handlebars.compile($("#entry-template").html());
   var filled =  template(output);
   $("#blocks_data tbody").html(filled);

   // console.log(stadium_active);
      $.each(stadium_active, function(i, item) {
         $('[data-section="'+item.block_name+'"] .block').css("fill" , rgb2hex(item.block_color ));
           $('input[name="regions[' + item.block_name + '][fill]"]').val( rgb2hex(item.block_color));
           $('select[name="regions[' + item.block_name + '][href]"]').val(item.category);
      });

   }, 100);

   function split_block(seatMatch){
      var split_block  = seatMatch.split("_");
     return split_block.pop();
   }

  function toTitleCase(word){
    return word.toLowerCase()
        .split(' ')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');
    }

   $("body").on("click","#checkAll",function(){
       $('.checkboxinput:visible:checkbox').not(this).prop('checked', this.checked);

         $(".block").css({"stroke": "#CCC", "stroke-width": "1" });

        $('.checkboxinput:checkbox').each(function(e,val){

             var block_id_check  = $(this).parents("tr").attr('data-region-name');


             $("[data-category='"+ block_id_check +"'].block").css({"stroke": "#000", "stroke-width": "3" });

        });
        

   });


   $('body').on("click"," #map-stadium g[data-section]",function(){
         var section = $(this).data("section");
         $('a[href="#map-tab"]').tab('show');
         $("#content_1").mCustomScrollbar("scrollTo",'[data-region-name="' + section+'"]');


         // Get current URL parts
         const path = window.location.pathname;
         const params = new URLSearchParams(window.location.search);
         const hash = window.location.hash;
         // Update query string values
         params.set('tab', "map-tab");

         window.history.replaceState({}, '', `${path}?${params.toString()}${hash}`);

   });


   // Regions
   var searchTimer;
   $('#mapsvg-regions-search').on('keyup', function () {
       searchTimer && clearTimeout(searchTimer);
       var that = this;
       var search_keyword = $(that).val();
       searchTimer = setTimeout(function () {
         console.log(search_keyword);

          if(search_keyword){

            search_keyword = search_keyword.replaceAll(" ", "_").toLowerCase();
          }

          //       console.log(search_keyword);

           $('#mapsvg-search-regions-no-matches').hide();
           if (search_keyword.length >  0) {
        
               $('#blocks_data  tbody tr').hide();
               $('[data-region-explode*="'+ search_keyword+'"]').show();  
               if($('[data-region-explode*="'+ search_keyword+'"]').length == 0)   {
                     $('#mapsvg-search-regions-no-matches').show();
               } 
           } else {
               $('#blocks_data tr').show();
               $('#mapsvg-search-regions-no-matches').hide();
           }
       }, 300);
   });



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
