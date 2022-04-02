<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\users;
use DB;

class userController extends Controller
{
    public function __construct()
    {
        $this->user = new users();
    }
    const __PER_PAGE = 4;
    public function index(Request $request)
    {
        $title = 'USERS';
        $user = new users();
        $filters =[];
        $keywords =[];
        if(!empty($request->status))
        {
            $status = $request->status;
            if($status=='active')
            {
                $status = 1;
            }else{
                $status = 0;
            }
            $filters[] = ['users.status','=',$status];
        }
        if(!empty($request->group_id))
        {
            $group_id = $request->group_id;
            $filters[] = ['users.group_id','=',$group_id];
        }
        if(!empty($request->keywords))
        {
            $keywords = $request->keywords;
        }
        // Xử lý logic sắp xếp
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');
        $allowSort = ['asc','desc'];

        if(!empty($sortType) && in_array($sortType,$allowSort))
        {
            if($sortType =='desc')
            {
                $sortType = 'asc';
            }else{
                $sortType = 'desc';
            }
        } else{
            $sortType = 'asc';
        }
        $sortArr = [
            'sortBy'=>$sortBy,
            'sortType'=> $sortType,
        ];
        $userList = $this->user->getAllUsers($filters,$keywords,$sortArr,self::__PER_PAGE);

        return view('clients.users.list',compact('title','userList','sortType'));
    }
    public function add()
    {
        $title = 'Thêm người dùng';
        $group = getAllGroup();
        return view('clients.users.add',compact('title','group'));
    }
    public function postAdd(UserRequest $request)
    {
        $title = 'Thêm người dùng';
        $dataInsert = [
            'fullname'=> $request->fullname,
            'email'=> $request->email,
            'group_id'=> $request->group_id,
            'status'=> $request->status,
            'created_at' => date('Y-m-d, H:i:s')
        ];
        $this->user->addUser($dataInsert);
        return redirect()->route('users.index')->with('msg','Thêm người dùng thành công');
    }

    public function getEdit(request $request, $id)
    {
        $title = 'Cập nhật người dùng';
        $group = getAllGroup();
        if(!empty($id))
        {
            $userDetail = $this->user->getDetail($id);
            if(!empty($userDetail[0]))
            {
                $request->session()->put('id', $id);
                
                $userDetail = $userDetail[0];
            }
            else{
                return redirect()->route('users.index')->with('msg','Không tồn tại người dùng');
            }
        }else{
            return redirect()->route('users.index')->with('msg','Liên kết không tồn tại');
        }
        return view('clients.users.edit',compact('title','userDetail','group'));
    }

    public function postEdit( UserRequest $request)
    {
        $id = session('id');
        if(empty($id))
        {
            return back()->with('msg','Liên kết không tồn tại');
        }
        
        $dataUpdate = [
            'fullname'=> $request->fullname,
            'email'=> $request->email,
            'group_id'=> $request->group_id,
            'status'=> $request->status,
            'updated_at' => date('Y-m-d, H:i:s'),
        ];
        $this->user->updateUser($dataUpdate,$id);
        
        return back()->with('msg','Cập nhật người dùng thành công');
    }
    public function getDelete($id)
    {
        $userDetail = $this->user->getDetail($id);
        if(!empty($userDetail[0]))
        {
            $deleteStatus = $this->user->deleteUser($id);
            if($deleteStatus)
            {
                $msg = 'Xóa người dùng thành công';
            }else{
                $msg = 'Không thể xóa người dùng được. Vui lòng thử lại sau';
            }
        }
        else
        {
            $msg = 'Người dùng không tồn tại';
        }
        return back()->with('msg',$msg);
    }
    public function getQuery()
    {
        $value = $this->user->learnQuery();
    }
}
