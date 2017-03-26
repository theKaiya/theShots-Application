<div class="container">
  <header class="section-header">
    <span>Settings</span>
    <h3>Profile settings</h3>
    <p>Change your name, avatar, location, description, etc.</p>
  </header>

  <div class="row">
    <div class="col-xs-12 col-sm-8">
      <div class="card">
        <div class="card-header">
          <h6>Profile</h6>
        </div>

        <div class="card-block">
          <form class="form-horizontal">

            <div class="form-group">
              <label for="input2" class="col-sm-2 control-label">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="input2" ng-model='user.username' disabled>
              </div>
            </div>

            <div class="form-group">
              <label for="input3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="input3" ng-model='user.email' disabled>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="input4" class="col-sm-2 control-label">Headline</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="input4" ng-model='user.position'>
              </div>
            </div>

            <div class="form-group">
              <label for="input5" class="col-sm-2 control-label">Location</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="input5" ng-model='user.location'>
              </div>
            </div>

            <div class="form-group">
              <label for="input6" class="col-sm-2 control-label">Description</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="4" id="input6" ng-model='user.about'></textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-primary btn-sm" type="submit" ng-click='update()'>Save changes</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-sm-4">
      <div class="card">
        <div class="card-header">
          <h6>Avatar</h6>
        </div>

        <div class="card-block">
          <form method="post" enctype="multipart/form-data">
            <div class="dropify-wrapper has-preview"><div class="dropify-message"><span class="file-icon"></span> <p>Drag and drop a file here or click</p><p class="dropify-error">Ooops, something wrong appended.</p></div><div class="dropify-loader" style="display: none;"></div><div class="dropify-errors-container"><ul></ul></div><input type="file" class="dropify" data-default-file="assets/img/avatar-2.jpg" data-max-height="150" data-max-width="150"><button type="button" class="dropify-clear">Remove</button><div class="dropify-preview" style="display: block;"><span class="dropify-render"><img src="assets/img/avatar-2.jpg"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner">avatar-2.jpg</span></p><p class="dropify-infos-message">Drag and drop or click to replace</p></div></div></div></div>
            <br>
            <button class="btn btn-primary btn-sm" type="submit">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
