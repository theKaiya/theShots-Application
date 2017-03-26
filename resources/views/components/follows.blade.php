<div ng-repeat='user in items.get().items'>
<div ng-if='style.follows == 1'>
  <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="user-widget-mini">
                  <a href="@{{ user.link }}" data-turbolinks="true"><img ng-src="@{{ user.avatar }}" alt="avatar"></a>
                  <h5><a href="@{{ user.link }}" ng-bind='user.username' data-turbolinks="true"></a></h5>
                  <p class="lead" ng-bind='user.position'></p>
                  <small ng-bind='user.shots_count_diff'></small>
                </div>
  </div>
</div>

<div ng-if='style.follows == 2'>
  <div class="col-xs-12 col-sm-6 col-md-4">
              <div class="card user-widget">
                <div class="card-block text-center" style="height: 277px;">
                  <a href="@{{ user.link }}" data-turbolinks="true"><img width='128' ng-src="@{{ user.avatar }}" alt="avatar"></a>
                  <h5><a href="@{{ user.link  }}" ng-bind='user.username' data-turbolinks="true"></a></h5>
                  <p class="lead" ng-bind='user.position'></p>
                  <small ng-bind='user.about_small'></small>
                  <br>
                    @include('components.follow_button')
                  <br>
                </div>

                <div class="card-footer">
                  <ul class="user-stats">
                    <li ng-repeat="(key, value) in user.links | objectLimit: 3">
                      <a href="@{{ value.link }}" data-turbolinks="true"><i>@{{ key  }}</i><span ng-bind='value.count'></span></a>
                    </li>
                  </ul>
                </div>
              </div>
  </div>
</div>
</div>