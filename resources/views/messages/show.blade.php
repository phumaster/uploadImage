<div class="container">
  <div class="row">
    <div class="col-sm-10 col-sm-offset-2">
      <div class="messages uid{{ $receiver }}">
        <div class="message-header">
          <h4><span class="glyphicon glyphicon-envelope"></span> Conversation</h4>
          <hr/>
        </div>
        <div class="message-body">
          <div class="row-message">
            @if(count($messages) > 0)
              @foreach($messages as $message)
                @if(Auth::user()->id != $message->user->id)
                <div>
                  <div class="r pull-right right">
                    <div class="message-content" title="{{ $message->created_at }}">
                      {{ $message->content }}
                    </div>
                    <div class="author">
                      <a href="{{ route('user.profile', $message->user->id) }}">
                        <img src="{{ $message->user->getProfilePictureUrl() }}" alt="{{ $message->user->name }}" class="logo-user" title="{{ $message->user->name }}"/>
                      </a>
                    </div>
                  </div>
                  <div class="clear-fix"></div>
                </div>
                @else
                <div>
                  <div class="r left">
                    <div class="author">
                      <a href="{{ route('user.profile', $message->user->id) }}">
                        <img src="{{ $message->user->getProfilePictureUrl() }}" alt="{{ $message->user->name }}" class="logo-user" title="{{ $message->user->name }}"/>
                      </a>
                    </div>
                    <div class="message-content" title="{{ $message->created_at }}">
                      {{ $message->content }}
                    </div>
                  </div>
                  <div class="clear-fix"></div>
                </div>
                @endif
              @endforeach
            @else
              <div class="text-center text-danger">
                Nothing to show
              </div>
            @endif
          </div>
        </div>
        <div class="message-footer">
          {!! Form::open(['route' => ['message', $receiver], 'method' => 'POST', 'class' => 'send-message-form', 'id' => 'send-msg']) !!}
            {!! Form::text('content', '', ['class' => 'input-send-message form-control', 'placeholder' => 'Write something and press "Enter" to send', 'autocomplete' => 'off']) !!}
          {!! Form::close() !!}
        </div>
      </div><!-- end .messages -->
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.message-body').scrollTop($(this).find('.row-message').height());
    $('#send-msg').submit(function(event) {
      event.preventDefault();
      var input = $(this).find('.input-send-message');
      var element = $(this);
      if(input.val() != 0) {
        $.ajax({
          method:'POST',
          url:$(this).attr('action'),
          cache:false,
          processData: false,
          contentType: false,
          data: new FormData(this),
          success: function(response) {
            input.val("");
            var data = JSON.parse(response);
            element.parent().parent().find('.row-message')
              .append('<div>'
                +'<div class="r left">'
                +'<div class="author">'
                +'<a href="{{ route('user.profile', Auth::user()->id) }}">'
                +'<img src="{{ Auth::user()->getProfilePictureUrl() }}" alt="{{ Auth::user()->name }}" class="logo-user" title="{{ Auth::user()->name }}"/>'
                +'</a>'
                +'</div>'
                +'<div class="message-content">'+data.message
                +'</div>'
                +'</div>'
                +'<div class="clear-fix"></div>'
                +'</div>');
            $('.message-body').scrollTop(element.parent().parent().find('.row-message').height());
          }
        });
      }
    });
  });
</script>
