<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\User;
use App\Models\Project;
use App\Models\Space;
use App\Models\Task;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::where([['user_id', '=', Auth::id()],['completed_at', '=', null]])->get();
        $completedTodos = Todo::where([['user_id', '=', Auth::id()],['completed_at', '!=', null]])->get();
        $deletedTodos = Todo::where([['user_id', '=', Auth::id()],['deleted_at', '!=', null]])->get();
        return view('admin.todos.index',compact('todos','completedTodos','deletedTodos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'deadline' => 'required',
            'title' => 'required',
            'priority' => 'required',
        ]);

        $space = Todo::create([
            'title' => $data['title'],
            'deadline' => $data['deadline'],
            'priority' => $data['priority'],
            'start' => Carbon::now(),
            'user_id' => Auth::id(),
        ]);

        if($space){
            Session::flash('success', 'Todo Created');
            return to_route('admin.todos.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'deadline' => 'required',
            'title' => 'required',
            'priority' => 'required',
        ]);
        $todo = Todo::where('id',$data['id'])->first();

        $result = $todo->update(
            [
                'title' => $data['title'],
                'deadline' => $data['deadline'],
                'priority' => $data['priority'],
            ]
        );

        if($result){
            Session::flash('success', 'Todo Updated');
            return to_route('admin.todos.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Todo::where('id',$id)->delete();
        if($delete){
            Session::flash('success', 'Todo Deleted');
            return to_route('admin.todos.index');
        }
    }

    public function updateStatus(Request $request)
    {
        $data = $request->validate([
            'todo_id' => 'required',
            'status' => 'required',
        ]);
        $todo = Todo::where('id',$data['todo_id'])->first();

        if($data['status']=='true'){
            $result = $todo->update(
                [
                    'completed_at' => Carbon::now(),
                ]
            );
        }
        if($data['status']=='false'){
            $result = $todo->update(
                [
                    'completed_at' => null,
                ]
            );
        }
        

        if($result){
            Session::flash('success', 'Todo Updated');
            return to_route('admin.todos.index');
        }
    }
}
