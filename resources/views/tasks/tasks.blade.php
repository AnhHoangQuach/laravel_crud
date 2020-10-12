@extends ('layouts.app')
@section('title')
    Todos List
@endsection

@section('content')
    <h1 class="text-center my-5">TODOS PAGE</h1>
    <!-- When success -->
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <div class="col-md-10">
            <div class="card card-default">
                <div class="card-header">
                    New Task
                </div>

                <div class="card-body">
                    <form action="/task/add" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        Name:
                        <input type="text" name="name" id="task-name" class="form-control">
                        Description:
                        <input type="text" name="description" id="task-desc" class="form-control"><br>
                        @foreach($listTags as $tag)
                            <input type="checkbox" name="tags[]" value="{{$tag->id}}"> {{$tag->name}} <br>
                        @endforeach
                        <br><button class="btn btn-primary" type="submit">Add Task</button>
                    </form>
                </div>
            </div>
            <div class="space"></div>
            <div class="card card-default">
                <div class="card-header">
                    Current Tasks
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($listTodo as $item)<tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->status}}</td>
                            <td>
                                @foreach($item->tags as $tag)
                                    <span class="badge badge-secondary">{{ $tag->name }}</span>
                                @endforeach
                            </td>
                            <td class="sort_form">
                                <a href="/task/show/{{ $item->id }}" class="btn btn-primary">Show</a>
                                <a href="/task/edit/{{ $item->id }}" class="btn btn-warning">Edit</a>
                                <form action="/task/delete/{{ $item->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            <td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
