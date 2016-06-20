/*
* extra.js
* Author: Phú Master
*/

/* create notification box */
notification.create();
/* when DOM ready */
$(document).ready(function() {
  /* event click on vertical menu */
  $('.vertical-menu-a[data-target-xhr]').click(function(e){
    e.preventDefault();
    $('#vertical-menu li a').removeClass('active');
    $(this).addClass('active');
  });
  /* set padding vertical menu */
  var h_h = $('#header').height();
  $('.vertical-column').css({"padding-top":h_h+5});
  /* send AJAX when click link menu */
  fire();
  /* handle click friend -> send message */
  $(document).on('click', '.send-message-to-friend',function() {
    var xhr = $(this).attr('data-target-xhr');
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    /* create chat box */
    $(this).createChatBox(xhr, id, name);
    /* close chat box */
    $('.close-message-box').click(function() {
      $(this).parent().parent().remove();
    });
    /* send message when press Enter */
    $('.message-box-input').keydown(function(e) {
      if(e.keyCode == 13 && $(this).val() != "") {
        $(this).sendMessageTo($(this).attr('data-target-xhr'), $(this).val());
      }
      if(e.keyCode == 27) {
        $(this).parent().parent().remove();
      }
    });
  });
  /* send ajax upload photo */
  $(document).on('submit', '.form-upload-photo', function(event) {
    event.preventDefault();
    $(this).uploadPhoto($(this).attr('action'));
  });

  /* send ajax create album */
  $(document).on('submit', '.form-create-album', function(event) {
    event.preventDefault();
    $(this).createAlbum($(this).attr('action'));
  });
  /* show menu vertical */
  $('#show-vertical-menu').click(function() {
    $('#content').toggleClass('translate');
    $('.vertical-column').toggleClass('animate-column');
  });
  /* tab notify */
  $('.notify[data-target-tab]').click(function() {
    $('.nav-content').addClass('nav-content-active').find('div').removeClass('tab-active');
    $($(this).attr('data-target-tab')).toggleClass('tab-active');
  });
  $('.nav-content .close-tab').click(function(){
    $(this).parent().parent().removeClass('nav-content-active');
  });

  $(document).on('click', function(event) {
    var className = event.target.className;
    if(className != 'close-tab' && className != 'notify' && className != 'response-request-friend') {
      $('.nav-content').removeClass('nav-content-active');
    }
  });
});

/*jQuery masterial design click effect */

$(function(){
	var ink, d, x, y;
	$("a").click(function(e){
    if($(this).find(".ink").length === 0){
        $(this).prepend("<span class='ink'></span>");
    }

    ink = $(this).find(".ink");
    ink.removeClass("animate");

    if(!ink.height() && !ink.width()){
        d = Math.max($(this).outerWidth(), $(this).outerHeight());
        ink.css({height: d, width: d});
    }

    x = e.pageX - $(this).offset().left - ink.width()/2;
    y = e.pageY - $(this).offset().top - ink.height()/2;

    ink.css({top: y+'px', left: x+'px'}).addClass("animate");
});
});
