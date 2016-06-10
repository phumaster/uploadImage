/*
* pull.js
* Author: Phú Master
*/

/* function pullRequest from server */
function pullRequest() {
  /* send request to server */
  var xhr = $.ajax({
    method: 'POST',
    url: 'pull?random_key='+Math.floor(Math.random()*10),
    data: {'_token':$('meta[name=csrf-token]').attr('content')},
    success: function(response) {
      if(response != null) {
        $('.badge-message').text(response.length);
        $.each(response, function(i, val) {
          $(document).createChatBox(val.xhr, val.user.id, val.user.name);
          $('#uid'+val.user.id).find('.message-body')
            .append('<div><div class="r pull-right right"><div class="message-content">'+val.content+'</div><div class="clear-fix"></div></div></div>');
            if($('.uid'+val.user.id) != null) {
              $('.uid'+val.user.id).find('.row-message')
                .append('<div><div class="r pull-right right"><div class="message-content">'+val.content+'</div><div class="author"><a href="#"><img src="'+val.avatar_url+'" class="logo-user"/></a></div></div><div class="clear-fix"></div></div>');
              var h = $('.uid'+val.user.id).find('.row-message').height();
              $('.uid'+val.user.id).find('.message-body').scrollTop(h);
            }
        });

        /* set event */
        $('.close-message-box').click(function() {
          $(this).parent().parent().remove();
        });

        $('.message-box-input').keydown(function(e) {
          if(e.keyCode == 13 && $(this).val() != "") {
            $(this).sendMessageTo($(this).attr('data-target-xhr'), $(this).val());
          }
          if(e.keyCode == 27) {
            $(this).parent().parent().remove();
          }
        });
      }else{
        $('.notify-message').css({'color':'#CCCCCC'});
      }
      /* pull request */
      // pullRequest();
    },
  }); /* end ajax */
  $(document).on('click', 'a[href]', function() {
    xhr.abort();
  });
} /* end function pullRequest */

$(function() {
  // pullRequest();
  // setTimeout('pullRequest()', 5000);
});
