@extends('layout.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Board view</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('boards.all')}}">Boards</a></li>
                        <li class="breadcrumb-item active">Board</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$board->name}}</h3>
            </div>

            <div class="card-body">
                <select class="custom-select rounded-0" id="changeBoard">
                    @foreach($boards as $selectBoard)
                        <option @if ($selectBoard->id === $board->id) selected="selected" @endif value="{{$selectBoard->id}}">{{$selectBoard->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- /.card -->

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Task list</h3>
                
            </div>

<div class="ButtonAddTask">
      
   
 <button
type="button"
class="btn btn-block btn-success" 
style="width:104px;height:35px;position:absolute; right:95px;top:30px;

-moz-border-radius: 15px;
-webkit-border-radius: 15px;
border-radius: 15px;"
@foreach ($tasks as $task) 
let task = button.data('task');
@endforeach
data-target="#ButtonTaskAddModal"
data-toggle="modal">


<i class="fas fa-plus" style="position:relative;right:5px;font-size:14px;"></i>
 Add Task</button> 

</div>



    <div class="card-body">
        <div class="modal fade" id="ButtonTaskAddModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add task</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger hidden" id="taskAddAlert"></div>

                         <div class="form-group">
                            <label for="taskAddBoard_Id">Board</label>
                         
                            <select class="custom-select rounded-0" id="taskAddBoard_Id">
                                
                               
                                @foreach ($Allboards as $selectBoard)
                                    <option value="{{$selectBoard->id}}">{{$selectBoard->name}}</option>
                                @endforeach
                            </select>
                        </div>
                       
                       
                        <div class="form-group">
                            <label for="taskAddName">Name</label>
                            <input type="text" class="form-control" id="AddTaskName" placeholder="Name task">
                        </div>
                        <div class="form-group">
                            <label for="taskEditDescription">Description</label>
                            <textarea class="form-control" id="AddTaskDescription" placeholder="Description"></textarea>
                        </div> 
                        <div class="form-group">
                            <label for="taskEditAssignment">Assignment</label>
                            <select class="custom-select rounded-0" id="AddTaskAssignment">
                                <option value="">Unassigned</option>
                                @foreach ($boardUsers as $boardUser)
                                    <option value="{{$boardUser->user_id}}">{{$boardUser->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="AddTaskStatus">Status</label>
                            <select class="custom-select rounded-0" id="AddTaskStatus">
                                <option value="0">Created</option>
                                <option value="1">In progress</option>
                                <option value="2">Done</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="AddTaskSave">Save task</button>
                    </div>
                </div>
            </div>
        </div>



                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Assignment</th>
                            <th>Status</th>
                            <th>Create Date</th>
                            <th style="width: 40px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{$task->name}}</td>
                                <td>{{$task->description}}</td>
                                <td>{{$task->assignment ? $task->user->name : '-'}}</td>
                                <td> @if ($task->status === \App\Models\Task::STATUS_CREATED)
                                        <span class="badge bg-warning">Created</span>
                                    @elseif ($task->status === \App\Models\Task::STATUS_IN_PROGRESS)
                                        <span class="badge bg-primary">In progress</span>
                                    @else
                                        <span class="badge bg-success">Done</span>
                                    @endif
                                </td>
                                <td>{{$task->created_at->format('j M Y H:i:s')}}</td> 
                             
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary"
                                                type="button"
                                                data-task="{{json_encode($task)}}"
                                                data-toggle="modal"
                                                data-target="#taskEditModal">
                                            <i class="fas fa-edit"></i></button>
                                        @if ($board->user->id === \Illuminate\Support\Facades\Auth::user()->id || \Illuminate\Support\Facades\Auth::user()->role === \App\Models\User::ROLE_ADMIN)
                                            <button class="btn btn-sm btn-danger"
                                                    type="button"
                                                    data-task="{{json_encode($task)}}"
                                                    data-toggle="modal"
                                                    data-target="#taskDeleteModal">
                                                <i class="fas fa-trash"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    @if ($tasks->currentPage() > 1)
                        <li class="page-item"><a class="page-link" href="{{$tasks->previousPageUrl()}}">&laquo;</a></li>
                        <li class="page-item"><a class="page-link" href="{{$tasks->url(1)}}">1</a></li>
                    @endif

                    @if ($tasks->currentPage() > 3)
                        <li class="page-item"><span class="page-link page-active">...</span></li>
                    @endif
                    @if ($tasks->currentPage() >= 3)
                        <li class="page-item"><a class="page-link" href="{{$tasks->url($tasks->currentPage() - 1)}}">{{$tasks->currentPage() - 1}}</a></li>
                    @endif

                    <li class="page-item"><span class="page-link page-active">{{$tasks->currentPage()}}</span></li>

                    @if ($tasks->currentPage() <= $tasks->lastPage() - 2)
                        <li class="page-item"><a class="page-link" href="{{$tasks->url($tasks->currentPage() + 1)}}">{{$tasks->currentPage() + 1}}</a></li>
                    @endif

                    @if ($tasks->currentPage() < $tasks->lastPage() - 2)
                        <li class="page-item"><span class="page-link page-active">...</span></li>
                    @endif

                    @if ($tasks->currentPage() < $tasks->lastPage() )
                        <li class="page-item"><a class="page-link" href="{{$tasks->url($tasks->lastPage())}}">{{$tasks->lastPage()}}</a></li>
                        <li class="page-item"><a class="page-link" href="{{$tasks->nextPageUrl()}}">&raquo;</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- /.card -->

        <div class="modal fade" id="taskEditModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit task</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger hidden" id="taskEditAlert"></div>
                        <input type="hidden" id="taskEditId" value="" />
                        <div class="form-group">
                            <label for="taskEditName">Name</label>
                            <input type="text" class="form-control" id="taskEditName" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="taskEditDescription">Description</label>
                            <textarea class="form-control" id="taskEditDescription" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="taskEditAssignment">Assignment</label>
                            <select class="custom-select rounded-0" id="taskEditAssignment">
                                <option value="">Unassigned</option>
                                @foreach ($boardUsers as $boardUser)
                                    <option value="{{$boardUser->user_id}}">{{$boardUser->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taskEditStatus">Status</label>
                            <select class="custom-select rounded-0" id="taskEditStatus">
                                <option value="0">Created</option>
                                <option value="1">In progress</option>
                                <option value="2">Done</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="taskEditButton">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="taskDeleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete task</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger hidden" id="taskDeleteAlert"></div>
                        <input type="hidden" id="taskDeleteId" value="" />
                        <p>Are you sure you want to delete: <span id="taskDeleteName"></span>?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="taskDeleteButton">Delete</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </section>
    <!-- /.content -->
@endsection