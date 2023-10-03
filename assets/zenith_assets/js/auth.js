/*! components.js | Huro | Css Ninja. 2020-2021 */

//  var notyf = new Notyf({
//             duration: 2e3,
//             position: { x: "right", y: "bottom" },
//             types: [
//                 { type: "warning", background: themeColors.warning, icon: { className: "fas fa-hand-paper", tagName: "i", text: "" } },
//                 { type: "info", background: themeColors.info, icon: { className: "fas fa-info-circle", tagName: "i", text: "" } },
//                 { type: "primary", background: themeColors.primary, icon: { className: "fas fa-car-crash", tagName: "i", text: "" } },
//                 { type: "accent", background: themeColors.accent, icon: { className: "fas fa-car-crash", tagName: "i", text: "" } },
//                 { type: "purple", background: themeColors.purple, icon: { className: "fas fa-check", tagName: "i", text: "" } },
//                 { type: "blue", background: themeColors.blue, icon: { className: "fas fa-check", tagName: "i", text: "" } },
//                 { type: "green", background: themeColors.green, icon: { className: "fas fa-check", tagName: "i", text: "" } },
//                 { type: "orange", background: themeColors.orange, icon: { className: "fas fa-check", tagName: "i", text: "" } },
//             ],
//         });

"use strict";
initPageLoader(),
    $(document).ready(function () {
        if (
            ("development" === env && changeDemoImages(),
            feather.replace(),
            initDarkMode(),
            initAnimatedModals(),
                      $('.validate_form').validate({
  submitHandler: function(form) {
    
    var myform = $('#'+$(form).attr('id'))[0];
    var formData = new FormData(myform);
    var i = $('.submit');
    i.addClass("is-loading")
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
        i.removeClass("is-loading");
        if(data.status == 1) {

        notyf.success(data.msg, "Login Authentication", {
        timeOut: "1800"
        });
        setTimeout(function(){
         window.location.href = data.redirect_url; }, 2000);
        }else if(data.status == 0) {
        notyf.error(data.msg, "Login Authentication", "Oops!", {
        timeOut: "1800"
        });
        setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
        }
      }
    })
    return false;
  }
}),
            $('.validate_form_v1').validate({
  submitHandler: function(form) {
  	
	var myform = $('#'+$(form).attr('id'))[0];
	var formData = new FormData(myform);
	 var i = $('.submit');
	i.addClass("is-loading")
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
      	i.removeClass("is-loading");
		if(data.status == 1) {

		notyf.success(data.msg, "Login Authentication", {
		timeOut: "1800"
		});
		setTimeout(function(){
		 window.location.href = data.redirect_url; }, 2000);
		}else if(data.status == 0) {
		notyf.error(data.msg, "Login Authentication", "Oops!", {
		timeOut: "1800"
		});
		setTimeout(function(){ window.location.href = data.redirect_url; }, 2000);
		}
      }
    })
    return false;
  }
})

            /*$("#login-submit").on("click", function () {
                var i = $(this);
                i.addClass("is-loading"),
                    setTimeout(function () {
                        i.removeClass("is-loading"), $("#login-form").submit();
                    }, 1e3);
            })*/,
            $("#forgot-link, #cancel-recover").on("click", function () {
                $(this).closest(".is-form").find("form, .form-text").toggleClass("is-hidden");
            }),
            $("#huro-signup").length)
        ) {
            if (
                ($(".step-icon").on("click", function () {
                    var i = $(this).attr("data-step"),
                        e = $(this).attr("data-progress");
                    $(this).prevAll().addClass("is-done"),
                        $(this).removeClass("is-done").addClass("is-active"),
                        $(this).nextAll().removeClass("is-active is-done"),
                        $("#signup-steps-progress").val(e),
                        void 0 !== i && ($(".signup-columns").addClass("is-hidden"), $("#" + i).removeClass("is-hidden"), $(".avatar-carousel").slick("setPosition"), $(".card-bg").addClass("faded")),
                        "signup-step-1" == i && $(".card-bg").removeClass("faded");
                }),
                $("#confirm-step-1").on("click", function () {
                    var i = $(this);
                    i.addClass("is-loading"),
                        setTimeout(function () {
                            i.removeClass("is-loading"), $(".card-bg").addClass("faded"), $(".signup-steps").removeClass("is-hidden"), $("#signup-step-1, #signup-step-2").toggleClass("is-hidden"), $(".avatar-carousel").slick("setPosition");
                        }, 1e3);
                }),
                $(".avatar-carousel").length)
            ) {
                var i = $(".avatar-carousel");
                i.on("init", function () {
                    feather.replace();
                }),
                    i.on("afterChange", function () {
                        var i = $(".avatar-carousel").find(".slick-current img").attr("src");
                        $(".picture-selector .image-container img").attr("src", i), $("#confirm-step-2").removeClass("is-disabled");
                    }),
                    $(".avatar-carousel").slick({
                        centerMode: !0,
                        dots: !1,
                        infinite: !0,
                        centerPadding: "100px",
                        prevArrow: "<div class='slick-custom is-prev'><i data-feather='chevron-left'></i></div>",
                        nextArrow: "<div class='slick-custom is-next'><i data-feather='chevron-right'></i></div>",
                        slidesToShow: 3,
                    }),
                    $(".slick-slider").on("click", ".slick-slide", function (i) {
                        i.stopPropagation();
                        var e = $(this).data("slick-index");
                        $(".slick-slider").slick("slickCurrentSlide") !== e && $(".slick-slider").slick("slickGoTo", e);
                    });
            }
            FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginImageExifOrientation, FilePondPluginFileValidateSize, FilePondPluginImageEdit),
                FilePond.create(document.querySelector(".signup-filepond"), {
                    labelIdle: '<i class="lnil lnil-cloud-upload"></>',
                    imagePreviewHeight: 140,
                    imageCropAspectRatio: "1:1",
                    imageResizeTargetWidth: 140,
                    imageResizeTargetHeight: 140,
                    stylePanelLayout: "compact circle",
                    styleLoadIndicatorPosition: "center bottom",
                    styleProgressIndicatorPosition: "right bottom",
                    styleButtonRemoveItemPosition: "left bottom",
                    styleButtonProcessItemPosition: "right bottom",
                }),
                document.querySelector(".signup-filepond").addEventListener("FilePond:addfile", function (i) {
                    console.log("File added", i.detail), document.getElementById("signup-profile-upload").classList.remove("is-disabled");
                }),
                $("#confirm-step-2").on("click", function () {
                    var i = $(this);
                    i.addClass("is-loading"),
                        setTimeout(function () {
                            i.removeClass("is-loading"), $(".step-icon:nth-child(2)").removeClass("is-inactive").trigger("click");
                        }, 1e3);
                }),
                $("#finish-signup").on("click", function () {
                    var i = $(this);
                    i.addClass("is-loading"),
                        $(".step-icon.is-inactive").removeClass("is-inactive").trigger("click"),
                        setTimeout(function () {
                            i.removeClass("is-loading"), (window.location.href = "/admin-dashboards-personal-1.html");
                        }, 1400);
                });
        }
    });
