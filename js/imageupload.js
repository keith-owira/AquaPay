//jslint browser: true, white: true, eqeq: true, plusplus: true, sloppy: true, vars: true/
//global $, console, alert, FormData, FileReader/




function selectImage(e) {
  $('#profileImage').css("color", "green");
  $('#user').attr('src', e.target.result);
  $('#user1').attr('src', e.target.result);
  $('#user').css('max-width', '550px');
}

$(document).ready(function (e) {

  var maxsize = 1500 * 1024; // 500 KB

  $('#max-size').html((maxsize/1024).toFixed(2));

  $('#upload-image-form').on('submit', function(e) {

    e.preventDefault();

    $('#message').empty();
    
    $.ajax({
      url: "login_action.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function(data)
      {
        $('#message').html(data);
      }
    });

  });

  $('#updatename').on('submit', function(e) {

    e.preventDefault();

    $.ajax({
      url: "login_action.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function(data)
      {
        if(data.localeCompare('success')){
          $('#message1').html('<div class="alert alert-success" role="alert">Profile info updated successfully.</div>');
        }  else {
            $('#message1').html('<div class="alert alert-danger" role="alert">Update failed. Please try again</div>');
        }
      }
    });

  });

 
  $('#profileImage').change(function() {

    $('#message').empty();

    var file = this.files[0];
    var match = ["image/jpeg", "image/png", "image/jpg", "image/gif", "image/webp", "image/tiff", "image/apng","image/avif","image/svg+xml"];

    if ( !( (file.type == match[0]) || (file.type == match[1]) || (file.type == match[2]) ) )
    {
      noPreview();

      $('#message').html('<div class="alert alert-warning" role="alert">Invalid image format. Only images accepted.</div>');

      return false;
    }

    if ( file.size > maxsize )
    {
      noPreview();

      $('#message').html('<div class=\"alert alert-danger\" role=\"alert\">The size of image you are attempting to upload is ' + (file.size/1024).toFixed(2) + ' KB, maximum size allowed is ' + (maxsize/1024).toFixed(2) + ' KB</div>');

      return false;
    }

    $('#upload-button').removeAttr("disabled");

    var reader = new FileReader();
    reader.onload = selectImage;
    reader.readAsDataURL(this.files[0]);

  });

  $('#updatepwd').on('submit', function(e) {

    e.preventDefault();

    $.ajax({
      url: "login_action.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function(data)
      {
        if(data.localeCompare('true')){
          $('#message2').html('<div class="alert alert-success" role="alert">Profile info updated successfully.</div>');
        } else if(data.localeCompare('wrongpwd')){
          $('#message2').html('<div class="alert alert-success" role="alert">Current Password is Incorrect.</div>');
        }else {
            $('#message2').html('<div class="alert alert-success" role="alert">Profile info updated successfully.</div>');
        }
        
      }
    });

  });





});