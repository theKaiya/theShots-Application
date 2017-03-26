@extends('header')

@section('title') Settings @endsection

@section('main')
<div ng-app='App' ng-controller='Settings'>

<div class="page-links">
  <div class="container">
    <div class="pull-left">
      <ul class="link-list">
        <li><a ng-click="setSection('primary')"      ng-class="{'active': section == 'primary'}"      href="">Profile</a></li>
        <li><a ng-click="setSection('social')"       ng-class="{'active': section == 'social'}"       href="">Social medias</a></li>
        <li><a ng-click="setSection('notification')" ng-class="{'active': section == 'notification'}" href="">Notification</a></li>
        <li><a ng-click="setSection('security')"     ng-class="{'active': section == 'security'}"     href="">Security</a></li>
      </ul>
    </div>
  </div>
</div>

<section class="no-border-bottom section-sm">

  <header class="section-header" ng-show='loading'>
    <div class="spinner">
            <span class="dot1"></span>
            <span class="dot2"></span>
            <span class="dot3"></span>
    </div>
  </header>

  <div ng-show='!loading' ng-cloak>
    <div ng-show="section == 'primary'">
        @include('settings.primary')
    </div>

    <div ng-show="section == 'social'">
        @include('settings.social')
    </div>

    <div ng-show="section == 'notification'">
        @include('settings.notification')
    </div>

    <div ng-show="section == 'security'">
        @include('settings.security')
    </div>

  </div>

</section>

</div>
@endsection

@section('footer')
<script src="/assets/js/controllers/Settings.js"></script>
@endsection
