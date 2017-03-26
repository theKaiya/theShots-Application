@extends('header')

@section('title') Login @endsection

@section('main')
    <section class="no-border-bottom section-sm">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
                    <div class="card">
                        <div class="card-header">
                            <h6>Sign up</h6>
                        </div>

                        <div class="card-block">
                            <br>
                            @include('errors.errors')
                            <form action="{{ Route('sign_up_action')  }}" method="POST">
                                <div class="form-group">
                                    <input name="username" class="form-control input-lg" type="text" placeholder="Username" required>
                                </div>

                                <div class="form-group">
                                    <input name="email" class="form-control input-lg" type="text" placeholder="Email address" required>
                                </div>

                                <div class="form-group">
                                    <input name="password" class="form-control input-lg" type="password" placeholder="Password" required>
                                </div>

                                @if($terms)
                                    <p class="small text-muted">You're accepting our <a href="{{ Route('page', $terms->slug)  }}">terms and conditions</a> by clicking on following button.</p>
                                @endif

                                <br>
                                {{ csrf_field()  }}
                                <button class="btn btn-primary btn-block" type="submit">Register</button>
                            </form>
                        </div>

                        <div class="card-footer">
                            <a href="{{ Route('sign_in') }}">Already a member?</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
