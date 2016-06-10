/*
* extra.js
* Author: Phú Master
*/

/*
* hide content when load DOM
*/
document.getElementById('content').style.display = 'none';
/* create notification box */
notification.create();
/* when DOM ready */
$(document).ready(function() {
  /* hide overlay and show content */
  $('#overlay-loading').fadeOut(1000, 'swing', function() {
    $('#content').fadeIn(1000);
  });
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

});
