<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h1 class="text-primary">Todo App</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{route('saveTodo')}}" method="post">
                            @csrf
                                <div class="row mb-5">
                                {{-- <div class="form-group"> --}}
                                    <div class="col-md-10">
                                        @if ($todoData != null)
                                        {{-- @method('PUT') --}}
                                        <input type="hidden" name="todoId" value="{{$todoData->Id}}">
                                        <input type="text" class="form-control" name="description" id="description" value="{{$todoData->Description}}">
                                        @else
                                        <input type="text" class="form-control" name="description" id="description">
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-success">
                                           {{$todoData != null ? 'Update' : 'Save'}}
                                        </button>
                                    </div>
                                {{-- </div> --}}
                            </div>
                            </form>
                            
                        <div class="row">
                           
                            @foreach ($todoList as $item)
                                @if ($todoData != null)
                                    @if ($todoData->Id != $item->Id)
                                        <div class="row mr-2 p-1">
                                            <div class="col-md-1">
                                            <form action="{{route('todocolor',['id' => $item->Id])}}" method="post" id="colorform_{{$item->Id}}" >
                                                @csrf
                                                @method('PUT')
                                                <input type="color" onchange="SubmitColor(this)" class="form-control" name="color" id="input_{{$item->Id}}" value="{{$item->Color}}">
                                            </form>
                                            </div>
                                            <div class="col-md-1">
                                            {{-- <button class="btn btn-info btn-sm">Done</button> --}}
                                            @if ($item->IsDone != 1)
                                                <a href="{{route('todoUpdateStatus', ['id' => $item->Id])}}" class="btn btn-info btn-sm">Done</a>
                                            @endif
                                            </div>
                                            <div class="col-md-8 border" 
                                            style="background-color: {{$item->Color}}; {{$item->IsDone == 1 ? 'text-decoration:line-through;' : ''}}">
                                           <span class="h6 font-weight-bold">
                                               {{ $item->Description }}
                                            </span> 
                                            </div>
                                            <div class="col-md-1 ">

                                            @if ($item->IsDone != 1)
                                            {{-- <button class="btn btn-primary btn-sm">Edit</button> --}}
                                            <a href="{{route('todoapp' , ['id' => $item->Id])}}" class="btn btn-primary btn-sm">Edit</a>
                                            @endif
                                            </div>
                                            <div class="col-md-1">
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="row mr-2 p-1">
                                        <div class="col-md-1">
                                            <form action="{{route('todocolor',['id' => $item->Id])}}" method="post" id="colorform_{{$item->Id}}" >
                                                @csrf
                                                @method('PUT')
                                                <input type="color" onchange="SubmitColor(this)" class="form-control" name="color" id="input_{{$item->Id}}" value="{{$item->Color}}">
                                            </form>
                                        </div>
                                        <div class="col-md-1">
                                            {{-- <button class="btn btn-info btn-sm">Done</button> --}}
                                            @if ($item->IsDone != 1)
                                                <a href="{{route('todoUpdateStatus', ['id' => $item->Id])}}" class="btn btn-info btn-sm">Done</a>
                                            @endif
                                        </div>
                                        <div class="col-md-8 border" 
                                            style="background-color: {{$item->Color}}; {{$item->IsDone == 1 ? 'text-decoration:line-through;' : ''}}">
                                           <span class="h6 font-weight-bold">
                                               {{ $item->Description }}
                                            </span> 
                                        </div>
                                        <div class="col-md-1 ">
                                            @if ($item->IsDone != 1)
                                            {{-- <button class="btn btn-primary btn-sm">Edit</button> --}}
                                            <a href="{{route('todoapp' , ['id' => $item->Id])}}" class="btn btn-primary btn-sm">Edit</a>
                                            @endif
                                        </div>
                                        <div class="col-md-1">
                                            {{-- <button class="btn btn-danger btn-sm">Delete</button> --}}
                                            <a href="{{route('deleteTodoItem' , ['id' => $item->Id])}}" class="btn btn-danger btn-sm">Delete</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        function SubmitColor(value) {
            // console.log(value);
            let element = value.id;
            let parent = document.getElementById(element).parentElement;
            // console.log(parent);
            document.getElementById(parent.id).submit();
        }
    </script>
</body>
</html>