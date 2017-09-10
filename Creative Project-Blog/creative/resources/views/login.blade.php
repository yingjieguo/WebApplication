
@extends('vendor.main')

@section('content')       
       <div id="form"><!--form-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-5">

                        <div class="login-form">
                            
                        <!--login form-->
                            <h2>Log in</h2>
                            <br>
                            <form method="POST" action="{{url('auth/login')}}">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                <input type="email" name="email" id="email" placeholder="Email Address" />
                                </div>
                                <div class="form-group">
                                <input type="password" name="password" id="password" placeholder="Password" />
                                 </div>
<!--                                 <div class="checkbox" style="text-align:center;"> -->
                               <div>
                                    <input name="remember" id="remember" type="checkbox" class="checkbox"> 
                                    Keep me signed in
                                </div>
                                <!-- </div> -->
                                <div class="row col-sm-4 col-sm-offset-5"> <button type="submit" class="btn btn-default off">Login</button></div>
                               
                            </form>
                        </div><!--/login form-->
                    </div>
                    <br>

                    </div>
                 <!--    <div class="col-sm-1">
                        <h2 class="or">OR</h2>
                    </div> -->
                    <div class="row">
                    <div class="col-sm-4 col-sm-offset-5">
                        <div class="signup-form"><!--sign up form-->
                            <h2>Sign up</h2>
                            <form method="POST" action="{{url('register')}}">
                                {!! csrf_field() !!}
                                <div class="form-group">
                                <input type="text" name="name" id="name"  placeholder="Name">
                                  </div>
                                <div class="form-group">
                                <input type="email" name="email" placeholder="Email Address"/>
                                 </div>
                                <div class="form-group">
                                <input type="password" name="password" placeholder="Password">
                                 </div>
                                 <div class="row col-sm-4 col-sm-offset-5">
                                <button type="submit" class="btn btn-default">Signup</button>
                                </div>
                            </form>
                        </div><!--/sign up form-->
                    </div>
                </div>
            </div>
        </div><!--/form-->
@endsection
