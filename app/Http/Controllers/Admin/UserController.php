<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $arrRoles = ['admin','editor', 'member'];

    public function index(Request $request)
    {
        $data = User::orderBy('user_id','DESC');

        if ($request->has('keyword') && !empty($request->keyword)) { // tìm theo keyword
            $data = $data->where(function($query) use ($request){
                $query->orWhere('username', 'LIKE', '%'.$request->keyword.'%');
                $query->orWhere('email', 'LIKE', '%'.$request->keyword.'%');
                $query->orWhere('fullname', 'LIKE', '%'.$request->keyword.'%');
            });
        }

        if ($request->has('role') && !empty($request->role)) {
            $data = $data->Where('role', ''.$request->role.'');
        }

        $data = $data->paginate(config('app.paginate'));

        $this->data['input'] = $request->all();
        $this->data['users'] = $data;

        return view('admin.user.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $user = User::find($id);
        if(!$user) return redirect()->route('admin.user.index')->with('message', ['msg' => trans('admin.user.not_found'), 'status' => 'danger']);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if(!$user) 
            return redirect()->route('admin.user.index')->with('message', ['msg' => trans('admin.user.not_found'), 'status' => 'danger']);
        else if(Auth::user()->role == 'admin' && $user->role == 'superadmin'){ // admin không thể sửa tài khoản sáng lập
            return redirect()->back()->with('message', ['msg' => trans('admin.user.can_not_edit_supperadmin'), 'status' => 'danger']);
        }else if(Auth::user()->role == 'admin' && !in_array($request->role, $this->arrRoles)){ // là admin không thể set mình lên super
            return redirect()->back()->with('message', ['msg' => trans('admin.user.you_are_out_of_authority'), 'status' => 'danger']);
        }

        if($request->has('avatar')){ // nếu có avatar
            $file = $request->avatar;
            $img =  time() . $file->getClientOriginalName();
            $file->move('uploads/avatars',$img);
            $avatar = 'uploads/avatars/'.$img;
            $user->avatar = $avatar;
            $user->save();
        }

        if($request->has('role')){ // nếu có chọn quyền
            $user->role = $request->role;
            $user->save();
        }

        if($request->has('password') && !empty($request->password)){ // nếu có password
            $user->password = bcrypt($request->password);
            $user->save();
        }

        $user->update($request->except(['password','password_confirmation','avatar']));

        return redirect()->route('admin.user.index')->with('message', ['msg' => trans('admin.user.edit_success'), 'status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $user = User::find($id);
  
        if (!$user) {
            return redirect()->route('admin.user.index')->with('message', ['msg' => trans('admin.user.not_found'), 'status' => 'warning']);
        } else if($id == Auth::id()) { // không thể xóa chính mình
            return redirect()->route('admin.user.index')->with('message', ['msg' => trans('admin.user.can_not_remove_yourself'), 'status' => 'warning']);
        }  else if($user->role == 'superadmin') { // không thể xóa sáng lập
            return redirect()->route('admin.user.index')->with('message', ['msg' => trans('admin.user.can_not_remove_superadmin'), 'status' => 'warning']);
        } 

        User::destroy($id); // xóa nè
        return redirect()->route('admin.user.index')->with('message', ['msg' => trans('admin.user.del_success'), 'status' => 'success']);
    }
}
