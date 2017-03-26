@extends('header')

@section('title') Login @endsection

@section('main')
<section class="no-border-bottom section-sm">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
              <div class="card">
                <div class="card-header">
                  <h6>Sign in</h6>
                </div>

                <div class="card-block">
                  <br>
                  @include('errors.errors')
                  <form action="{{ Route('sign_in_action') }}" method="post">
                    <div class="form-group">
                      <input name='usernameOrEmail' class="form-control input-lg" type="text" placeholder="Username or Email">
                    </div>

                    <div class="form-group">
                      <input name='password' class="form-control input-lg" type="password" placeholder="Password">
                    </div>
                    {{ csrf_field() }}
                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                  </form>
                  <br>
                </div>

                <div class="card-footer">
                  <div class="row text-center">
                    <div class="col-xs-6">
                      <a href="user-register.html">Register</a>
                    </div>

                    <div class="col-xs-6">
                      <a href="user-forget-pass.html">Forget password?</a>
                    </div>
                  </div>
                </div>

              </div>

              <div class="card">
                <div class="card-block">
                  <h6 class="text-uppercase no-margin-top"><small>Login with</small></h6>
                  <div class="row">
                    <div class="col-xs-6">
                      <a class="btn btn-facebook btn-sm btn-block" href="#"><i class="fa fa-facebook"></i> Facebook</a>
                    </div>

                    <div class="col-xs-6">
                      <a class="btn btn-twitter btn-sm btn-block" href="#"><i class="fa fa-twitter"></i> Twitter</a>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
</section>
@endsection
