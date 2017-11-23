<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use App\Cate;
use App\Product;
use App\ProductImages;
use App\Http\Requests\ProductRequest;
use Input,File;
use Request;
use Auth;
class ProductController extends Controller {

	public function getList(){
		$data= Product::select('id','name','price','cate_id','created_at')->orderBy('id','DESC')->get()->toArray();
		return view('admin.product.list',compact('data'));
	}


	public function getAdd(){
		$cate= Cate::select('name','id','parent_id')->get()->toArray();
		return view('admin.product.add',compact('cate'));
	}
	public function postAdd (ProductRequest $product_request){
		$file_name= $product_request->file('fImages')->getClientOriginalName();
		$product= new Product();
		$product->name=$product_request->txtName;
		$product->alias=$product_request->txtName;
		$product->price=$product_request->txtPrice;
		$product->intro=$product_request->txtIntro;
		$product->content=$product_request->txtContent;
		$product->image=$file_name;
		$product->keywords=$product_request->txtKeywords;
		$product->description=$product_request->txtDescription;
		$product->user_id= Auth::user()->id;
		$product->cate_id=$product_request->Parent;
		$product_request->file('fImages')-> move('resources/upload/',$file_name);
		$product->save();
		$product_id = $product->id;
		if(Input::hasFile('fProductDetail')){
			foreach (Input::file('fProductDetail')as $file) {
				$product_img =new ProductImages();
				if(isset($file)){
					$product_img->image = $file->getClientOriginalName();
					$product_img-> product_id =$product_id;
					$file->move('resources/upload/Detail/',$file->getClientOriginalName());
					$product_img->save();
				}
			}
		}
		return redirect()->route('admin.product.list')->with(['flash_level'=>'success','flash_message'=>'Success !! Complete Add Product']);
	}
	public function getDelete($id){
		$product_detail = product::find($id)->pimages->toArray();
		foreach ($product_detail as $value) {
			file::delete('resources/upload/Detail/'.$value["image"]);
		}
		$product = product::find($id);
		file::delete('resources/upload/'.$product->image);
		$product->delete($id);
		return redirect()->route('admin.product.list')->with(['flash_level'=>'success','flash_message'=>'Success !! Complete delete Product']);

	}
	public function getEdit($id){
		$cate =Cate::select('id','name','parent_id')->get()->toArray();
		$product =Product::find($id);
		$Product_image = Product::find($id)->pimages;
		return view('admin.product.edit',compact('cate','product','Product_image'));
	}
	public function postEdit($id,request $request){
		$product = Product::find($id);
		$product->name = request::input('txtName');
		$product->alias =request::input('txtName');
		$product->price =request::input('txtPrice');
		$product->intro =request::input('txtIntro');
		$product->content =request::input('txtContent');
		//$product->image =
		$product->keywords =request::input('txtKeywords');
		$product->description =request::input('txtDescription');
		$product->user_id =Auth::user()->id;
		$product->cate_id =request::input('Parent');
		$product->save();
		$img_current ='resources/upload/'.request::input('img_current');
		if(!empty(request::file('fImages'))){
			$file_name = request::file('fImages')->getClientOriginalName();
			$product->image = $file_name;
			request::file('fImages')->move('resources/upload/',$file_name);
			if(File::exists($img_current)){
				File::delete($img_current);
			}
		}
		else{
			echo"khong File";
		}
		$product->save();
		return redirect()->route('admin.product.list')->with(['flash_level'=>'success','flash_message'=>'Success !! Complete Upadate Product']);
	}

	public function getDelImg($id){
		if(request::ajax()){
			$idHinh =(int)request::get('idHinh');
			$image_detail =ProductImages::find($idHinh);
			if(!empty($image_detail)){
				$img='resources/upload/Detail/'.$image_detail->image;
				if(File::exists($img)){
					File::delete($img);
				}
				$image_detail->delete();
			}
			return "Oke";
		}
	}
}
