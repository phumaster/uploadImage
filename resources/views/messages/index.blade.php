<div class="container">
  <div class="col-sm-10 col-sm-offset-2">
    <div class="messages">
      <h4><span class="glyphicon glyphicon-envelope"></span> Messages</h4>
      <b>Sent</b> | <i>Recieved</i>
      <hr/>
      @if(count($user->conversations) > 0)
        @foreach($user->conversations as $conversation)
          <div class="message-item">
            <img src="{{ $conversation->sendToUser->getProfilePictureUrl() }}" class="logo-user"/> <a class="message-link target" data-target-xhr="{{ route('message.show', $conversation->sendToUser->id) }}">{!! $conversation->sendToUser->name !!}</a>
            <br/>
            <i><small><span class="glyphicon glyphicon-ok"></span> {{ $conversation->getLastMessage->first()->content }}</small></i>
          </div>
        @endforeach
      @endif
    </div><!-- end .messages -->
  </div>
</div><!-- end .container -->