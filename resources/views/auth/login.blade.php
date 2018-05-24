<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Zaroorat | Admin Panel</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/css/components-rounded.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('pages/css/login.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('layouts/layout/css/themes/default.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('global/css/custom.css')}}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> 
        <style>
            .error{color: #e73d4a;}
            
        </style>
    </head>
    <body class=" login a_login_page">
        <div class="logo">
             <!--<a href="">
               <img  style="width: 160px; height: 85px;" src="" alt="" /> </a>-->
        </div>
        <div class="content">
            <form class="login-form" id='login_form' action="{{ route('login') }}" method="POST">
                 @csrf
                <h3 class="form-title font-green">Admin Login</h3>
                <div class="alert alert-danger display-hide" id="login-danger">
                    <button class="close" data-close="alert"></button>
                    <span id="message">    
                    </span>
                </div>
                <div class="alert alert-success display-hide" id="login-success-div">
                    <button class="close" data-close="alert"></button>
                    <span id="login-success">    
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-solid placeholder-no-fix" name="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}" required autofocus>
                     @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                     <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                      @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                      @endif
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn green uppercase pull-left"> {{ __('Login') }}</button>
                    <label class="rememberme pull-right">
                </div>
            </form>
 </div>
        <div class="copyright"> 2018 © zaroorat by <a target="blank" href="https://www.purelogics.net/">PureLogics</a></div>
        <script src="{{ asset('global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('global/scripts/app.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('pages/scripts/login.js')}}" type="text/javascript"></script>
 </body>
  <script>
            $(document).ready(function(){
                //$('#message').html('Username or password is required.');
                <?php if($errors->has('email')) {
                    $message = 'Invalid Email Address';
                ?>
                        $('#forget-message').html("<?php echo $message ?>");
                        $('#forget-danger').show();
                        $('#forget-password').click();
                <?php
                    }
                    else if($errors->has('password')){
                        $message ='Invalid Password';
                ?>
                        $('#message').html("<?php echo $message ?>");
                        $('#login-danger').show();
                <?php
                    }else{
                  ?>
             
                        
                $('#email, #password, #fp_email').focus(function(){
                    $('.alert-danger').hide();
                    $('#message').html('Invalid Credentials.');
                });
                    <?php } ?>
                $('#fp_email').focus(function(){
                    $('#fp_email-error').remove();
                    $('.alert-danger').hide();
                });
                
                $('#back-btn').click(function(){
                    $('#fp_email-error').remove();
                    $('#fp_email').val('');
                    $('#forget-danger').hide();
                });
                
                $('#forget-password').click(function(){
                    $('#a_username').val('');
                    $('#a_password').val('');
                    $('#login-danger').hide();
                });
                
            });
        </script>
</html>

