<div ng-cloak>
    <span ng-if="user.id == auth.id">
        <a class="btn btn-info btn-sm" href="/settings">Settings</a>
    </span>
    
    <span ng-if="user.id != auth.id">
      <a
      follow
      data-id='@{{ user.id }}'
      ng-class="user.is_follow ? 'btn' : 'btn-outline btn' "
      class="btn-success btn-sm btn"
      href="">@{{ user.is_follow ? 'Followed.' : 'Follow.' }}</a>
    </span>
</div>
