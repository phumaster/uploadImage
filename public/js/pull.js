function pullRequest() {
  /* send request to server */
  var xhr = $.ajax({
    method: 'POST',
    url: 'pull?random_key='+Math.floor(Math.random()*10),
    data: {'_token':$('meta[name=csrf-token]').attr('content')},
    success: function(response) {
      /* pull request */
      pullRequest();
    },
  }); /* end ajax */
  $('a[href]').click(function() {
    xhr.abort();
  });
} /* end function pullRequest */

$(function() {
  // pullRequest();
  // setTimeout('pullRequest()', 2000);
});
