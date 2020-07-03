<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $task = $user
            ->tasks()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('index', [
            'tasks' => $task,
            'user' => $user,
        ]);
    }

    public function store(TaskRequest $request)
    {
        $task['name'] = $request->input('name');
        $task['user_id'] = $request->user()->id;
        Task::create($task);
        Session::flash('message', trans('message.added')); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        try{
            $task = Task::findOrFail($id);
        
            return view('update', [
                'task'=>$task,
            ]);
        } catch (ModelNotFoundException $e) {
            
            return view('404');
        }
        
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::find($id);
        $task->name = $request->name;
        $task->save();
        Session::flash('message', trans('message.updated')); 
        Session::flash('alert-class', 'alert-success'); 
        
        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        try{
            $task = Task::findOrFail($id);
            $task->delete();
            Session::flash('message', trans('message.deleted')); 
            Session::flash('alert-class', 'alert-success'); 
            return redirect()->route('tasks.index');
        } catch (ModelNotFoundException $e) {

            return view('404');
        }
    }

    /**
     * Change language
     */
    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }
}
