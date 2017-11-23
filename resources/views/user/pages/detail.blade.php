@extends('user.master')
@section('description','Đây là trang chi tiết sản phẩm')
@section('content')

<div id="maincontainer">
  <section id="product">
    <div class="container">      
      <!-- Product Details-->
      <div class="row">
       <!-- Left Image-->
        <div class="span5">
          <ul class="thumbnails mainimage">
            <li class="span5">
              <a  rel="position: 'inside' , showTitle: false, adjustX:-4, adjustY:-4" class="thumbnail cloud-zoom" href="{!! asset('resources/upload/'.$product_detail->image) !!}">
                <img src="{!! asset('resources/upload/'.$product_detail->image) !!}" alt="" title="">
              </a>
            </li>
            @foreach($image as $item_image)
            <li class="span5">
              <a  rel="position: 'inside' , showTitle: false, adjustX:-4, adjustY:-4" class="thumbnail cloud-zoom" href="{!! asset('resources/upload/'.$product_detail->image) !!}">
                <img  src="{!! asset('resources/upload/Detail/'.$item_image->image) !!}" alt="" title="">
              </a>
            </li>
           @endforeach
          </ul>
          <ul class="thumbnails mainimage">
            <li class="producthtumb">
              <a class="thumbnail" >
                <img  src="{!! asset('resources/upload/'.$product_detail->image) !!}" alt="" title="">
              </a>
            </li>
            @foreach($image as $item_iamge)<!-- Hinh phu-->
            <li class="producthtumb">
              <a class="thumbnail" >
                <img  src="{!! asset('resources/upload/Detail/'.$item_iamge->image) !!}" alt="" title="">
              </a>
            </li>
            @endforeach
          </ul>
        </div>
         <!-- Right Details-->
        <div class="span7">
          <div class="row">
            <div class="span7">

              <h1 class="productname" ><span class="bgnone">{!! $product_detail->name !!}
                <li class="producthtumb">
              <a class="thumbnail" >
                <img  src="{!! asset('resources/upload/'.$product_detail->image) !!}" alt="" title="">
              </a>
              </li>
              </span>
              </h1>
              
              <div class="productprice">
                <div class="productpageprice">
                  <span class="spiral"></span> {!! number_format($product_detail->price,0,",",".") !!}
                </div>
                <ul class="productpagecart">
                  <li><a class="cart" href="{!! url('mua-hang',[$product_detail->id,$product_detail->alias]) !!}">Add to Cart</a>
                  </li>
                  </ul>
                
              </div>
              
         <!-- Product Description tab & comments-->
         <div class="productdesc">
                <ul class="nav nav-tabs" id="myTab">
                
                  <li class="active"><a href="#description"> Description </a>
                  </li>
                  <li><a href="#specification">Specification</a>
                  </li>
                  <li><a href="#review">Review</a>
                  </li>
                  <li><a href="#producttag">Tags</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="description">
                    <li ><a href="{!! url('chi-tiet-san-pham',[$product_detail->id,$product_detail->alias]) !!}">{!! $product_detail->description !!}</a></li>
                    <ul class="listoption3">
                      <li></li>
                      <li></li>
                      <li></li>
                      <li></li>
                    </ul>
                  </div>
                  <div class="tab-pane " id="specification">
                    <ul class="productinfo">
                      <li>
                        <span class="productinfoleft"> Product Code:</span>{!! $product_detail->id !!}</li>
                      <li>
                        <span class="productinfoleft"> Product Name:</span>{!! $product_detail->alias !!}</li>
                      <li>
                        <span class="productinfoleft"> Product Content:</span>{!! $product_detail->content !!}</li>
                      <li>
                        <span class="productinfoleft"> Product Iamge:</span><img  src="{!! asset('resources/upload/'.$product_detail->image) !!}" alt="" title=""></li>
                      <li>
                        <span class="productinfoleft"> Old Price: </span> <h2>{!! number_format($product_detail->price,0,',','.') !!} VNĐ </h2></li>
                    </ul>
                  </div>
                  <div class="tab-pane" id="review">
                    <h3>Write a Review</h3>
                    <form class="form-vertical" action="{{ url('y-kien') }}" method="post">
                      <input type ="hidden" name ="_token" value ="{!! csrf_token() !!}" />
                      <fieldset>
                        <div class="control-group">
                          <label class="control-label">Comment Content</label>
                          <div class="controls">
                            <input type="text" class="span3" id="comment" value="" name="comment">
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label">Text input</label>
                          <div class="controls">
                            <textarea rows="3"  class="span3" id="txtinput" value="" name="txtinput"></textarea>
                          </div>
                        </div>
                      </fieldset>
                      <input type="submit" class="btn btn-orange" value="continue">
                    </form>
                  </div>
                  <div class="tab-pane" id="producttag">
                    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum <br>
                      <br>
                    </p>
                    <ul class="tags">
                      <li><a href="#"><i class="icon-tag"></i> Webdesign</a>
                      </li>
                      <li><a href="#"><i class="icon-tag"></i> html</a>
                      </li>
                      <li><a href="#"><i class="icon-tag"></i> html</a>
                      </li>
                      <li><a href="#"><i class="icon-tag"></i> css</a>
                      </li>
                      <li><a href="#"><i class="icon-tag"></i> jquery</a>
                      </li>
                      <li><a href="#"><i class="icon-tag"></i> css</a>
                      </li>
                      <li><a href="#"><i class="icon-tag"></i> jquery</a>
                      </li>
                      <li><a href="#"><i class="icon-tag"></i> Webdesign</a>
                      </li>
                      <li><a href="#"><i class="icon-tag"></i> css</a>
                      </li>
                      <li><a href="#"><i class="icon-tag"></i> jquery</a>
                      </li>
                      <li><a href="#"><i class="icon-tag"></i> Webdesign</a>
                      </li>
                      <li><a href="#"><i class="icon-tag"></i> html</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--  Related Products-->
  <section id="related" class="row">
    <div class="container">
      <h1 class="heading1"><span class="maintext">Related Products</span><span class="subtext"> See Our Most featured Products</span></h1>
      <ul class="thumbnails">
        @foreach($product_cate as $item_product_cate)
        <li class="span3">
          <a class="prdocutname" href="{!! url('chi-tiet-san-pham',[$item_product_cate->id,$item_product_cate->alias]) !!}">{!! $item_product_cate->name !!}</a>
          <div class="thumbnail">
            <span class="sale tooltip-test">Sale</span>
            <a href="{!! url('chi-tiet-san-pham',[$item_product_cate->id,$item_product_cate->alias]) !!}"><img alt="" src="{!! asset('resources/upload/'.$item_product_cate->image) !!}"></a>
            <div class="pricetag">
              <span class="spiral"></span><a href="{!! url('mua-hang',[$item_product_cate->id,$item_product_cate->alias]) !!}" class="productcart">ADD TO CART</a>
              <div class="price">
                <div class="pricenew">{!! number_format($item_product_cate->price,0,",",".") !!}</div>
                <div class="priceold">$5000.00</div>
              </div>
            </div>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
  </section>
  <!-- Popular Brands-->
</div>

@endsection