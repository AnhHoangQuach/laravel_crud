@extends('layouts.app')
@section('content')
    <h1 class="text-center my-5">Edit Todos</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Edit todo</div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-group">
                                @foreach($errors->all() as $error)
                                    <li class="list-group-item">
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="/task/update/{{ $item->id }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" value="{{ $item->name }}">
                        </div>
                        <div class="form-group">
                            <input name="description" class="form-control" value="{{$item->description }}"></input>
                        </div>
                        <div class="form-group">
                            <input name="status" class="form-control" value="{{$item->status }}"></input>
                        </div>
                        @foreach($tags as $tag)
                            <input type="checkbox" {{ $item->tags->contains($tag->id) ? 'checked' : '' }} value="{{$tag->id}}" name="tags[]"> {{$tag->name}}
                        @endforeach
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success">Update Todo</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="button_comeback">
                <a href="{{ route('tasks') }}" class="btn btn-success">Back</a>
            </div>
        </div>
    </div>
@endsection
