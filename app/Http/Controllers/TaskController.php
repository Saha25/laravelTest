<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('new-task');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:255',
        ]);
    }

    /**
     * Create a new task instance after a valid registration.
     *
     * @param  array  $data
     * @return Task
     */
    protected function create(array $data)
    {
        return Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
    }

    public function save(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

        return redirect('home');
    }

    public static function getTaskList()
    {
        $tasks = DB::table('tasks')
                ->orderBy('done', 'asc')
                ->orderBy('updated_at', 'desc')
                ->get();

        return $tasks;
    }

    public function getTask(Request $request)
    {
        $data = $request->all();

        $task = DB::table('tasks')
                ->where('id', '=', $data["task-id"])
                ->first();

        return view('edit-task', ['task' => $task]);
    }

    public function delete(Request $request)
    {
        $data = $request->all();

        DB::table('tasks')
                ->where('id', '=', $data["task-id"])
                ->delete();

        $tasks = $this->getTaskList();

        return view('task-list', ['tasks' => $tasks]);
    }

    public function markDone(Request $request)
    {
        $data = $request->all();

        DB::table('tasks')
                ->where('id', '=', $data["task-id"])
                ->update(['done' => 1]);

        $tasks = $this->getTaskList();

        return view('task-list', ['tasks' => $tasks]);
    }

    public function updateTask(Request $request)
    {
        $data = $request->all();

        DB::table('tasks')
                ->where('id', '=', $data["task-id"])
                ->update(['title' => $data["title"], 'description' => $data["description"], 'updated_at' => date('Y-m-d H:i:s', time())]);

        return redirect('home');
    }

    public static function search(Request $request)
    {
        $data = $request->all();

        $tasks = DB::table('tasks')->orderBy('done', 'asc')
                ->orderBy('updated_at', 'desc')
                ->where('title', 'like', '%'.$data["search"].'%')
                ->orWhere('description', 'like', '%'.$data["search"].'%')
                ->get();

        return view('search', ['tasks' => $tasks]);
    }
}