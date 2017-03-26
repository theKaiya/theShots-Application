<section class="no-border-bottom section-sm">
  <div class="container-fluid">
    <header class="section-header">
      <h3 ng-bind='shot.title'></h3>
      <p>Posted on @{{ shot.posted_on }} for <a href="@{{ shot.user.link }}" ng-bind='shot.user.username'></a></p>
    </header>

    <div class="row">
      <div class="col-xs-12 col-md-8">

        <!-- Shot and details -->
        <div class="card no-margin-top">
          <div class="card-block">

            <ul class="image-gallery" lightgallery>

              <li data-thumb="@{{ picture.link  }}" data-src="@{{ picture.link  }}" ng-repeat="picture in shot.images">
                <img ng-src="@{{ picture.link  }}" alt="thumb">
              </li>

            </ul>

            <hr>

            <p ng-bind='shot.description'></p>

          </div>
        </div>
        <!-- END Shot and details -->


        <!-- Comments -->
        <div id="comments" class="card">
          <div class="card-header">
            <h6>Comments (@{{ shot.comments.length }})</h6>

            <div class="comment-pagination">
              <a ng-show='!paginator.first_page()' ng-click="paginator.page_back()" class="prev" href=""><i class="ti-angle-left"></i></a>
              <a ng-show='!paginator.last_page() && paginator.has_items()'  ng-click="paginator.page_forward()" class="next" href=""><i class="ti-angle-right"></i></a>
            </div>
          </div>

          <ul class="comments">
            <li ng-repeat='comment in shot.comments | startFrom: paginator.starting_item() | limitTo: paginator.per_page'>
              <a href="@{{ comment.user.link }}"><img ng-src="@{{ comment.user.avatar }}" alt=""></a>
              <h6>
                  <a href="@{{ comment.user.link }}" ng-bind='comment.user.username'></a>

                  <ul class="shot-stats" style="display: block">
                      <li>
                        <a like data-id="@{{ comment.id }}" data-type="comment" class="like" href="">
                          <i class="fa" ng-class="comment.liked ? 'fa-heart' : 'fa-heart-o'"></i>
                          <span ng-bind="comment.likes_count"></span>
                        </a>
                      </li>
                  </ul>

                  <time time data-date="@{{ comment.time.original }}"></time>
              </h6>
              <p ng-bind='comment.message'></p>
            </li>
          </ul>

          <form class="comment-form" comment>
            <img ng-src="{{ Auth()->check() ? u()->avatar : '/assets/images/guest.png' }}" alt="">
            <p><input ng-model='comments.comment' type="text" class="form-control" placeholder="Leave a comment..." required></p>
          </form>

        </div>
        <!-- END Comments -->

      </div>

      <aside class="col-xs-12 col-md-4 shot-sidebar">
        <!-- User widget -->
        <div class="sidebar-block">
          <div class="shot-by-widget">
            <a href="@{{ shot.user.link }}"><img ng-src="@{{ shot.user.avatar }}" alt="avatar"></a>
            <a class="username" href="@{{ shot.user.link }}" ng-bind='shot.user.username'></a>
            <p class="title"    ng-bind='shot.user.position'></p>
            <p class="subtitle" ng-bind='shot.user.about_small'></p>

            <div ng-if='loader.user_info'>
              @include('components.spinner')
            </div>

            <div>
              <ul class="user-stats">
                <div ng-repeat="(key, value) in shot.user.links | objectLimit : 3">
                  <li>
                      <a href="@{{ value.link }}"><i>@{{ key  }}</i><span ng-bind='value.count'></span></a>
                  </li>
                </div>
              </ul>

              @include('components.follow_button')
            </div>
          </div>
        </div>
        <!-- END User widget -->


        <!-- Shot stats -->
        <div class="sidebar-block">
          <ul class="single-shot-stats">
            <li><i class="fa fa-eye"></i><span ng-bind='shot.views_count'></span></li>
            <li><a like data-id='@{{ shot.id }}' data-type="shot" class="like" href=""><i class="fa" ng-class="shot.liked ? 'fa-heart' : 'fa-heart-o'"></i><span ng-bind='shot.likes_count'></span></a></li>
          </ul>
        </div>
        <!-- END Shot stats -->


        <!-- Details -->
        <!--
        <div class="sidebar-block">
          <h6>Details</h6>
          <dl class="half-half">
            <dt>Size</dt>
            <dd>5472 x 3648</dd>

            <dt>Open Shot</dt>
            <dd><a openmodal data-id='4' href=''>Shot</a></dd>

            <dt>File type</dt>
            <dd>Jpeg</dd>

            <dt>Aspect Ratio</dt>
            <dd>4:3</dd>

            <dt>Location</dt>
            <dd>Denmark</dd>

            <dt>License</dt>
            <dd>GPL</dd>

          </dl>
        </div>
        -->
        <!-- END Details -->


        <!-- Tags -->


        <div class="sidebar-block" ng-show="shot.tags">
          <h6>Tags</h6>
          <div class="tag-list">
            <a href="#" ng-repeat='tag in shot.tags track by $index' ng-bind='tag'></a>
          </div>
        </div>


        <!-- END Tags -->


        <!-- Share -->
        <div class="sidebar-block">
          <h6>Share on</h6>
          <ul class="social-icons text-center">
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
          </ul>
        </div>
        <!-- END Share -->


        <!-- More shots -->
        <!--
        <div class="sidebar-block">
          <h6>More from @{{ shot.user.username }}</h6>
          <ul class="photo-list cols-2">
            <li ng-repeat="s in related">
              <a href="" openmodal data-id="@{{ related.id }}"><img ng-src="@{{ s.preview_image.preview }}" alt=""></a>
            </li>
          </ul>
        </div>
        -->
        <!-- END More shots -->


      </aside>
    </div>
  </div>
</section>