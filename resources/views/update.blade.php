@extends('layouts.app')
@section('content')

<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">{{ trans('message.task') }} {{ $task['name'] }}</div>
                <div class="card-body">
                    <!-- Update Task Form -->
                    <form action="{{ route('tasks.update', $task->id) }}"  class="form-horizontal" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task" class="col-sm-3 control-label">{{ trans('message.task') }}</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" value ="{{ $task['name'] }}" class="form-control">
                            </div>
                        </div>
            
                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-plus"></i> {{ trans('message.update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection