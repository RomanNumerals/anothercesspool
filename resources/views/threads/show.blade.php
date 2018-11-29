@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#"> {{ $thread->creator->name }} </a> posted:
                    {{ $thread->title }}
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($thread->replies as $reply)
                @include ('threads.reply')
            @endforeach
        </div>
    </div>

    @if (auth()->check())
         <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ $thread->path() . '/replies' }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" placeholder="Comments" rows="5"></textarea>
                    </div>

                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    @else
    <p class="text-center">Please <a href="{{ route('login') }}"> login</a> or <a href="{{ route('register') }}"> register</a> to post any comments.</p>
    @endif
</div>
@endsection
