<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use App\http\Resources\TodoResource;
use App\Http\Requests\TodoRequest;


class TodoappController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //     $user = Auth::user(); //apiではAuth使えない
        $userId = $request->user()->id;
        if (isset($userId)) {
            $todos = Todo::where('user_id', $userId)->paginate(3);
        } else {
            $todos = [];
        }
        $todos->userName = $request->user()->name;
        // dd(TodoResource::collection($todos));
        return TodoResource::collection($todos);
        // return new TodoResource($todos);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = new Todo;
        $form = $request->todo;
        $todo->user_id = $request->user()->id;
//        unset($form['_token']);
        $todo->fill($form)->save();
        return response()->json([]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $item = Todo::findOrFail($id);
        return new TodoResource($item);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        $form = $request->todo;
        // unset($form['_token']);
        $todo->fill($form)->save();
        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::destroy($id);
        return response()->json([
            "message" => "records deleted"
          ]);
    }
}
