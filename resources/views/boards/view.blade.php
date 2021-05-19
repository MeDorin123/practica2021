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
            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Assignment</th>
                            <th>Status</th>
                            <th>Date of creation</th>
                            
                            <th style="width: 40px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{$task->id}}</td>
                                <td>{{$task->name}}</td> 
                                <td>{{$task->description}}</td>
                                <td>{{$task->assignment}}</td>
                                <td>{{$task->status}}</td>
                                <td>{{$task->created_at}}</td>
                                <td>
                                    <div class="btn-group">
                                       
                                        <button class="btn btn-xs btn-primary"
                                                type="button"
                                                data-task="{{json_encode($task)}}"
                                                data-user="{{json_encode($user)}}"
                                                data-board="{{json_encode($board)}}"
                                                data-toggle="modal"
                                                data-target="#TaskEditModalAjax"
                                               >
                                            <i class="fas fa-edit"></i></button>
                                        <button class="btn btn-xs btn-danger"
                                                type="button"
                                                data-task="{{json_encode($task)}}"
                                                data-user="{{json_encode($user)}}"
                                                data-board="{{json_encode($board)}}"
                                                data-toggle="modal"
                                                data-target="#TaskDeleteModal">
                                            <i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
                  <!-- /.card -->
    
        
          <div class="modal fade" id="TaskEditModalAjax" tabindex="-1" role="dialog" aria-hidden="true" >
            <div class="modal-dialog" >
            
                <div class="modal-content" >
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Task</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="alert alert-danger hidden" id="TaskEditAlert"></div>
                    <div id="TaskEditName"></div>


                             <input type="hidden" name="id" id="TaskEditId" value="" />

                             
                             
                    <label for="TaskEditNameInput">Name</label>
                             <input type="text" name="TaskEditNameInput" class="form-control" id="TaskEditNameInput" value="" />
                    <label for="TaskEditDescription">Description</label>
                             <input type="text" name="TaskEditDescription"  class="form-control" id="TaskEditDescription" value="" />
                    
                                   
                                    <label for="AssignmentEditTask">Assignment</label>
                            
                            
                                    <div class="PentruSelectAsignari" class="form-control" >
                <select class="custom-select rounded-0" id="AssignmentEditTask" value=''>
            
           
                @foreach($users as $selectUser)

                <option  @isset($task->assignment) @if($selectUser->id===$task->assignment) selected="selected" @endif @endisset >{{$selectUser->name}}</option>


                
                @endforeach
                </select>
 
</div>


                    <label for="TaskEditStatus">Status</label>
                             <input type="Text" name="Status" class="form-control" id="TaskEditStatus" value="" />

                  


                             <input type="hidden" name="id" id="IdUserCareACreatBoard" value="" />
        
                <!-- /.form-group -->
           
                                       
                    </div>
              
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="TaskEditButton" >Save changes</button>
                    </div>
                </div>
            </div>
        </div>

<!-- Aici se termina modalul TaskEdit -->
<div class="modal fade" id="TaskDeleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Task</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger hidden" id="TaskDeleteAlert"></div>
                        <input type="hidden" id="TaskDeleteId" value="" />
                        <input type="hidden" name="id" id="IDCreatorDelete" value="" />
                        <p>Are you sure you want to delete: <span id="TaskDeleteName"></span>?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="TaskDeleteButton">Delete</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

<!-- Aici se termina modalul TaskDelete -->




   


    </section>
    <!-- /.content -->
@endsection