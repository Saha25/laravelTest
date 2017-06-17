<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Task list</div>
                @foreach ($tasks as $task)
                	<div
                	@if ($task->done == 1)
                		data-done="true"
                	@endif
                	@if (Cookie::get('doneIsHidden') !== null)
            			class="hidden"
            		@endif
                	>
	                    <h1>{{ $task->title }}</h1>
	                    <p>{{ $task->description }}</p>
	                    <a href="{{ route('delete-task') }}" class="ajaxSubmit" data-submit="delete-task-form-{{ $task->id }}">
	                        Delete
	                    </a>
	                    <form id="delete-task-form-{{ $task->id }}" action="{{ route('delete-task') }}" method="POST" data-url="{{ route('delete-task') }}" data-response="taskList">
	                        {{ csrf_field() }}
	                        <input type="hidden" name="task-id" value="{{ $task->id }}"/>
	                    </form>
	                    <a href="{{ route('edit-task') }}" onclick="event.preventDefault();document.getElementById('edit-task-form-{{ $task->id }}').submit();">
	                        Edit
	                    </a>
	                    <form id="edit-task-form-{{ $task->id }}" action="{{ route('edit-task') }}" method="GET">
	                        {{ csrf_field() }}
	                        <input type="hidden" name="task-id" value="{{ $task->id }}"/>
	                    </form>
	                    @if ($task->done == 0)
		                    <a href="{{ route('done-task') }}" class="ajaxSubmit" data-submit="done-task-form-{{ $task->id }}">
		                        Mark as done
		                    </a>
		                    <form id="done-task-form-{{ $task->id }}" action="{{ route('done-task') }}" method="POST" data-url="{{ route('done-task') }}" data-response="taskList">
		                        {{ csrf_field() }}
		                        <input type="hidden" name="task-id" value="{{ $task->id }}"/>
		                    </form>
	                   @endif
	                </div>
                @endforeach
            <div class="panel-body">
            </div>
        </div>
    </div>
</div>