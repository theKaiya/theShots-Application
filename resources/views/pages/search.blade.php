@extends('header')

@section('main')
    <section class="no-border-bottom" ng-controller="SearchController">
        <div class="container">
            <header class="section-header">
                <div ng-show="!querySearch" ng-cloak>
                    <span>Search users and shots.</span>
                </div>

                <div ng-show="querySearch" ng-cloak>
                    <span>Search results for</span>
                    <h2 ng-bind="querySearch" style="display: block"></h2>
                </div>
            </header>

            <div id="faq-search" class="form-group">
                <i class="ti-search fa-flip-horizontal1"></i>
                <input type="text" class="form-control" placeholder="Type to search..." ng-model="querySearch" ng-keyup="updateSearchParam(querySearch)" maxlength="20">
            </div>

            <div class="page-links" ng-cloak>
                <div class="container">
                    <div class="pull-left">
                        <ul class="link-list">
                            <li><a section-switcher ng-click="setSection('shots')" ng-class="{active: section == 'shots'}" href="">Shots</a></li>
                            <li><a section-switcher ng-click="setSection('users')" ng-class="{active: section == 'users'}" href="">Users</a></li>
                        </ul>
                    </div>

                    <div class="pull-right">
                        <div ng-if="section == 'shots'">
                            @include('components.shots_link_list')
                        </div>

                        <div ng-if="section == 'users'">
                            @include('components.follows_link_list')
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" ng-cloak>

                <div ng-if="section == 'shots'"><br>
                    @include('components.shots')
                </div>

                <div ng-if="section == 'users'">
                    <br>
                    @include('components.follows')
                </div>

                <nav class="text-center">
                    <div ng-if="items.spinner || items.spinner_more">
                        @include('components.spinner')
                    </div>

                    @include('components.buttons')

                    @include('components.empty')
                </nav>
            </div>

        </div>
    </section>
@endsection

@section('footer')
    <script src="{{ asset('assets/js/controllers/SearchController.js')  }}"></script>
@endsection