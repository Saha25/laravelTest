@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="{{ route('home') }}">
                        Task list
                    </a>
                    <form id="search" action="{{ route('search') }}" method="GET">
                        {{ csrf_field() }}
                        <input id="search" type="text" class="form-control" name="search" required>
                        <button>Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Result</div>
                @foreach ($tasks as $task)
                    <div>
                        <h1>{{ $task->title }}</h1>
                        <p>{{ $task->description }}</p>
                        <p>{{ $task->done }}</p>
                        <p>{{ $task->updated_at }}</p>
                    </div>
                @endforeach
            <div class="panel-body">
            </div>
        </div>
    </div>
</div>
</div>
@endsection
