(function($) {
  $.fn.extend({
    showHoverCard: function() {
      this.click(function(event) {
        //event.preventDefault();
      });
    },
    commentThisPhoto: function() {
      this.submit(function(e) {
        e.preventDefault();
        var elm = $(this);
        e.preventDefault();
        $.ajax({
          method: 'POST',
          contentType: false,
          processData: false,
          url: $(this).attr('action'),
          data: new FormData(this),
          success: function(response) {
            var data = JSON.parse(response);
            notification.push(data.message, 'success');
            elm.find('.input-comment').val("");
          },
          error: function(response) {
            $.each(response.responseJSON, function(i, v) {
              notification.push(v, 'danger');
            });
          }
        });
      });
    },
    likeThisPhoto: function() {
      this.click(function(e) {
        var elm = $(this);
        e.preventDefault();
        $.ajax({
          method: 'POST',
          url: $(this).attr('data-target-xhr'),
          data: {'_token':$('meta[name=csrf-token]').attr('content')},
          success: function(response) {
            var data = JSON.parse(response);
            notification.push(data.message, 'info');
            elm.html('<i class="fa fa-fw fa-heart-o"></i> '+data.likeCount+' like');
            if(typeof data.like != "undefined" && data.like == 1) {
              elm.addClass('like');
            }else if(typeof data.like != "undefined" && data.like == 0) {
              elm.removeClass('like');
            }
          },
        });
      });
    }
  });
}(jQuery));
