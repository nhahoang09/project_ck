
<!doctype html>
<html lang="en">
<head>
    <title>Login/Register Modal by Creative Tim</title>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


	<style>body{padding-top: 60px;}</style>

    <link href="/backend/assets/css/bootstrap.css" rel="stylesheet" />

	<link href="/backend/assets/css/login-register.css" rel="stylesheet" />
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

	<script src="/backend/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="/backend/assets/js/bootstrap.js" type="text/javascript"></script>
	<script src="/backend/assets/js/login-register.js" type="text/javascript"></script>

</head>
<body>
    <div class="container">
        {{-- <div class="row">
            <div class="col-sm-4"></div>
            <a class="btn big-login" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Log in</a>
            <div class="col-sm-4">

                 <a class="btn big-register" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Register</a></div>
            <div class="col-sm-4"></div>
        </div> --}}

        <div class="modal fade login" id="loginModal">
            <div class="modal-dialog login animated">
                <div class="modal-content">
                   <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Register with</h4>
                  </div>
                  <div class="modal-body">
                      <div class="box">
                           <div class="content">
                              <div class="social">
                                  <a class="circle github" href="#">
                                      <i class="fa fa-github fa-fw"></i>
                                  </a>
                                  <a id="google_login" class="circle google" href="#">
                                      <i class="fa fa-google-plus fa-fw"></i>
                                  </a>
                                  <a id="facebook_login" class="circle facebook" href="#">
                                      <i class="fa fa-facebook fa-fw"></i>
                                  </a>
                              </div>
                              <div class="division">
                                  <div class="line l"></div>
                                    <span>or</span>
                                  <div class="line r"></div>
                              </div>
                              <div class="error"></div>
                              <div class="form loginBox">
                                  <form method="POST" action="{{ route('admin.register.handle') }}" accept-charset="UTF-8">
                                    {!! csrf_field() !!}
                                  <input id="name" class="form-control" type="text" placeholder="Name" name="name">
                                  <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                                  <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                                  <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="confirm-password">
                                  <div class="form-group mb-5">
                                      <div>
                                          <input type="radio" name="role_id" value="2" checked id="role_shipper-2">
                                          <label for="role_shipper-2">Shippper</label>
                                          <input type="radio" name="role_id" value=""   id="role_other-">
                                          <label for="role_other-">Other</label>
                                      </div>
                                  </div>
                                  <button class="btn btn-default btn-login" type="submit">Create account</button>
                                  </form>
                              </div>
                           </div>
                      </div>

                  </div>
                  <div class="modal-footer">
                      <div class="forgot login-footer">
                          <span>Already have an account?
                              <a href="{{ route('admin.login') }}">Login</a>
                          ?</span>
                      </div>

                  </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
        openLoginModal();
    });
</script>


</body>
</html>
