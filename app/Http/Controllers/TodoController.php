<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    //一覧表示
    public function showList()
    {
        return view('todo.list');
    }

    //作成
    public function showCreate()
    {
        $user = Auth::user();
        return view('todo.form');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showEdit($id)
    {
        return view('todo.edit');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('todos'));
    }
}
