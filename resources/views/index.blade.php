@extends('layouts.app')
@section('content')
   
<div class="panel-body">

    <!-- Display Validation Errors -->
    <div class="container mt-2">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <div class="row">
                    <div class="col-md-9">
                        <b>{{ trans('message.taskof') }} <span style="background:#949494; padding:0.5em;">{{$user->name}}</b></span>  
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <form action = "{{ route('logout') }}"  method="POST">
                                @csrf
                                <button type="submit" id="btn-submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> {{ trans('message.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="card-body">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                        {{ Session::get('message') }}
                    </p>
                @endif
                {{-- {{ $msg ?? '' }} --}}
                @include('common.errors')
                    <!-- New Task Form -->
            <form action="{{route('tasks.store')}}" method="post" id="formAdd" class="form-horizontal">
                @csrf
                
                <!-- Task Name -->
                <div class="row"></div>
                <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task </label>
                    <div class="col-sm-6">
                        <input type="text" name="name" id="task-name" class="form-control">
                    </div>
                </div>

                <!-- Add Task Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-success">
                            <i class="far fa-plus-square"></i> {{ trans('message.add') }}
                        </button>
                    </div>
                </div>
            </form>
                <!--List Task -->
            @if(count($tasks)>0)
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>{{ trans('message.task')}}</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $task->name }}</div>
                                </td>
                                <td>
                                    <!-- TODO: Delete Button -->
                                    <div class="row">
                                        <a href="{{route('tasks.edit',$task->id)}}" class="btn btn-primary">{{ trans('message.edit') }}</a>
                                        &nbsp;
                                        <form action = "{{route('tasks.destroy', $task->id)}}"  method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" id="btn-submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i> {{ trans('message.delete') }}
                                                </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif 
            </div>
          </div>
    </div>
</div>

@endsection