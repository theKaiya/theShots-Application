@extends('header')

@section('title') @endsection

@section('main')
<script>
var shot_id = {{ $id  }};
</script>

<div ng-controller='shotController'>

  <div class="spinner" ng-show='!isLoaded'>
    <span class="dot1"></span>
    <span class="dot2"></span>
    <span class="dot3"></span>
  </div>

  <div ng-if='isLoaded' ng-cloak>
    @include('shot.modal')
  </div>


</div>

@endsection

@section('footer')
<script src="/assets/js/controllers/shotController.js"></script>
@endsection
