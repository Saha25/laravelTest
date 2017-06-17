@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="{{ route('new-task') }}">
                        New task
                    </a>
                    <br/>
                    <a href="#" id="hideDone"
                    @if (Cookie::get('doneIsHidden') === null)
                        style="display:none;"
                    @endif
                    >
                        Hide done
                    </a>
                    <a href="#" id="showDone"
                    @if (Cookie::get('doneIsHidden') !== null)
                        style="display:none;"
                    @endif
                    >
                        Show done
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
    <div id="taskList">
        @include('task-list');
    </div>
</div>
@endsection
