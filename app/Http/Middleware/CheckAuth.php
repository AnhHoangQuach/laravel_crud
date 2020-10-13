<?php

namespace App\Http\Middleware;

use App\Models\Task;
use Closure;
use Auth;
use Illuminate\Http\Request;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        //tách chuỗi dựa vào dấu /
        $arr = explode('/', $request->path());

        // lấy phần tử cuối cùng tức là id
        $id = array_pop($arr);

        //tìm task có id là ... và lấy user_id
        $task_user_id = Task::findOrFail($id)->user_id;

        //so sánh user id đang đăng nhập có = vs user_id của task k
        //nếu k thì về trang idex
        if(Auth::id() != $task_user_id) {
            return redirect('/task');
        }
        return $next($request);
    }
}
