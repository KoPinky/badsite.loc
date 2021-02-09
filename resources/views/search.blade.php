<!-- resources/views/tasks.blade.php -->

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Task Form -->
        <form action="{{ url('sea') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
                    <input type="text" name="name" id="task-name" class="form-control">
            <!-- Add Task Button -->
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
        </form>
    </div>

    <!-- TODO: Current Tasks -->
    <!-- Create Task Form... -->

    <!-- Current Tasks -->
    @if (count($results) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Tasks
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Task</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <!-- Task Name -->
                            <td class="table-text">
                                    <div>{{$result['name']}}</div>

                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection

