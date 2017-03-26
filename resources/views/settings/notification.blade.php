<div class='container'>

<header class="section-header">
  <span>Settings</span>
  <h3>Notification settings</h3>
  <p>Let us know when you'd like to receive email notification</p>
</header>

<div class="row">
  <div class="col-xs-12">
    <div class="card">
      <div class="card-header">
        <h6>Send an email notification when...</h6>
      </div>

      <div class="card-block">
        <form>
          <div class="checkbox checkbox-switch">
            <label>
              <input
              type="checkbox"
              ng-model='user.settings.notify.new_comment_to_shot'
              ng-true-value="1"
              ng-false-value="0"
              />
              Someone comment on your shot
            </label>
          </div>

          <div class="checkbox checkbox-switch">
            <label>
              <input type="checkbox" ng-model='user.settings.notify.new_follower' ng-true-value="1" ng-false-value="0"/>
              Someone started following you
            </label>
          </div>

          <div class="checkbox checkbox-switch">
            <label>
              <input type="checkbox" ng-model='user.settings.notify.new_shot_from_following' ng-true-value="1" ng-false-value="0"/>
              New shot from your followings
            </label>
          </div>

          <div class="checkbox checkbox-switch">
            <label>
              <input type="checkbox" ng-model='user.settings.notify.new_newsletters' ng-true-value="1" ng-false-value="0"/>
              New newsletters
            </label>
          </div>


          <br>
          <button class="btn btn-primary btn-sm" type="submit" ng-click="update()">Save changes</button>

        </form>
      </div>
    </div>
  </div>

</div>

</div>
