<div class="container">
  <header class="section-header">
    <span>Settings</span>
    <h3>Social medias profiles</h3>
    <p>Update your facebook, twitter, linkedin, etc. address</p>
  </header>

  <div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <h6>Social pages</h6>
        </div>

        <div class="card-block">
          <form class="form-horizontal">
            <div ng-repeat='(network, social) in user.social'>
              <div class="form-group">
                <label for="input6" class="col-sm-2 control-label">
                  <p class='uf' ng-bind='network'></p>
                </label>
                <div class="col-sm-6">
                  <input type='text' class="form-control" ng-model='social.full_link'>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-6">
                <button class="btn btn-primary btn-sm" type="submit" ng-click='update()'>Save changes</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>

</div>
