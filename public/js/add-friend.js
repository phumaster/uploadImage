$(document).ready(function() {
  $('.btn-add-friend').click(function(e) {
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
          elm.removeClass('btn-default').addClass('btn-success').html('<span class="glyphicon glyphicon-check"></span> Friend request sent');
          notification.push('Friend request sent', 'success');
        }
      }
    });
  });
});
