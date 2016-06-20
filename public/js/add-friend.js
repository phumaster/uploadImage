$(document).ready(function() {
  $(document).on('click', '.btn-add-friend', function(e) {
    e.preventDefault();
    var elm = $(this);
    $.ajax({
      method: 'POST',
      url: $(this).attr('data-target-xhr'),
      data: {'_token':$('meta[name=csrf-token]').attr('content')},
      success: function(response) {
        var data = JSON.parse(response);
        if(data.error == 1 || data.error == -1) {
          elm.removeClass('btn-default').addClass('btn-danger');
        }
        if(data.error == 0 || data.error == -2) {
          elm.removeClass('btn-default').addClass('btn-success').html('<span class="glyphicon glyphicon-check"></span> pending');
          notification.push('Friend request sent!', 'success');
        }
      }
    });
  });

  /* response request response-request-friend */

  $(document).on('click', '.response-request-friend', function(e) {
    e.preventDefault();
    var elm = $(this);
    $.ajax({
      method: 'POST',
      url: $(this).attr('data-target-xhr'),
      data: {'_token':$('meta[name=csrf-token]').attr('content')},
      success: function(response) {
        if(response.error === 1) {
          elm.parent().parent().remove();
          notification.push(response.message, 'error');
        }else{
          elm.parent().parent().css({'background':'#5CB85C'})
            .slideUp(1000);
          notification.push(response.message, 'success');
        }
      }
    });
  });
});
