<?php

namespace App\Models;

use Hamcrest\Arrays\IsArray;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
class users extends Model
{
    use HasFactory;
    protected $table = 'users';

    public function getAllUsers($filters=[], $keywords=null, $sortByArr =null, $perPage=0)
    {
        // DB::enableQueryLog();
        $users = DB::table('users')
        ->select('users.*','groups.name as group_name')
        ->join('groups','users.group_id','=','groups.id')
        ->where ('trash',0);
        $orderBy = 'users.created_at';
        $orderType = 'desc';

        if(!empty($sortByArr)&&is_array($sortByArr))
        {
            if(!empty($sortByArr['sortBy'])&& !empty($sortByArr['sortType']))
            {
                $orderBy = trim($sortByArr['sortBy']);
                $orderType = trim($sortByArr['sortType']);
            }
        }
        $users = $users->orderBy($orderBy,$orderType);

        if(!empty($users))
        {
            $users = $users->where($filters);
        }
        if(!empty($keywords))
        {
            $users = $users->where(function($query) use($keywords) {
                $query->orWhere('fullname','like','%'.$keywords.'%');
                $query->orWhere('email','like','%'.$keywords.'%');
            });
        }
        
        if(!empty($perPage))
        {
            $users = $users->paginate($perPage)->withQueryString();
        }else
        {
            $users = $users->get();
        }
        return $users;
    }
    public function addUser($data)
    {
        // DB::insert('INSERT INTO users (fullname,email,created_at) values (?, ?, ?)',$data);
        return DB::table($this->table)->insert($data);
    }
    public function getDetail($id)
    {
        return DB::select('SELECT * FROM '.$this->table.' WHERE id = ?',[$id]);
    }

    public function updateUser($dataUpdate,$id)
    {

        return DB::table($this->table)->where('id',$id)->update($dataUpdate);
    }
    public function deleteUser($id)
    {
        // return DB::delete('DELETE FROM '.$this->table.' where id = ?', [$id]);
        return DB::table($this->table)->where('id',$id)->delete();
    }
    public function learnQuery()
    {
        DB::enableQueryLog();
        // $test = DB::table('users');
        $sql = DB::getQueryLog();
        dd($sql);
    }
}
