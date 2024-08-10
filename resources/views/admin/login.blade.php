<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Cryptobarter</title>
  <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="{{asset('assets/images/logo.png')}}">
  <meta name="apple-mobile-web-app-title" content="Flatkit">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="{{asset('assets/images/logo.png')}}">
  
  <!-- style -->
  <link rel="stylesheet" href="{{asset('assets/animate.css/animate.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('assets/glyphicons/glyphicons.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('assets/material-design-icons/material-design-icons.css')}}" type="text/css" />

  <link rel="stylesheet" href="{{asset('assets/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{asset('assets/styles/app.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/styles/font.css')}}" type="text/css" />
</head>
<body>
  <div class="app" id="app">

<!-- ############ LAYOUT START-->
  <div class="center-block w-xxl w-auto-xs p-y-md">
    <div class="navbar">
      <div class="pull-center">
        <div ui-include="'../views/blocks/navbar.brand.html'"></div>
      </div>
    </div>
    <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
      <div class="m-b text-sm">
        Sign in with your Cryptobarter Admin
      </div>
      @if (\Session::has('error'))
      <div class="alert alert-danger" role="alert">
              <p class="text-danger">{!! \Session::get('error') !!}</p>
        </div>
      @endif
      <form action="{{ route('admin.login') }}" method="post">
        @csrf
        <div class="md-form-group float-label">
          <input type="email" name="email"  value="{{old('email')}}" class="md-input" ng-model="user.email" required>
          @if($errors->has('email'))
          <p class="text-danger">{{ $errors->first('email') }}</p>
          @endif
          <label>Email</label>
        </div>
        <div class="md-form-group float-label">
          <input type="password" name="password" class="md-input" ng-model="user.password" required>
          @if($errors->has('password'))
          <p class="text-danger">{{ $errors->first('password') }}</p>
          @endif
          <label>Password</label>
        </div>      
        {{-- <div class="m-b-md">        
          <label class="md-check">
            <input type="checkbox"><i class="primary"></i> Keep me signed in
          </label>
        </div> --}}
        <button type="submit" class="btn primary btn-block p-x-md">Sign in</button>
      </form>
    </div>

    <div class="p-v-lg text-center">
      {{-- <div class="m-b"><a ui-sref="access.forgot-password" href="forgot-password.html" class="text-primary _600">Forgot password?</a></div> --}}
      {{-- <div>Do not have an account? <a ui-sref="access.signup" href="signup.html" class="text-primary _600">Sign up</a></div> --}}
    </div>
  </div>

<!-- ############ LAYOUT END-->

  </div>
<script src="scripts/app.html.js"></script>
</body>
</html>
