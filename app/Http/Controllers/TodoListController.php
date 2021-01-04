<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function list()
    {
        return TodoList::orderBy('id', 'desc')->get();
    }

    public function delete($id)
    {
        TodoList::findorFail($id)->delete();
        return response()->json('Deleted');
    }

    public function taskComplete(Request $request)
    {
        $item = TodoList::find($request->id);
        $item->status == '0' ? $item->status = 1 : $item->status = 0;
        $item->save();
        return response()->json('taskComplete' . $item->status);
    }

    public function add(Request $request)
    {
        $request->validate([
            'task' => 'required',
        ]);
        $data['task'] = $request->task;
        $data['status'] = 0;
        TodoList::create($data);
        $message = 'Created';
        return response()->json($message);
    }
}
