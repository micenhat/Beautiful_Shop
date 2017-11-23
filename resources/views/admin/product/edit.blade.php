@extends('admin.master')
@section('controller','Product')
@section('header','Product')
@section('action','Edit')
@section('content')
                    <style>
                        .image_Curent {width: 300px;}
                        .img_detail {width: 200px;margin-bottom: 20px}
                        .icon_del {position: relative;top:-100px;left: -20px; }
                        #insert {margin-top:20px}
                        
                    </style>
                    <!-- /.col-lg-12 -->
                    <form action="" method="POST" name="frmEditProduct" enctype="multipart/form-data">
                    <div class="col-lg-7" style="padding-bottom:120px">
                            @if(count($errors) >0)
                            <div class ="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{!! $error !!}</li>
                                    @endforeach
                                </ul> 

                            </div>

                        @endif 

                        
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                            <div class="form-group">
                            <label>Category Parent</label>
                            <select class="form-control" name="Parent">
                                <option value="">Please Choose Category</option>
                                <?php cate_parent($cate, 0,"--",$product["cate_id"]) ?>
                            </select>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="txtName" value="{!! old('txtName',isset($product) ? $product['name']: NULL) !!}" placeholder="Please Enter Username" />
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" name="txtPrice" value="{!! old('txtPrice',isset($product) ? $product['price']: NULL) !!}"placeholder="Please Enter Password" />
                            </div>
                            <div class="form-group">
                                <label>Intro</label>
                                <textarea class="form-control" rows="3" name="txtIntro"> {!! old('txtIntro',isset($product) ? $product['intro']: NULL) !!} </textarea>
                                <script type="text/javascript">ckeditor('txtIntro')</script>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea class="form-control" rows="3" name="txtContent">{!! old('txtContent',isset($product) ? $product['content']: NULL) !!}</textarea>
                                <script type="text/javascript">ckeditor('txtContent')</script>
                            </div>
                             <div class="form-group">
                                <label>Image Current</label>
                                <img src="{!! asset('resources/upload/'.$product['image']) !!}" class="image_Curent"/>
                                <input type="hidden" name="img_current" value="{!! $product['image'] !!}" />
                            </div>
                            <div class="form-group">
                                <label>Images</label>
                                <input type="file" name="fImages">
                            </div>
                            <div class="form-group">
                                <label>Product Keywords</label>
                                <input class="form-control" name="txtKeywords" value="{!! old('txtKeywords',isset($product) ? $product['keywords']: NULL) !!}" placeholder="Please Enter Category Keywords" />
                            </div>
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea class="form-control" rows="3" name="txtDescription" >{!! old('txtDescription',isset($product) ? $product['description']: NULL) !!}</textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-default">Product Edit</button>
                            <button type="reset" class="btn btn-default">Reset</button>

                        </div>
                        <div class ="col-md-1"></div>
                        <div class ="col-md-4">
                            @foreach($Product_image as $key => $item)
                            <div class="form_group" id ="{!! $key !!}">
                            <img src="{!! asset('resources/upload/Detail/'.$item['image']) !!}" class="img_detail" idHinh ="{!! $item['id'] !!}" id ="{!! $key !!}" />
                            <a href= "javascript:void(0)" type="button" id="del_img_demo" class=" btn btn-danger btn-circle icon_del"><i class ="fa fa-times"></i></a>
                            </div>

                            @endforeach
                            <button type ="button" class="btn btn-primary" id ="addImages"> Add Images</button>
                            <div id ="insert"></div>
                        </div>
                    <form>
@endsection()