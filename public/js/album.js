function loadAlbum() {
  $('.album .image-preview img').height($('.album').height());
  $('.album .image-preview img').width($('.album').width());

  $('.album .image-preview').each(function() {
    if($(this).children('img').length > 1) {
      $(this).children('img:gt(0)').hide();
      var time;
      $(this).parent().hover(function() {
        var fun = $(this);
        time = setTimeout(function() {
          fun.children('.image-preview').children('img:first-child').fadeOut('slow').next('img').fadeIn('slow').end().appendTo(fun.children('.image-preview'));
        }, 700);
      }, function() {
        clearTimeout(time);
      });
    }else if($(this).children('img').length < 1){
      $(this).parent().css({'background':'#fff', 'border':'1px solid rgba(0,0,0,0.15)'}).find('.image-preview').html('<div class="text-danger text-center" style="padding-top: 50px"><h4>No photos in this album</h4></div>')
      .parent().parent().find('.album-body').css('background', '#222');
    }
  });

  $('.dropdown-menu-option').click(function() {
    $(this).children('.album-menu-option').toggleClass('show');
  });
}
