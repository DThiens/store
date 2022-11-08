<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\productRequest;
use Illuminate\Support\Facades\Validator;

class homeController extends Controller
{
    public $data = [];
    public function index()
    {
        return view('clients.home');
    }
    public function products()
    {
        return view('clients.product');
    }
    public function getAdd()
    {
        $this->data['title'] = 'Thêm sản phẩm';
        // $this->data['errorMessage'] = 'Vui lòng kiểm tra lại';
        return view('clients.add',$this->data);
    }

    public function postAdd(Request $request)
    {
        // dd($request->all());
        
        $rule = [
            'product_name' => 'required|min:6',
            'product_price'=> 'required|integer',
        ];
        $message = [
            'required' => ':attribute bắt buộc nhập',
            'min' => ':attribute không được nhỏ hơn :min',
            'integer' => ':attribute là số nguyên',
        ];
        $attributes = [
            'product_name'=> 'Tên sản phẩm',
            'product_price'=> 'Giá sản phẩm',
        ];
        // $request->validate($rule,$message);
        $Validator = Validator::make($request->all(), $rule, $message, $attributes);

        $Validator->validate();
        
        return response()->json(['status'=>'success']);
        // if($Validator->fails())
        // {
        //     $Validator->errors()->add('mgs', 'Vui lòng kiểm tra lại dữ liệu, dữ liệu không hợp lệ');
        // }
        // else
        // {
        //     return redirect()->route('product')->with('msg','Thêm mới thành công');
        // }
        // return back()->withErrors($Validator);
    }

    public function downloadImage(Request $request)
    {
        if(!empty($request->image))
        {
            $image = trim($request->image);
            $fileName = basename($image);
           
            return response()->streamDownload(function() use ($image)
            {
                $imageContent = file_get_contents($image);
                echo $imageContent;
            },$fileName);
        }
    }
    
}
