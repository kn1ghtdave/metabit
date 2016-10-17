@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Task
            </div>
            <div class="panel-body">
                <form action="{{ url('/my_tasks_add') }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="task-name" class="col-sm-3 control-label">
                            Task
                        </label>

                        <div class="col-sm-6">
                            <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}">
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-plus">
                                    Add Task
                                </i>
                            </button>
                        </div>
                        
                    </div>

                </form>
            </div>
        </div>

        @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Tasks
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Tasks</th>
                        <th>&nbsp;</th>
                    </thead>

                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="table-text"><div>{{ $task->name }}</div></td>
                                <td>
                                    <form method="POST" action="{{ url('my_tasks_del/' . $task->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        
                                        <button type="submit" class="btn btn-danger" id="delete-task-{{ $task->id }}">
                                            <i class="fa fa-btn fa-trash">
                                                Delete
                                            </i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        @endif
    </div>


@endsection
