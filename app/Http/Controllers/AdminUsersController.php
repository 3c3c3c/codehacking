<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Role;

use App\Http\Requests\UsersRequest;

use App\Photo;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles =  Role::lists('name', 'id')->all(); //note the order to suit our needs for select ie. name then id
        //return $roles;
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //return $request->all(); //used temporarily to quickly check what is being posted from create form
       // User::create($request->all());  //quick test of save to database without photo
        $input = $request->all(); //get everything posted from the form
        // if($request->file('photo_id')) {  //if there is a photo
        //     return 'Photo exists';        //quick print out if photo found nothing if not
        // }

        if($file = $request->file('photo_id')) {                 //check there is a photo file
            $name = time() .$file->getClientOriginalName();      //append time to its name
            $file->move('images', $name); //create images folder in public if not already exist and put photo in it
            $photo = Photo::create(['file'=>$name]); //put photo new name into photo table column here called 'file'
            $input['photo_id'] = $photo->id; //also add the newly created photo id to the required form input field    
        }

        $input['password'] = bcrypt($request->password);  //encrypt the password that came in from form
        User::create($input);  //save form input to database with photo if there and password encryption

        return redirect('/admin/users'); //returns to users index to list all users
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
