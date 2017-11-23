<?php namespace App\Http\Controllers;
use DB,Mail,Cart;
use Request;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$product = DB::table('products')->select('id','name','image','price','alias')->orderBy('price','ASC')->skip(0)->take(4)->get();
		$productt = DB::table('products')->select('id','name','image','price','alias')->orderBy('id','DESC')->skip(0)->take(8)->get();
		return view('user.pages.home',compact('product','productt'));
	}
	
	public function loaisanpham($id)
	{
		$product_cate =DB::table('products')->select('id','name','image','price','alias','cate_id')->where('cate_id',$id)->paginate(3);
		$cate =DB::table('cates')->select('parent_id')->where('id',$product_cate[0]->cate_id)->first();
		$menu_cate =DB::table('cates')->select('id','name','alias')->where('parent_id',$cate->parent_id)->get();
		$name_cate =DB::table('cates')->select('name')->where('id',$id)->first();
		$name_category =DB::table('cates')->select('name','order')->where('id',$id)->first();
		$latest_product = DB::table('products')->select('id','name','image','price','alias')->orderBy('id','DESC')->skip(0)->take(4)->get();
		$FEATURED_product = DB::table('products')->select('id','name','image','price','alias')->orderBy('price','ASC')->skip(0)->take(4)->get();
		$FEATURED_product_other = DB::table('products')->select('id','name','image','price','alias')->orderBy('id','ASC')->skip(0)->take(4)->get();
		$latest_cate = DB::table('cates')->select('id','name','alias')->orderBy('id','DESC')->skip(0)->take(4)->get();
		
		return view('user.pages.cate',compact('product_cate','menu_cate','latest_product','name_cate','latest_cate','name_category','FEATURED_product','FEATURED_product_other'));
	}
	public function chitietsanpham($id){
		$product_detail =DB::table('products')->where('id',$id)->first();
		$image = DB::table('product_images')->select('id','image')->where('product_id',$product_detail->id)->get();
		$product_cate =DB::table('products')->where('cate_id',$product_detail->cate_id)->where('id','<>',$id)->take(4)->get();
		$productdes = DB::table('products')->select('id','image')->where('id',$product_detail->id)->get();
		return view('user.pages.detail',compact('product_detail','image','product_cate','productdes'));
	}
	public function get_lienhe(){
		return view('user.pages.contact');
	}

	public function post_lienhe(request $request){
		$data =['hoten'=>request::input('name'),'fromemail'=>request::input('email'),'phone'=>request::input('number'),'tinnhan'=>request::input('messagee'),'diachi'=>request::input('address')];
		Mail::send('emails.blanks',$data,function($message){
			$message->from('nhathungmen111@gmail.com','Shop Eva');
			$message->to('nhathungmen111@gmail.com','Admin')->subject('Khách Hàng Mua Hàng');
		});
		echo "
			<script>
			alert('Cảm ơn bạn đã góp ý ,chúng tôi sẽ liên hệ lại cho bạn trong thời gian sớm nhất');
			window.location = '" .url('/'). "'
				
		</script>";
		
	}
	public function get_ykien(){
		return view('user.pages.detail');
	}
	public function post_ykien(request $request){
		$comment =['commentcontent'=>request::input('comment'),'texttinput'=>request::input('txtinput')];
		Mail::send('emails.comment',$comment,function($message){
			$message->from('nhathungmen111@gmail.com','Shop Eva');
			$message->to('nhathungmen111@gmail.com','Admin')->subject('Khách Hàng Mua Hàng');
		});
		echo "
			<script>
			alert('Cảm ơn bạn đã góp ý ,chúng tôi sẽ liên hệ lại cho bạn trong thời gian sớm nhất');
			window.location = '" .url('/'). "'
				
		</script>";
		
	}
	public function muahang($id){
		$product_buy =DB::table('products')->where('id',$id)->first();
		cart::add(array('id'=>$id,'name'=>$product_buy->name,'qty'=>1,'price'=>$product_buy->price,'options'=>array('img'=>$product_buy->image)));
		$content = Cart::content();
		return redirect()->route('giohang');
	}
	public function giohang(){
		$content = Cart::content();
		$total =Cart::total();
		return view('user.pages.shopping',compact('content','total'));
	}

	public function checkout(){
		$content = Cart::content();
		$total = Cart::total();
		return view('user.pages.checkout',compact('content','total'));
	}

	public function xoasanpham($id){
		Cart::remove($id);
		return redirect()->route('giohang');
	}
	public function capnhat(){
		if(request::ajax()){
			$id =request::get('id');
			$qty =request::get('qty');
			Cart::update($id,$qty);
			echo "success";
		}
	}

	public function get_register(){
		return view('user.pages.register');
	}

	public function post_register(){
		
	}
}
