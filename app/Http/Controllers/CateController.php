<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\CateRequest;
use App\Cate;

class CateController extends Controller {
	

	public function getList (){
		$data =Cate::select('id','name','parent_id')->orderBy('id','DESC')->get()->toArray(); 
		return view('admin.cate.list',compact('data'));
	}
	public function getAdd () {
		$parent = Cate::select('id','name','parent_id')->get()->toArray();
		return view('admin.cate.add',compact('parent'));
	}
	

	public function postAdd (CateRequest $request){
		$cate = new Cate;
		$cate->name = $request->txtCateName;
		$cate->alias =$request->txtCateName;
		$cate->order = $request->txtOrder;
		$cate->parent_id = $request->Parent;
		$cate->keywords = $request->txtKeywords;
		$cate->description = $request->txtDescription;
		$cate->save();
		return redirect()->route('admin.cate.list')->with(['flash_level'=>'success','flash_message'=>'Success !! Complete Add Category']);
	}
	public function getDelete($id){
		$parent =cate::where('parent_id',$id)->count();
		if($parent==0){
			$cate =cate::find($id);
			$cate ->delete($id);
			return redirect()->route('admin.cate.list')->with(['flash_level'=>'success','flash_message'=>'Success !! Complate Delete Category']);
		}
		else{
			echo "<script type ='text/javascript'>
			alert('Sorry! you can not Delete this Category');
			window.location= '";
				echo route('admin.cate.list');
			echo"'
			</script>";
		}
		
	}
	public function getEdit($id){
		$data =Cate::findOrFail($id)->toArray();
		$parent = Cate::select('id','name','parent_id')->get()->toArray();
		return view('admin.cate.edit',compact('parent','data'));
		
  	}
	public function postEdit(Request $request,$id){
		$this->validate($request,
			["txtCateName"=>"required"],
			["txtCateName.required"=>"Please Enter Name Categary 1"]
			);
		$cate =Cate::find($id);
		$cate->name = $request->txtCateName;
		$cate->alias = $request->txtCateName;
		$cate->order = $request->txtOrder;
		$cate->parent_id = $request->Parent;
		$cate->keywords = $request->txtKeywords;
		$cate->description = $request->txtDescription;
		$cate->save();
		return redirect()->route('admin.cate.list')->with(['flash_level'=>'success','flash_message'=>'Success !! Complete Edit Category']);
	}
	
}
