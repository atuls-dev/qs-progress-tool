/********* mobiscroll start ************/

mobiscroll.settings = {
        lang: 'en',                       // Specify language like: lang: 'pl' or omit setting to use default
        theme: 'ios',                     // Specify theme like: theme: 'ios' or omit setting to use default
        themeVariant: 'light',            // More info about themeVariant: https://docs.mobiscroll.com/4-10-6/javascript/datetime#opt-themeVariant
        display: 'bubble',                 // Specify display mode like: display: 'bottom' or omit setting to use default

    };
    var day = mobiscroll.time('.quit_time_input ', {
        onInit: function (event, inst) {  // More info about onInit: https://docs.mobiscroll.com/4-10-6/javascript/datetime#event-onInit
            inst.setVal(new Date(), true);
            if(qs_ajax.user_data.length == 0){
              inst.setVal(new Date(), true);

            }else{
              var d = new Date(qs_ajax.user_data.quit_date);

              inst.setVal(d, true);
            }
        },onSet: function(event, inst){

        },onShow: function(event, inst){


        },onClose: function(event, inst){

        }
    });
    var now = new Date();
    var date = mobiscroll.date('.quit_date_input ', {
        //showOnTap: false,                 // More info about showOnTap: https://docs.mobiscroll.com/4-10-6/javascript/datetime#opt-showOnTap
        //showOnFocus: false,
        dateFormat: 'dd M yy',
        max: new Date(now.getFullYear()+1,now.getMonth(),now.getDay()),                  // More info about showOnFocus: https://docs.mobiscroll.com/4-10-6/javascript/datetime#opt-showOnFocus
        min: new Date(now.getFullYear()-5,now.getMonth(),now.getDay()),
        onInit: function (event, inst) {  // More info about onInit: https://docs.mobiscroll.com/4-10-6/javascript/datetime#event-onInit
            inst.setVal(new Date(), true);

            if(qs_ajax.user_data.length == 0){
              inst.setVal(new Date(), true);

            }else{
              var d = new Date(qs_ajax.user_data.quit_date);
              inst.setVal(d, true);
            }
        },onSet: function(event, inst){
          jQuery('#quit_date_input').val(event.valueText);
          var day     = event.valueText,
          format  = jQuery('#qs_date_format option:selected').attr('moment'),
          date    = new Date(day),
          newDate = moment(date).format(format);
          jQuery('.qs_date_text').html(newDate);
        },onShow: function(event, inst){


        },onClose: function(event, inst){

        }
    });

	/*var el = document.getElementById('quit_time_input');
	if(el){
	    document
	        .getElementById('quit_time_input')
	        .addEventListener('click', function () {
	            day.show();
	        }, false);


  }*/
  /*var eldate = document.getElementById('quit_date_input');
  if(eldate){
      document
          .getElementById('quit_date_input')
          .addEventListener('click', function () {
              date.show();
          }, false);


  }*/
/********* mobiscroll end ************/


/********* quit date start ************/
jQuery(function(){

  //setTimeout(function(){
    if(qs_ajax.user_data .length == 0){
      jQuery('.hide-if-no-quit-date').css('display','none');
      jQuery('.show-if-no-quit-date').css('display','block');
    }else{
      jQuery('.hide-if-no-quit-date').css('display','block');
      jQuery('.show-if-no-quit-date').css('display','none');
    }

  //}, 300);



  jQuery('.qs_date_fields').on('change',function(){
      var day     = jQuery(".quit_date_input").val(),
          format  = jQuery('#qs_date_format option:selected').attr('moment'),
          date    = new Date(day),
          newDate = moment(date).format(format);
          jQuery('.qs_date_text').html(newDate);

  });

  jQuery('#qs_date_format').on('change',function(){
      var day     = jQuery(".quit_date_input").val(),
          format  = jQuery('option:selected', this).attr('moment'),
          date    = new Date(day),
          newDate = moment(date).format(format);

          jQuery('.qs_date_text').html(newDate);
  });
/********* quit date end ************/

/********* form submission start ************/
 jQuery('.smoking_forms').each(function () {
    var tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
    jQuery('#smk_timeZone').val(tz);
    
    jQuery(this).validate({
    highlight: function (element, errorClass, validClass) {
        jQuery(element).closest('div').addClass('qs-error');
    },
    unhighlight: function (element, errorClass, validClass) {
        jQuery(element).closest('div').removeClass('qs-error');
    },
    submitHandler: function(form) {

       var fname = jQuery(form).attr('name');
       jQuery.ajax({
        url: qs_ajax.ajaxurl,
        type: 'POST',
        data:jQuery(form).serialize(),
        success: function( data ){
          var options   = jQuery.parseJSON(data);
          console.log(options);
          var current_modal = jQuery.modal.getCurrent().$elm;
          var opened_modal = current_modal.attr('id');
          jQuery('.'+fname).find('.qs_with_data').removeClass('qs_hide');
          jQuery('.'+fname).find('.qs_no_data').addClass('qs_hide');
          if(opened_modal == 'qs_form_popup'){
            if(options.status == 200){
              jQuery(form).closest('.smkfr-slide').find('.prev_page').trigger('click');
            }
          }else{
            if(options.status == 200){
              Swal.fire({
                icon: 'success',
                title: options.msg,
                timer: 1500,
                showConfirmButton: false,
              });
            }else{
              Swal.fire({
                icon: 'error',
                title: options.msg,
                timer: 1500,
                showConfirmButton: false,
              });
            }
            jQuery.modal.close();
          }
        }
      });
      return false;
    }
  });
  });

/********* form submission end ************/

  /********* show hide animation start *************/
  jQuery('.qs_slide_btn').on('click',function(){
    var slide = jQuery(this).attr('current'),
        next  = parseInt(slide)+1;

    jQuery('.smkfr-slide').removeClass('qs_hidden').removeClass('qs_visible');
    if(slide == 1){
       jQuery('.qs_slide_'+slide).addClass('qs_hidden_first');
       jQuery('.qs_slide_'+slide).addClass('qs_hidden');
    }else{
       jQuery('.qs_slide_2').addClass('qs_hidden');
    }

    jQuery('.qs_slide_'+next).addClass('qs_visible');
  });

  jQuery('.prev_page').on('click',function(){
    var slide = jQuery(this).attr('current');
    if(slide == 1){
       jQuery('.qs_slide_'+slide).renoveClass('qs_hidden_first');
    }
    jQuery('.smkfr-slide').removeClass('qs_hidden').removeClass('qs_visible');
    //jQuery('.qs_slide_'+slide).addClass('qs_hidden');
    jQuery('.qs_slide_2').addClass('qs_visible');
  });

/********* show hide animation end *************/

    jQuery('.qs_cig_per_day').on('change input',function(){
      jQuery('.qs_cig_per_day_text').html(jQuery(this).val());
    });

    jQuery('.qs_cig_price_fields').on('change input',function(){
      var price     = jQuery(this).val(),
          currency  = jQuery('#qs_cig_currency option:selected').attr('symbol'),
          price = parseFloat(price).toFixed(2);
          newPrice  = currency+' '+price;
       jQuery('.qs_cig_price_text').html(newPrice);
    });
    jQuery('.qs_date_popup').click(function(event) {
      event.preventDefault();
      this.blur(); // Manually remove focus from clicked link.
      jQuery('#qs_form_popup').appendTo('body').modal();
    });
});


    jQuery(".qs_health_percent").each(function() {
        var $this = jQuery(this),
        $dataV = $this.data("percent"),
        $dataDeg = $dataV * 3.6,
        $round = $this.find(".qs_round_per");

      $this.append('<div class="qs_circle_inbox"><span class="qs_percent_text"></span></div>');
      $round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
      $this.prop('Counter', 0).animate({Counter: $dataV},
      {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
                $this.find(".qs_percent_text").text(Math.ceil(now)+"%");
            }
        });
      if($dataV >= 51){
        $round.css("transform", "rotate(" + 360 + "deg)");
        setTimeout(function(){
          $this.addClass("qs_percent_more");
        },1000);
        setTimeout(function(){
          $round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
       },1000);
      }
    });


  //   jQuery('#quit_date_form').on('shown.bs.modal', function (e) {
  //       alert('sdfsdf');
  //   })

  //   jQuery(document).on('show.bs.modal', '#quit_date_form', function (e) {
  //     console.log('works');
  //     alert('sdfsdf');
  // });
