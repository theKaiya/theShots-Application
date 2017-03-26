@extends('header')

@section('main')
    <div ng-controller="ShotsController">
    <!-- Page links -->
    <div class="page-links">
        <div class="container">
            <div class="pull-left">
                <ul class="link-list">
                    <li><a ng-click="setSection('recent')" ng-class="{active: section == 'recent'}" href="">Recent</a></li>
                    <li><a ng-click="setSection('gaining')" ng-class="{active: section == 'gaining'}" href="">Gaining popularity</a></li>
                    <li><a ng-click="setSection('popular')" ng-class="{active: section == 'popular'}" href="">Popular</a></li>
                @if(auth()->check())
                        <li><a ng-click="setSection('followings')" ng-class="{active: section == 'followings'}" href="">Followings</a></li>
                    @endif

                </ul>
            </div>

            <div class="pull-right">
                <ul class="link-list">
                        @include('components.shots_link_list')
                </ul>
            </div>
        </div>
    </div>
    <!-- END Page links -->


    <!-- Shots list -->
    <section class="no-border-bottom section-sm">
        <div class="container">
            <div class="row">

                <div ng-if='!items.spinner' ng-cloak>
                    @include('components.shots')
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
    </div>
    <!-- END Shots list -->
@endsection

@section('footer')
    <script src="{{ asset('assets/js/controllers/ShotsController.js')  }}"></script>
@endsection
