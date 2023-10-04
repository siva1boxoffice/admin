!(function (e) {

    if($("#editor1").length > 0 ){
        var editor1 = CKEDITOR.replace('editor1', {
          extraAllowedContent: 'div;h1;h2;h3;h4;h5;h6;p;span;ul;li;table;td;style;*[id];*(*);*{*}',
          height: 460,
          startupMode: 'source',
          removeButtons: 'PasteFromWord'
        });
    }
   
   if($("#editor2").length > 0 ){
        var editor2 = CKEDITOR.replace('editor2', {
          extraAllowedContent: 'div;h1;h2;h3;h4;h5;h6;p;span;ul;li;table;td;style;*[id];*(*);*{*}',
          height: 460,
          startupMode: 'source',
          removeButtons: 'PasteFromWord'
        });
      }

    if($("#editor3").length > 0 ){
        var editor3 = CKEDITOR.replace('editor3', {
          extraAllowedContent: 'div;h1;h2;h3;h4;h5;h6;p;span;ul;li;table;td;style;*[id];*(*);*{*}',
          height: 460,
          startupMode: 'source',
          removeButtons: 'PasteFromWord'
        });
    }

    if($("#editor-4").length > 0 ){
        var editor4 = CKEDITOR.replace('editor-4', {
          extraAllowedContent: 'div;h1;h2;h3;h4;h5;h6;p;span;ul;li;table;td;style;*[id];*(*);*{*}',
          height: 460,
          startupMode: 'source',
          removeButtons: 'PasteFromWord'
        });
    }

    if($("#editor-5").length > 0 ){
         var editor5 = CKEDITOR.replace('editor-5', {
          extraAllowedContent: 'div;h1;h2;h3;h4;h5;h6;p;span;ul;li;table;td;style;*[id];*(*);*{*}',
          disallowedContent : 'span;code;big',
          height: 460,
          startupMode: 'source',
          removeButtons: 'PasteFromWord'
        });
    }
    if($("#editor-6").length > 0 ){
      var editor5 = CKEDITOR.replace('editor-6', {
       extraAllowedContent: 'div;h1;h2;h3;h4;h5;h6;p;span;ul;li;table;td;style;*[id];*(*);*{*}',
       disallowedContent : 'span;code;big',
       height: 460,
       startupMode: 'source',
       removeButtons: 'PasteFromWord'
     });
 }
   /* CKEDITOR.replace("editor-4"),
        e("#editor-5").length &&
            ClassicEditor.create(document.querySelector("#editor-5"))
                .then(function (e) {})
                .catch(function (e) {
                    console.error("error", e);
                });*/
    CKEDITOR.on("instanceReady", function(event) { 
        event.editor.on("beforeCommandExec", function(event) {
            // Show the paste dialog for the paste buttons and right-click paste
            if (event.data.name == "paste") {
                event.editor._.forcePasteDialog = true;
            }
            // Don't show the paste dialog for Ctrl+Shift+V
            if (event.data.name == "pastetext" && event.data.commandData.from == "keystrokeHandler") {
                event.cancel();
            }
        })
    });

})(jQuery);
