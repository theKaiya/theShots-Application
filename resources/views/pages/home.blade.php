@extends('header')

@section('main')
    <header class="site-header color-alt overlay-black bg-fixed" style="background-image: url(assets/img/bg-header.jpg)">
        <div class="container">
            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-8">
                <h1><strong>TheShots</strong></h1>
                <h4>Upload your design, we <strong>spread</strong> it online!</h4>
                <br>
                <p class="hidden-xs">Nullam at elementum risus. Quisque ornare hendrerit risus, sed cursus lectus accumsan eu. Suspendisse non ultrices urna. Aenean vel leo dictum, lobortis est non, sollicitudin lorem. Ut porta non orci ac varius. Donec convallis mi non leo posuere, non ultricies nunc consequat. Donec velit risus, ornare ac risus vitae.</p>
            </div>

            @if(!auth()->check())
            <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 header-form-wrapper">
                <form class="header-form visible">
                    <div class="form-group">
                        <input class="form-control input-lg" type="text" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <input class="form-control input-lg" type="text" placeholder="Email address">
                    </div>

                    <div class="form-group">
                        <input class="form-control input-lg" type="password" placeholder="Password">
                    </div>

                    <p class="small text-muted">You're accepting our <a href="#">terms and conditions</a> by clicking on register button.</p>
                    <br>

                    <div class="row">
                        <div class="col-xs-6">
                            <button class="btn btn-primary btn-block" type="submit">Register</button>
                        </div>
                        <div class="col-xs-6">
                            <a class="btn btn-link toggle-form-visibility" href="#">or LOGIN</a>
                        </div>
                    </div>
                </form>

                <form class="header-form form-second">
                    <div class="form-group">
                        <input class="form-control input-lg" type="text" placeholder="Username">
                    </div>

                    <div class="form-group">
                        <input class="form-control input-lg" type="password" placeholder="Password">
                    </div>

                    <p><a href="user-forget-pass.html">Forgot your password?</a></p>

                    <div class="row">
                        <div class="col-xs-6">
                            <button class="btn btn-primary btn-block" type="submit">Login</button>
                        </div>
                        <div class="col-xs-6">
                            <a class="btn btn-link toggle-form-visibility" href="#">or Register</a>
                        </div>
                    </div>

                    <hr>

                    <h6 class="text-uppercase no-margin-top text-center"><small>Login with</small></h6>
                    <div class="row">
                        <div class="col-xs-4">
                            <a class="btn btn-facebook btn-sm btn-block" href="#"><i class="fa fa-facebook"></i></a>
                        </div>

                        <div class="col-xs-4">
                            <a class="btn btn-twitter btn-sm btn-block" href="#"><i class="fa fa-twitter"></i></a>
                        </div>

                        <div class="col-xs-4">
                            <a class="btn btn-google btn-sm btn-block" href="#"><i class="fa fa-google"></i></a>
                        </div>
                    </div>
                </form>
            </div>

            @else
                <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 header-slider-wrapper">
                    <ul class="header-shot-slider">
                        @foreach($header_shots as $shot)
                            <li>
                                <a openmodal class="shot-modal-opener" data-id="{{ $shot->id  }}" href="">
                                    <img src="{{ $shot->preview_image  }}" alt="shot">
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </header>
        <!-- Staff pick -->
        <section>
            <div class="container">
                <header class="section-header">
                    <span>Featured</span>
                    <h2>Pick by staff</h2>
                    <p>Take a look at the best shots uploaded in the website selected by our community</p>
                </header>

                <div class="row">

                    <!-- Shot -->
                    @foreach($shots as $shot)
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="shot shot-small">
                                <div class="shot-preview" data-id="{{ $shot->id  }}">
                                    <a class="img" href="{{ $shot->link  }}"><img src="{{ $shot->preview_image  }}" alt=""></a>
                                    <span like data-id="{{ $shot->id  }}" data-type="shot" class="like {{ $shot->liked ? 'liked' : '' }}">{{ $shot->likes_count  }}</span>
                                    <span class="black-overlay" openmodal data-id="{{ $shot->id }}"></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- END Shot -->

                </div>

                <div class="text-center">
                    <br><br><br>
                    <a class="btn btn-primary btn-round" href="{{ Route('shots')  }}">See all.</a>
                </div>

            </div>
        </section>
        <!-- END Staff pick -->


        <!-- Features -->
        <section class="bg-white">
            <div class="container">

                <header class="section-header">
                    <span>features</span>
                    <h2>What we offered</h2>
                    <p>We're the best place for you to create your online portfolio, because of...</p>
                </header>


                <ul class="features">
                    <li>
                        <div class="icon"><i class="fa fa-globe"></i></div>
                        <h5>Huge Visitors</h5>
                        <p class="text-justify">Quisque ornare hendrerit risus, lectus accumsan suspendisse non ultrices urna aenean leo dictum, lobortis sollicitudin lorem.</p>
                    </li>

                    <li>
                        <div class="icon"><i class="fa fa-search"></i></div>
                        <h5>SEO Friendly</h5>
                        <p class="text-justify">Quisque ornare hendrerit risus, lectus accumsan suspendisse non ultrices urna aenean leo dictum, lobortis sollicitudin lorem.</p>
                    </li>

                    <li>
                        <div class="icon"><i class="fa fa-newspaper-o"></i></div>
                        <h5>We Advertise</h5>
                        <p class="text-justify">Quisque ornare hendrerit risus, lectus accumsan suspendisse non ultrices urna aenean leo dictum, lobortis sollicitudin lorem.</p>
                    </li>

                    <li>
                        <div class="icon"><i class="fa fa-user"></i></div>
                        <h5>Get followers</h5>
                        <p class="text-justify">Quisque ornare hendrerit risus, lectus accumsan suspendisse non ultrices urna aenean leo dictum, lobortis sollicitudin lorem.</p>
                    </li>

                    <li>
                        <div class="icon"><i class="fa fa-th"></i></div>
                        <h5>Portfolio page</h5>
                        <p class="text-justify">Quisque ornare hendrerit risus, lectus accumsan suspendisse non ultrices urna aenean leo dictum, lobortis sollicitudin lorem.</p>
                    </li>

                    <li>
                        <div class="icon"><i class="fa fa-heart"></i></div>
                        <h5>See likes</h5>
                        <p class="text-justify">Quisque ornare hendrerit risus, lectus accumsan suspendisse non ultrices urna aenean leo dictum, lobortis sollicitudin lorem.</p>
                    </li>
                </ul>


            </div>
        </section>
        <!-- END Features -->


        <!-- How it works -->
        <section>
            <div class="container">

                <div class="col-sm-12 col-md-6">
                    <header class="section-header text-left">
                        <span>Workflow</span>
                        <h3>How it works</h3>
                        <p></p>
                    </header>

                    <p>Nulla quis felis et orci luctus semper sit amet id dui. Aenean ultricies lectus nunc, vel rhoncus odio sagittis eu. Sed at felis eu tortor mattis imperdiet et sed tortor. Nullam ac porttitor arcu. Vivamus tristique elit id tempor lacinia. Donec auctor at nibh eget tincidunt. Nulla facilisi. Nunc condimentum dictum mattis.</p>
                    <p>Pellentesque et pulvinar orci. Suspendisse sed euismod purus. Pellentesque nunc ex, ultrices eu enim non, consectetur interdum nisl. Nam congue interdum mauris, sed ultrices augue lacinia in. Praesent turpis purus, faucibus in tempor vel, dictum ac eros. Maecenas imperdiet purus ac malesuada vulputate. In quis ultricies leo. Donec ipsum neque, cursus id consequat vitae, molestie in purus.</p>

                    <br><br>
                    <a class="btn btn-primary" href="page-typography.html">Learn more</a>
                </div>

                <div class="col-sm-12 col-md-6 hidden-xs hidden-sm">
                    <img class="center-block" src="assets/img/how-it-works.png" alt="how it works">
                </div>

            </div>
        </section>
        <!-- END How it works -->



        <!-- Facts -->
        <section class="no-border-bottom overlay-black" style="background-image: url(assets/img/bg-facts.jpg)">
            <div class="container">

                <div class="row">
                    <div class="counter color-alt col-md-3 col-sm-6">
                        <i class="fa fa-camera"></i>
                        <p><span data-from="0" data-to="6890" class="counted-before">{{ $shots_count }}</span>+</p>
                        <h6>Shots</h6>
                    </div>

                    <div class="counter color-alt col-md-3 col-sm-6">
                        <i class="fa fa-user"></i>
                        <p><span data-from="0" data-to="1200" class="counted-before">{{ $users_count  }}</span>+</p>
                        <h6>Members</h6>
                    </div>

                    <div class="counter color-alt col-md-3 col-sm-6">
                        <i class="fa fa-heart"></i>
                        <p><span data-from="0" data-to="36800" class="counted-before">{{ $likes_count  }}</span>+</p>
                        <h6>Likes</h6>
                    </div>

                    <div class="counter color-alt col-md-3 col-sm-6">
                        <i class="fa fa-comment"></i>
                        <p><span data-from="0" data-to="15400" class="counted-before">{{ $comments_count  }}</span>+</p>
                        <h6>Comments</h6>
                    </div>
                </div>

            </div>
        </section>
        <!-- END Facts -->
@endsection
