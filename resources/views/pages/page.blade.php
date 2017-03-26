@extends('header')

@section('title') {{ $page->title  }}  @endsection

@section('main')
    <section class="bg-white">
        <div class="container">
            <header class="section-header">
                <h2>{{ $page->title  }}</h2>

                @if($page->slogan)
                    <p>{{ $page->slogan  }}</p>
                @endif

            </header>

            {!! $page->text  !!}

        </div>
    </section>
@endsection