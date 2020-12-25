<?php

namespace App\Http\Controllers\Admin;
use App\contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(){
        {
            $db = contact::Paginate(10);
            return view('admin.contact.list', ['db' => $db]);
        }
    }
    public function delcontact($id)
    {
        $del = contact::find($id)->delete();
        return redirect()->back()->with('msg','Xóa thành công');
    }
}
