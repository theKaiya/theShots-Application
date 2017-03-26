@extends('header')

@section('title') {{ $user->username }} @endsection

@section('main')
<script>
var user = {
  id: {{ $user->id }},
  username: "{{ $user->username }}",
  is_followed: {{ $user->is_follow  }}
};

var allowed = '{!! implode(',', $user->sections) !!}'.split(',');

var section = '{!! $user->act !!}';
</script>

<div ng-controller="UserController">
      <!-- Profile head -->
      <div class="profile-head">
        <div class='page-links'>
        <div class="container">
          <a href="{{ $user->link }}"><img src="{{ $user->avatar }}" alt="avatar"></a>
          <h5><a href="{{ $user->link }}">{{ $user->username }}</a></h5>
          <p><i class="fa fa-map-marker"></i> {{ $user->location or 'Not specifed.' }}</p>
          <p class="lead">{{ $user->position }}</p>
          <p>{{ $user->about }}</p>
          <ul class="social-icons">
            @foreach ($user->social as $key => $social)
              @if($social->link)
              <li><a class="{{ $key }}" href="{{ $social->link }}"><i class="{{ $social->icon }}"></i></a></li>
              @endif
            @endforeach
          </ul>
          <Br>
          @include('components.follow_button')

          <div class="row bottom-bar">
            <div class='pull-left'>
              <ul class="col-sm-12 col-md-6 tab-list">
                @foreach($user->links as $section => $url)
                  <li ng-class="{'active': section == '{{ $section }}'}">
                    <a section-switcher ng-click="setSection('{{ $section }}');" href=""><i>{{ ucfirst($section) }}</i><span>{{ $url->count  }}</span></a>
                  </li>
                @endforeach
              </ul>
            </div>

            <div class="pull-right" ng-cloak>
              <div ng-if="section == 'shots' || section =='likes'">
                @include('components.shots_link_list')
              </div>

              <div ng-if="section == 'followers' || section =='followings'">
                @include('components.follows_link_list')
              </div>

            </div>
          </div>
        </div>
       </div>
      </div>
      <!-- END Profile head -->

      <!-- User shots -->
      <section class="no-border-bottom section-sm">
        <div class="container">
          <div class="row">

            <div ng-if='!items.spinner' ng-cloak>

              <div ng-show="section == 'shots' || section == 'likes'">
                @include('components.shots')
              </div>

              <div ng-show="section == 'followers' || section == 'followings'">
                @include('components.follows')
              </div>

              @include('components.empty')
            </div>
          </div>

          <nav class="text-center">

            <div ng-if='items.spinner || items.spinner_more'>
              @include('components.spinner')
            </div>

            @include('components.buttons')
          </nav>

        </div>
      </section>
      <!-- END User shots -->
</div>
@endsection

@section('footer')
<script src="/assets/js/controllers/userController.js"></script>
@endsection
