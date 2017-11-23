@extends('admin.master')
@section('controller','User')
@section('header','User')
@section('action','Edit')
@section('content')
                    <!-- /.col-lg-12 -->
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
                        <form action="" method="POST">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" name="txtUser" value="{!! old('txtUser',isset($data) ? $data['username']: NULL) !!}" placeholder="Please Enter Username" disabled />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="txtPass" placeholder="Please Enter Password" />
                            </div>
                            <div class="form-group">
                                <label>RePassword</label>
                                <input type="password" class="form-control" name="txtRePass" placeholder="Please Enter RePassword" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="txtEmail" value="{!! old('txtEmail',isset($data) ? $data['email']: NULL) !!}" placeholder="Please Enter Email" />
                            </div>
                            @if(Auth::user()->id != $id)
                            <div class="form-group">
                                <label>User Level</label>
                                <label class="radio-inline">
                                    <input name="rdoLevel" value="1" checked="" type="radio"
                                    @if($data["level"] == 1){
                                        checked="checked"
                                        }

                                    @endif
                                    >Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoLevel" value="2" type="radio"
                                    @if($data["level"] == 2){
                                        checked="checked"
                                        }

                                    @endif
                                    >Member
                                </label>
                            </div>
                            @endif
                            <button type="submit" class="btn btn-default">User Edit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
@endsection()             
