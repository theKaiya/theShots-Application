<div ng-if='!items.spinner && !items.spinner_more && !items.get().sign_in_to_continue' ng-show='items.get().last_page > items.get().page' ng-cloak>
  <a ng-click='getContent(true)' class="btn btn-primary btn-round" href="">Load more</a>
</div>

<div ng-if="items.get().sign_in_to_continue && items.get().last_page > items.get().page" ng-cloak>
  <a class="btn btn-info btn-round" href="/login?back={{ Request()->fullUrl() }}">Sign in to continue.</a>
</div>
