<form id="upload-image-form" action="" method="post" enctype="multipart/form-data">
              <input type="text" name="uid" value="<?php echo $details['userID']; ?>" hidden>
              <div class="card-body mediam align-items-center">
                  <div id="image-preview-div">
                <img id="preview-img" src="<?php if(isset($_SESSION['img'])){
                  if($_SESSION['img']!=''){
                    echo $_SESSION['img'];
                  }else {
                    echo "../../assets/img/user.png";
                  }
                }else {
                  echo "../../assets/img/user.png";
                }
                 ?>" alt="" class="d-block ui-w-80">
               </div>

              </div>
              <div class="card-body media align-items-center">
                <div class="media-body ml-4" >
                  <label class="btn btn-outline-primary">
                    Upload new photo
                    <input type="file" name="file" id="file" required class="account-settings-fileinput">
                  </label> &nbsp;
                    <button class="btn btn-primary" id="upload-button" type="submit" disabled>Save</button>

                  <div class="text-muted small mt-1">Allowed JPEG, PNG, JPG, GIF, WEBP, TIFF, JFIF, APNG,AVIF or SVG+XML. Max size of <span id="max-size"></span> KB.</div>

                  <div class="alert alert-info" id="loading" style="display: none;" role="alert">
                    Uploading image...
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                      </div>
                    </div>
                  </div>
                  <div id="message"></div>
                </div>
              </div>
              <hr class="border-light m-0">
            </form>