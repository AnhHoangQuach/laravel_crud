@extends('layouts.app')
@section('content')
    <h1 class="text-center my-5">{{ $task->name }}</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    Details
                </div>
                <div class="card-body">
                    Description: {{ $task->description }} <br>
                    Status: {{ $task->status }} <br>
                    Tags:
                    @foreach($task->tags as $tag)
                        <span class="badge badge-secondary">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="button_comeback">
                <a href="{{ route('tasks') }}" class="btn btn-success">Back</a>
            </div>
        </div>
    </div>
@endsection
