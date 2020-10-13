<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
use Auth;

class TaskController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {

        $listTodo = Auth::user()->tasks;
        $listTags = Tag::all();
        return view('tasks.tasks')->with(['listTodo' => $listTodo, 'listTags' => $listTags]);
    }

    public function addPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'tags' => 'required',
        ]);
        if($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->user_id = Auth::user()->id;
        $task->save();

        // mass assign
//        $task = Task::create($request->all());
        $task->tags()->sync($request->get('tags'));

        session()->flash('success', 'Todo created successfully.');
        return redirect('/task');
    }

    public function showPost($id)
    {
//        $task = auth()->user()->tasks()->findOrFail($id);
        /*nếu không muốn trả về 404 thì*/
        if(!auth()->user()->tasks()->where('id',$id)->exists()) {
            return redirect('/task');
        }
        $task = auth()->user()->tasks()->find($id);
//        $task= Task::findOrFail($id);
        return view('tasks.show')->with('task', $task);
    }

    public function edit($id)
    {
//        $item = Task::find($id);
        $item = Auth::user()->tasks()->find($id);
        return view('tasks.edit')->with(['item' => $item, 'tags' => Tag::all()]);
    }

    public function updatePost(Task $task, Request $request) {
        $input = $request->all();
        $task->find($task->id)->update($input);

        $task->tags()->sync($request->get('tags'));
        session()->flash('success', 'Todo updated successfully.');
        return redirect('/task');
    }

    public function deletePost(Task $task)
    {
        $task->delete();
        session()->flash('success', 'Todo deleted successfully.');
        return redirect('/task');
    }
}
