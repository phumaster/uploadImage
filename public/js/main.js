
/*
* @ get Element
*/

function _(elm) {
  return document.getElementById(elm);
}

/*
* @ style loading process
*/

function loading() {
  this.show = function() {

  };

  this.hide = function() {

  };
}

/*
* @ popup object
*/

function popup() {

  /*
  * @ create new popup
  */

  this.create = function() {
    var div = document.createElement('DIV');
    var popupBg = document.createElement('DIV');

    div.setAttribute('id', 'popup');
    div.setAttribute('class', 'popup');
    popupBg.setAttribute('class', 'popup-bg');
    popupBg.setAttribute('id', 'popup-bg');
    document.body.appendChild(popupBg);
    document.body.appendChild(div);
  };

  /*
  *@ remove popup
  */
  this.remove = function() {
    var div = _('popup');
    var popupBg = _('popup-bg');
    document.body.removeChild(div);
    document.body.removeChild(popupBg);
  };

  /*
  * @ create and display HTML for profile picture popup
  */

  this.profilePicturePopup = function() {
    var div = _('popup');
    var text = '<div class="container">'
    +'<div class="row">'
    +'<div class="col-md-12">'
    +'<h4>Update profile picture</h4>'
    +'<div id="close-popup" onclick="popup.remove()" style="position: absolute; top: 0; right: 0; cursor: pointer">'
    +'<span class="glyphicon glyphicon-remove"></span>'
    +'</div>'
    +'<hr/>'
    +'<form action="'+document.querySelector('base[href]').href+'" method="post" enctype="multipart/form-data" id="change-profile-picture-form">'
    +'<input type="hidden" name="_token" value="'+document.querySelector('meta[name=csrf-token]').content+'">'
    +'<div class="response"></div>'
    +'<div class="form-group">'
    +'<label for="profile-picture">Upload a new photo</label>'
    +'<input type="file" name="image" id="profile-picture"/>'
    +'</div>'
    +'<div class="form-group">'
    +'<button class="btn btn-sm btn-main"><span class="glyphicon glyphicon-cloud-upload"></span> Upload</button>'
    +'</div>'
    +'</form>'
    +'<hr/>'
    +'<a href=""><h5><b>Or choose from album</b></h5></a>'
    +'</div>'
    +'</div><!-- end row -->'
    +'</div><!-- end container-->';
    div.innerHTML = text;
  };

  /*
  * @ create and display HTML changeCoverPhoto popup
  */

  this.coverPhotoPopup = function() {
    var div = _('popup');
    var text = '<div class="container">'
    +'<div class="row">'
    +'<div class="col-md-12">'
    +'<h4>Update cover photo</h4>'
    +'<div id="close-popup" onclick="popup.remove()" style="position: absolute; top: 0; right: 0; cursor: pointer">'
    +'<span class="glyphicon glyphicon-remove"></span>'
    +'</div>'
    +'<hr/>'
    +'<form action="'+document.querySelector('base[href]').href+'" method="post" enctype="multipart/form-data" id="change-cover-photo-form">'
    +'<input type="hidden" name="_token" value="'+document.querySelector('meta[name=csrf-token]').content+'">'
    +'<div class="response"></div>'
    +'<div class="form-group">'
    +'<label for="cover">Upload a new photo</label>'
    +'<input type="file" name="image" id="cover"/>'
    +'</div>'
    +'<div class="form-group">'
    +'<button class="btn btn-sm btn-main"><span class="glyphicon glyphicon-cloud-upload"></span> Upload</button>'
    +'</div>'
    +'</form>'
    +'<hr/>'
    +'<a href=""><h5><b>Or choose from album</b></h5></a>'
    +'</div>'
    +'</div><!-- end row -->'
    +'</div><!-- end container-->';
    div.innerHTML = text;
  };

  /*
  * @ show profilePicturePopup
  */

  this.profile = function() {
    this.create();
    this.profilePicturePopup();
  };

  /*
  * @ show coverPhotoPopup
  */

  this.cover = function() {
    this.create();
    this.coverPhotoPopup();
  };
}

function notification() {
  this.name = null;

  this.create = function() {
    var div = document.createElement('DIV');
    div.setAttribute('id', 'notification');
    div.style.display = 'none';
    div.style.position = 'fixed';
    div.style.bottom = '35px';
    div.style.left = '10px';
    document.body.appendChild(div);
    this.name = _('notification');
  }

  this.show = function() {
    this.name.style.display = 'block';
  }

  // working .... But I must sleep :((

  this.push = function(message, type = 'success') {
    this.show();
    var div = document.createElement('DIV');
    var str = document.createTextNode(message);
    if(type == 'success') {
      div.setAttribute('class', 'notification success');
    }else if(type == 'danger') {
      div.setAttribute('class', 'notification danger');
    }else if(type == 'info') {
      div.setAttribute('class', 'notification info');
    }else if(type == 'warning') {
      div.setAttribute('class', 'notification warning');
    }
    div.appendChild(str);
    this.name.appendChild(div);
    var name = this.name;
    setTimeout(function() {
      div.style.opacity = '0';
    }, 3000);
    setTimeout(function() {
      name.removeChild(div);
    }, 4000);
  }
  //this.create();
}

function message(url, content) {
  this.xhr = url;
  this.content = content;

  this.send = function(responseTo) {
    $.ajax({
      method:'POST',
      url: this.xhr,
      data: {'_token':$('meta[name=csrf-token]').attr('content'), 'content':this.content},
      success: function(response) {
        var data = JSON.parse(response);
        responseTo.find('.message-body')
          .append('<div><div class="r left"><div class="message-content">'+data.message+'</div><div class="clear-fix"></div></div></div>');
          if($('.uid'+data.reciever) != null) {
            $('.uid'+data.reciever).find('.row-message')
            .append('<div><div class="r left"><div class="author"><a href="#"><img src="'+data.avatar_url+'" class="logo-user"/></a></div><div class="message-content">'+data.message+'</div><div class="clear-fix"></div></div></div>');
          }
      }
    });
  };
}

function fire() {
  $(document).on('click', 'a[data-target-xhr].target', function(e) {
    $.ajax({
      method:'GET',
      url: $(this).attr('data-target-xhr'),
      cache:false,
      success: function(response) {
        $('#content').html(response);
      }
    });
  });
}

// initialize

var popup = new popup();
var notification = new notification();
var loading = new loading();
