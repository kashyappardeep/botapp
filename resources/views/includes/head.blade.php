<div class="app-header white box-shadow">
    <div class="navbar">
        <!-- Open side - Naviation on mobile -->
        <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up">
          <i class="material-icons"></i>
        </a>
        <!-- / -->
        
        <!-- Page title - Bind to $state's title -->
        <div class="navbar-item pull-left h5" ng-bind="$state.current.data.title" id="pageTitle"></div>
        @if(session('success'))
        
        <div id="successAlert" class="alertmsgsuccess">
          <i class="fa fa-check"></i>
            {{ session('success') }}
        </div>
    @endif
   
    @if ($errors->any())
    <div id="successAlert" class="alertmsgdanger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <!-- navbar right -->
        <ul class="nav navbar-nav pull-right">
          <li class="nav-item dropdown pos-stc-xs">
            <a class="nav-link" href="" data-toggle="dropdown">
              <i class="material-icons"></i>
              <span class="label label-sm up warn">3</span>
            </a>
            <div ui-include="'../views/blocks/dropdown.notification.html'"></div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link clear" href="" data-toggle="dropdown">
              <span class="avatar w-32">
                <img src="{{asset('assets/images/a0.jpg')}}" alt="...">
                <i class="on b-white bottom"></i>
              </span>
            </a>
            <div ui-include="'../views/blocks/dropdown.user.html'"></div>
          </li>
          <li class="nav-item hidden-md-up">
            <a class="nav-link" data-toggle="collapse" data-target="#collapse">
              <i class="material-icons"></i>
            </a>
          </li>
        </ul>
        <!-- / navbar right -->
    
        <!-- navbar collapse -->
        <div class="collapse navbar-toggleable-sm" id="collapse">
          <div ui-include="'../views/blocks/navbar.form.right.html'"></div>
          <!-- link and dropdown -->
          <ul class="nav navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link" href="" data-toggle="dropdown">
                  <i class="fa fa-home"></i>
                  <span>Home</span>
                </a>
              <div ui-include="'../views/blocks/dropdown.new.html'"></div>
            </li>
          </ul>
          <!-- / -->
        </div>
        <!-- / navbar collapse -->
    </div>
</div>