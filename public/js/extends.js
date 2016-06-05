(function($) {
  $.fn.extend({
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
            elm.html('<span class="glyphicon glyphicon-heart-empty"></span> '+data.likeCount+' like');
            if(typeof data.like != "undefined" && data.like == 1) {
              elm.addClass('like');
            }else if(typeof data.like != "undefined" && data.like == 0) {
              elm.removeClass('like');
            }
          },
        });
      });
    },

    previewImage: function() {
      var reader = new FileReader();
      var image = document.getElementById('image').files[0];
      var preview = document.getElementById('preview-thumbnail');
      reader.onload = function(){
        preview.src = reader.result;
      }
      if(image) {
        reader.readAsDataURL(image);
        preview.setAttribute('class', 'thumbnail');
      }else{
        preview.src = "";
      }
    },

    createChatBox: function(xhr, id, name) {
      var item = document.createElement('DIV');
      if($('#uid'+id).length == 0) {
        var messageHeader = document.createElement('DIV');
        var messageBody = document.createElement('DIV');
        var messageFooter = document.createElement('DIV');
        var a = document.createElement('A');
        var close = document.createElement('SPAN');
        var i = document.createElement('INPUT');

        item.setAttribute('class', 'message-box');
        item.setAttribute('id', "uid"+id);
        messageHeader.setAttribute('class', 'message-header');
        messageBody.setAttribute('class', 'message-body');
        messageFooter.setAttribute('class', 'message-footer');
        a.setAttribute('data-target-xhr', xhr);
        a.style.color = "#fff";
        a.style.textDecoration = "none";
        a.style.fontWeight = "bold";
        a.innerHTML = name;
        close.innerHTML = "&times;";
        close.style.color = "#fff";
        close.style.cursor = "pointer";
        close.setAttribute('class', 'pull-right close-message-box');
        /* form */
        i.setAttribute('type', 'text');
        i.setAttribute('name', 'content');
        i.setAttribute('class', 'message-box-input');
        i.setAttribute('autocomplete', 'off');
        i.setAttribute('data-target-xhr', xhr);
        i.setAttribute('placeholder', 'write something...');
        /* append */
        item.appendChild(messageHeader);
        item.appendChild(messageBody);
        item.appendChild(messageFooter);
        messageHeader.appendChild(a);
        messageHeader.appendChild(close);
        messageFooter.appendChild(i);
      }

      if(document.querySelector('#message-container') == null) {
        var div = document.createElement('DIV');
        /* container messages */
        div.setAttribute('id', 'message-container');
        if($('#uid'+id).length == 0) {
          div.insertBefore(item, div.firstChild);
        }
        document.body.appendChild(div);
      }else{
        var messageContainer = document.querySelector('#message-container');
        if($('#uid'+id).length == 0) {
          messageContainer.insertBefore(item, messageContainer.firstChild);
        }
      }
    },

    sendMessageTo: function(xhr, content) {
      $(this).val('');
      var newMessage = new message(xhr, content);
      newMessage.send($(this).parent().parent());
    }
  });
}(jQuery));
