"use strict";

document.addEventListener('DOMContentLoaded', function() {

$(window).scroll(function() {
    var nav = $('.navbar');
    var top = 100;
    if ($(window).scrollTop() >= top) {
        nav.addClass('show-menu');
    } else {
        nav.removeClass('show-menu');
    }
});
//------------------------------------------------------------------------------------
//						CONTACT FORM VALIDATION'S SETTINGS
//------------------------------------------------------------------------------------
$('#header-halfbg-form-form').validate({
    onfocusout: false,
    onkeyup: false,
    rules: {
		NAME: "required",
		PHONE: "required",
		Mail: "required",
	},
    errorPlacement: function (error, element) {

        if ((element.attr("type") == "radio") || (element.attr("type") == "checkbox")) {
            error.appendTo($(element).parents("div").eq(0));
        } else {
            error.insertAfter(element);
        }
    }
});

//------------------------------------------------------------------------------------
//								CONTACT FORM SCRIPT
//------------------------------------------------------------------------------------

$('#header-halfbg-form-form').submit(function () {
    // submit the form
    //data area
    var data = [];
    var $fields = $(this).find('.form-group, div.radio');
    $fields.each(function(indx, el){
        if ($( el ).hasClass('radio')) {
            var name = $( el ).find('.label-name').html();
            var $radioinput = $(el).find('input');
            $( el).find('input').each(function(indx, el){
                if ( $(el)[0].checked) {
                    var value = $(el).parent().find('span.lbl').html();
                    data.push({ name: name, value: value, name_attr: $radioinput.attr('name') });
                    return;
                }
            });
        } else if ($( el ).find('input').attr('type') === 'checkbox') {
            var $input = $( el ).find( 'input' );
            data.push( {name: $input.attr( 'placeholder' ), value: $input[0].checked ? 'checked' : 'unchecked', name_attr: $input.attr('name')} );
        } else if ($( el ).find('select')[0]) {
            var name = $( el ).find('select option' ).val();
            var $select = $(el).find('select');
            data.push({ name: name, value: $select.val(), name_attr: $select.attr('name')});
        } else if ($( el ).find('textarea')[0]) {
            var $textarea = $(el).find('textarea');
            data.push({ name: $textarea.attr('placeholder'), value: $textarea.val(), name_attr: $textarea.attr('name') });
        } else {
            var $input = $(el).find('input');
            data.push({ name: $input.attr('placeholder'), value: $input.val(), name_attr: $input.attr('name') });
        }
    });
    //end data area
    if ($(this).valid()) {
        $(this).find('[type=submit]').button('loading');
        var form = new FormData();
        var $inputFiles = $('.inputfile');
        $inputFiles.each(function(indx, inputFile){
            $.each(inputFile.files, function(i, file) {
                form.append('file-' + indx + '-' + i, file);
            });
        });
        form.append('data', JSON.stringify(data));
        form.append('id', this.id);
        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            success: function () {
	$('#header-halfbg-form-form').find('[type=submit]').button('complete');
},
            error: function () {
	$('#header-halfbg-form-form').find('[type=submit]').button('reset');
}
        });
    } else {
        //if data was invalidated
    }
    return false;
});





//------------------------------------------------------------------------------------
//								COUNT UP SCRIPT
//------------------------------------------------------------------------------------

var benefits_4col_counter_2 = $('#benefits-4col-counter-2').waypoint({
	handler: function(direction) {
		$(this.element).find('.count-up-data').each(function(i, el){
			var endVal = el && Number.isInteger(el.textContent * 1) ? el.textContent * 1 : 100 ;
			$(el ).countup({endVal: endVal, options: { separator : ''}});
		});
        benefits_4col_counter_2[0].disable();
	},
	offset: '90%'
});
//------------------------------------------------------------------------------------
//						CONTACT FORM VALIDATION'S SETTINGS
//------------------------------------------------------------------------------------
$('#contact-center-form-form').validate({
    onfocusout: false,
    onkeyup: false,
    rules: {
		NAME: "required",
		textfield_2: "required",
		diachi: "required",
	},
    errorPlacement: function (error, element) {

        if ((element.attr("type") == "radio") || (element.attr("type") == "checkbox")) {
            error.appendTo($(element).parents("div").eq(0));
        } else {
            error.insertAfter(element);
        }
    }
});

//------------------------------------------------------------------------------------
//								CONTACT FORM SCRIPT
//------------------------------------------------------------------------------------

$('#contact-center-form-form').submit(function () {
    // submit the form
    //data area
    var data = [];
    var $fields = $(this).find('.form-group, div.radio');
    $fields.each(function(indx, el){
        if ($( el ).hasClass('radio')) {
            var name = $( el ).find('.label-name').html();
            var $radioinput = $(el).find('input');
            $( el).find('input').each(function(indx, el){
                if ( $(el)[0].checked) {
                    var value = $(el).parent().find('span.lbl').html();
                    data.push({ name: name, value: value, name_attr: $radioinput.attr('name') });
                    return;
                }
            });
        } else if ($( el ).find('input').attr('type') === 'checkbox') {
            var $input = $( el ).find( 'input' );
            data.push( {name: $input.attr( 'placeholder' ), value: $input[0].checked ? 'checked' : 'unchecked', name_attr: $input.attr('name')} );
        } else if ($( el ).find('select')[0]) {
            var name = $( el ).find('select option' ).val();
            var $select = $(el).find('select');
            data.push({ name: name, value: $select.val(), name_attr: $select.attr('name')});
        } else if ($( el ).find('textarea')[0]) {
            var $textarea = $(el).find('textarea');
            data.push({ name: $textarea.attr('placeholder'), value: $textarea.val(), name_attr: $textarea.attr('name') });
        } else {
            var $input = $(el).find('input');
            data.push({ name: $input.attr('placeholder'), value: $input.val(), name_attr: $input.attr('name') });
        }
    });
    //end data area
    if ($(this).valid()) {
        $(this).find('[type=submit]').button('loading');
        var form = new FormData();
        var $inputFiles = $('.inputfile');
        $inputFiles.each(function(indx, inputFile){
            $.each(inputFile.files, function(i, file) {
                form.append('file-' + indx + '-' + i, file);
            });
        });
        form.append('data', JSON.stringify(data));
        form.append('id', this.id);
        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: 'POST',
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            success: function () {
	$('#contact-center-form-form').find('[type=submit]').button('complete');
},
            error: function () {
	$('#contact-center-form-form').find('[type=submit]').button('reset');
}
        });
    } else {
        //if data was invalidated
    }
    return false;
});



 var check = false;
$.get('https://slimweb.vn/builder/client_data.json', function(data) {
   if(data!==''){
  var json_obj = JSON.parse(data);
  var count = Object.keys(json_obj["info"]).length;
  count = count - 1;
  var content_org = $("#wrap #content_cl").text();
 
  $("#wrap #tool-fake-client1").fadeOut();
  $("#wrap #tool-fake-client1").css("left","-500px");
function myFunction() {
  var random = Math.floor(Math.random() * (count - 0 + 1) + 0);
  var name = json_obj["info"][random].name;
  var email = json_obj["info"][random].email;
  var image = json_obj["info"][random].image;
  var city = json_obj["info"][random].city;
  var time_ago=Math.floor((Math.random() * 60) + 10);

  var min = 10,
  max = 40;
  var rand = Math.floor(Math.random() * (max - min + 1) + min);
  var rand_first = Math.floor(Math.random() * 3 + 1);
  var time = ((rand * 1000) + 6500);
  var time_firts;
  if(check == false){
	  time_firts = rand_first * 1000;
  }else{
	  time_firts = 0;
  }
	setTimeout(function(){
	$("#wrap #img_cl").attr("src",image);
  $("#wrap #img_cl").attr("data-src",image);
  var content=content_org;
  content=content.replace("*city*", "<span id=cl_cl>"+city+"</span>");
  content=content.replace("*name*", "<span id=cl_cl>"+name+"</span>");
  content=content.replace("*email*", "<span id=cl_cl>"+email+"</span>");
  $("#wrap #content_cl").html(content);
  $("#wrap #time_cl").html("Cách đây "+time_ago+" phút");

 	$( "#wrap #tool-fake-client1" ).fadeIn();
	$("#wrap #tool-fake-client1").animate({
		left: "10px",
	},1500);

	setTimeout(function(){
		 $( "#wrap #tool-fake-client1" ).fadeOut();
		 $("#wrap #tool-fake-client1").animate({
		left: "-500px",
		});
	 },6000);

	},time_firts);
	check = true;
  setTimeout(myFunction, time);
}
myFunction();

   }
}, 'text');
 var check = false;
$.get('https://slimweb.vn/builder/client_data.json', function(data) {
   if(data!==''){
  var json_obj = JSON.parse(data);
  var count = Object.keys(json_obj["info"]).length;
  count = count - 1;
  var content_org = $("#wrap #content_cl").text();
 
  $("#wrap #tool-fake-client1").fadeOut();
  $("#wrap #tool-fake-client1").css("left","-500px");
function myFunction() {
  var random = Math.floor(Math.random() * (count - 0 + 1) + 0);
  var name = json_obj["info"][random].name;
  var email = json_obj["info"][random].email;
  var image = json_obj["info"][random].image;
  var city = json_obj["info"][random].city;
  var time_ago=Math.floor((Math.random() * 60) + 10);

  var min = 10,
  max = 40;
  var rand = Math.floor(Math.random() * (max - min + 1) + min);
  var rand_first = Math.floor(Math.random() * 3 + 1);
  var time = ((rand * 1000) + 6500);
  var time_firts;
  if(check == false){
	  time_firts = rand_first * 1000;
  }else{
	  time_firts = 0;
  }
	setTimeout(function(){
	$("#wrap #img_cl").attr("src",image);
  $("#wrap #img_cl").attr("data-src",image);
  var content=content_org;
  content=content.replace("*city*", "<span id=cl_cl>"+city+"</span>");
  content=content.replace("*name*", "<span id=cl_cl>"+name+"</span>");
  content=content.replace("*email*", "<span id=cl_cl>"+email+"</span>");
  $("#wrap #content_cl").html(content);
  $("#wrap #time_cl").html("Cách đây "+time_ago+" phút");

 	$( "#wrap #tool-fake-client1" ).fadeIn();
	$("#wrap #tool-fake-client1").animate({
		left: "10px",
	},1500);

	setTimeout(function(){
		 $( "#wrap #tool-fake-client1" ).fadeOut();
		 $("#wrap #tool-fake-client1").animate({
		left: "-500px",
		});
	 },6000);

	},time_firts);
	check = true;
  setTimeout(myFunction, time);
}
myFunction();

   }
}, 'text');

$(document).on('click', '.btbg', function() {
    $(this).find('.social_chat').toggleClass('hidden');
});


});
