<div ng-repeat='item in items.get(section).items'>
<div ng-if="style.shots == 1" class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
  <div class="shot">
    <div openmodal class="shot-preview" data-id='@{{ item.id }}' data-url="@{{ item.link }}">
      <a class="img" href=""><img ng-src="@{{ item.preview_image }}" alt=""></a>
      <h5 class="title"><a href="shot-gallery.html" ng-bind='item.title'></a></h5>
    </div>

    <div class="shot-detail">
      <div class="shot-info">
        <a href="@{{ item.link  }}"><img ng-src="@{{ item.user.avatar }}" alt="avatar"></a>
        <h6><a href="@{{ item.user.link }}" ng-bind='item.user.username'></a></h6>
        <time time data-date="@{{ item.time.original }}"></time>
      </div>

      <ul class="shot-stats">
        <li><i class="fa fa-eye"></i><span ng-bind='item.views_count'></span></li>
        <li><a href="shot-gallery.html#comments"><i class="fa fa-comments"></i><span ng-bind='item.comments_count'></span></a></li>
        <li><a like data-id="@{{ item.id }}" data-type="shot" class="like" href=""><i class="fa" ng-class="item.liked ? 'fa-heart' : 'fa-heart-o'"></i><span ng-bind='item.likes_count'></span></a></li>
      </ul>
    </div>
 </div>
</div>

<div ng-if='style.shots == 2 || style.shots == 3'>
  <div class="col-xs-12 col-sm-6" ng-class="{'col-md-4': style.shots == 2}">
    <div class="shot shot-small">
      <div class="shot-preview">
        <a openmodal data-id='@{{ item.id }}' data-url="@{{ item.link }}" class="img" href=""><img ng-src="@{{ item.preview_image }}" alt=""></a>
        <span data-id='@{{ item.id }}' data-type="shot" like ng-class="{'liked': item.liked}" class="like" ng-bind="item.likes_count"></span>
      </div>

      <div class="shot-info">
        <a href="@{{ item.user.link }}"><img ng-src="@{{ item.user.avatar }}" alt="avatar"></a>
        <h6><a href="@{{ item.user.link }}" ng-bind='item.user.username'></a></h6>
        <p><time time data-date="@{{ item.time.original }}"></time></p>
      </div>
    </div>
 </div>
</div>
</div>