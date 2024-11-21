<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class TodoController extends Controller
{
    function ShowTodo($id = null){
        
        $todoItem = null;
        $todolist = null;
        try {
            if($id != null && $id > 0){
                $todoItem = DB::table('todo_item')->where('Id' , '=' , $id)->where('IsDeleted' , '=' , 0)->first();
                // dd($todoItem);
            }

            $todolist = DB::table('todo_item')->where('IsDeleted' , '=' , 0)->get();
            // dd($todolist);
        } catch (Exception $ex) {
            dd($ex);
        }

        return view('welcome', ['todoList' => $todolist , 'todoData' => $todoItem]);
    }

    function SaveTodo(Request $request){
        // dd($request->all());
        $todoId = $request->input('todoId');
        try {
            if($todoId != null && $todoId > 0){
                DB::table('todo_item')->where('Id', '=', $todoId)->update([
                    'Description' => $request->input('description'),
                    'UpdatedOn' => Carbon::now(),
                ]);
            }else{
                DB::table('todo_item')->insert([
                    'Description' => $request->input('description'),
                    'Color' => '#f2619b',
                ]);
            }
        } catch (Exception $ex) {
           dd($ex);
        }
        return redirect(route('todoapp'));
        
    }

    function TodoSaveColor(Request $request , $id){
        // dd($request->all() , $id);
        try {
            DB::table('todo_item')->where('Id' , '=' , $id)
            ->update(['Color' =>$request->input('color')]);
        } catch (Exception $ex) {
            dd($ex);
        }
        return redirect(route('todoapp'));
    }

    function TodoUpdateStatus($id){
        // dd($id);
        try {
            if($id > 0){
                DB::table('todo_item')->where('Id' , '=' , $id)
                ->update(['IsDone' =>  1]);
            }
        } catch (Exception $ex) {
            dd($ex);
        }
        return redirect(route('todoapp'));
    }

    function Tododelete($id){

        try {
            if($id > 0){
                DB::table('todo_item')->where('Id' , '=' , $id)
                ->update(['IsDeleted' => 1]);
            }
           
        } catch (Exception $ex) {
            dd($ex);
        }
        return redirect(route('todoapp'));
    }
}
