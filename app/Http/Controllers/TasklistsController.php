<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tasklist;

class TasklistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasklists = Tasklist::all();
        
        $data=[];
        if (\Auth::check()){
         $user = \Auth::user(); 
         $tasklists = $user->tasklists()->orderBy('created_at', 'desc')->paginate(10);
         
         $data = [
                'user' => $user,
               'tasklists' => $tasklists,
               ];
            //   $tasklists += $this->counts($user);
           return view('tasklists.index', ['tasklists' => $tasklists,]);
         }
        else{
        return view('welcome');
    }
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        if(\Auth::check()){
         $tasklist = new Tasklist;

        return view('tasklists.create', [
            'tasklist' => $tasklist,
        ]);  }
        
        else{
            return view('welcome');
            
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //  
    if (\Auth::check()){
        $this->validate($request, [
            'status'=>'required|max:10',
            'content'=>'required|max:191',
            ]);
            
        $request->user()->tasklists()->create([
            'content'=>$request->content,
            'status'=>$request->status,
            ]);
            
            return redirect('/');
    }else{
        return view('welcome');
    }
    }
    
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(\Auth::check()){
        $tasklist = Tasklist::find($id);

        return view('tasklists.show', [
            'tasklist' => $tasklist,
        ]);
        }
        else{
            return view('welcome');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::check()){
        $tasklist = Tasklist::find($id);

        return view('tasklists.edit', [
            'tasklist' => $tasklist,
        ]);
        }
        else{
            return view('welcome');
        }
        
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
        $this->validate($request,  [
            'status'=> 'required|max:10', 
            'content'=> 'required|max:255',
            ]);
        
        $tasklist = Tasklist::find($id);
        $tasklist->status = $request->status; 
        $tasklist->content = $request->content;
        $tasklist->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasklist = Tasklist::find($id);
        $tasklist->delete();

        return redirect('/');//
    }
}
