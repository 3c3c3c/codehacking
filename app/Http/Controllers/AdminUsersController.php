<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Role;

use App\Http\Requests\UsersRequest;

use App\Photo;

use App\Http\Requests\UsersEditRequest;

use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Auth;

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
    public function store(UsersRequest $request)  //note the custom 'UsersRequest' replaces the default 'Request'
    {
        //return $request->all(); //used temporarily to quickly check what is being posted from create form
       // User::create($request->all());  //quick test of save to database without photo
        //$input = $request->all(); //get everything posted from the form
        // if($request->file('photo_id')) {  //if there is a photo
        //     return 'Photo exists';        //quick print out if photo found nothing if not
        // }

        if(trim($request->password) == '') {   //if no password passed means do not update password ie. ignore it
            $input = $request->except('password');
        } else {                               //yes password passed so update it
            $input = $request->all();
            $input['password'] = bcrypt($request->password);  //encrypt the password that came in from form
        }

        if($file = $request->file('photo_id')) {                 //check there is a photo file
            $name = time() .$file->getClientOriginalName();      //append time to its name
            $file->move('images', $name); //create images folder in public if not already exist and put photo in it
            $photo = Photo::create(['file'=>$name]); //put photo new name into photo table column here called 'file'
            $input['photo_id'] = $photo->id; //also add the newly created photo id to the required form input field    
        }

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
        $user = User::findOrFail($id); //get the user with the passed in user id
        $roles = Role::lists('name', 'id')->all();  //get the roles from the roles table to populate the role selection
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)  //note the custom 'UsersRequest' replaces the default 'Request'
    { 
        
        $user = User::findOrFail($id); //grab the user by the supplied id
        //$input = $request->all(); //get the data posted over
        if(trim($request->password) == '') {   //if no password passed means do not update password ie. ignore it
            $input = $request->except('password'); //get data posted over without password field
        } else {                               //yes password passed so update it
            $input = $request->all();           //get data posted over with password field
            $input['password'] = bcrypt($request->password);  //encrypt the password that came in from form
        }

        if($file = $request->file('photo_id')) {              //check there is a photo selected
            echo $file;
            $name =  time() .$file->getClientOriginalName();  //add a current time in seconds to its name
            $file->move('images', $name);                     // take the newly named photo and put it in the public images folder
            $photo = Photo::create(['file'=>$name]);          //add a new photo to the photo table of same name as the new photo
            $input['photo_id'] = $photo->id;                  //update the form posted inputs with the new photo name
        }

        $user->update($input);  //do a database update on the required user

        return redirect('/admin/users');  //redirect back to list of users
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return 'Destroy method';  //quick check is posting to correct controller method
        //User::findOrFail($id)->delete();
        $user = User::findOrFail($id);
        unlink(public_path() .$user->photo->file); //deletes the user photo from public images
        $user->delete();                           //deletes the user

        Session::flash('deleted_user', 'User deleted successfully!'); //feedback message note the use statement above

        return redirect('/admin/users');
    }
}
