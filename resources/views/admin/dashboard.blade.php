@include('includes.header');  

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
      <div class="app-header white box-shadow">
        <div class="navbar">
          <!-- Open side - Naviation on mobile -->
          <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up">
            <i class="material-icons"></i>
          </a>
          <!-- / -->

          <!-- Page title - Bind to $state's title -->
          <div class="navbar-item pull-left h5" ng-bind="$state.current.data.title" id="pageTitle"></div>

          <!-- navbar right -->
          <ul class="nav navbar-nav pull-right">
            <li class="nav-item dropdown pos-stc-xs">
              <a class="nav-link" href="" data-toggle="dropdown">
                <i class="material-icons"></i>
                <span class="label label-sm up warn">3</span>
              </a>
              <div class="dropdown-menu pull-right w-xl animated fadeInUp no-bg no-border no-shadow">
                <div class="scrollable" style="max-height: 220px">
                  <ul class="list-group list-group-gap m-a-0">
                    <li class="list-group-item black lt box-shadow-z0 b"><span class="pull-left m-r"><img
                          src="{{asset('assets/images/a0.jpg')}}" alt="..." class="w-40 img-circle"></span> <span
                        class="clear block">Use awesome <a href="" class="text-primary">animate.css</a><br><small
                          class="text-muted">10 minutes ago</small></span></li>
                    <li class="list-group-item black lt box-shadow-z0 b"><span class="pull-left m-r"><img
                          src="{{asset('assets/images/a1.jpg')}}" alt="..." class="w-40 img-circle"></span> <span
                        class="clear block"><a href="" class="text-primary">Joe</a> Added you as friend<br><small
                          class="text-muted">2 hours ago</small></span></li>
                    <li class="list-group-item dark-white text-color box-shadow-z0 b"><span class="pull-left m-r"><img
                          src="{{asset('assets/images/a2.jpg')}}" alt="..." class="w-40 img-circle"></span> <span
                        class="clear block"><a href="" class="text-primary">Danie</a> sent you a message<br><small
                          class="text-muted">1 day ago</small></span></li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link clear" href="" data-toggle="dropdown">
                <span class="avatar w-32">
                  <img src="{{asset('assets/images/a0.jpg')}}" alt="...">
                  <i class="on b-white bottom"></i>
                </span>
              </a>
              <div class="dropdown-menu pull-right dropdown-menu-scale"><a class="dropdown-item"
                  ui-sref="app.inbox.list"><span>Inbox</span> <span class="label warn m-l-xs">3</span></a> <a
                  class="dropdown-item" ui-sref="app.page.profile"><span>Profile</span></a> <a class="dropdown-item"
                  ui-sref="app.page.setting"><span>Settings</span> <span class="label primary m-l-xs">3/9</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" ui-sref="app.docs">Need help?</a>
                 <a href="{{url('logout')}}"
                  class="dropdown-item" ui-sref="access.signin">Sign out</a>
              </div>
            </li>
            <li class="nav-item hidden-md-up">
              <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
                <i class="material-icons"></i>
              </a>
            </li>
          </ul>
          <!-- / navbar right -->

          <!-- navbar collapse -->
          <div class="collapse navbar-toggleable-sm" id="collapse" aria-expanded="false">
            <form class="navbar-form form-inline pull-right pull-none-sm navbar-item v-m" role="search">
              <div class="form-group l-h m-a-0">
                <div class="input-group"><input type="text" class="form-control form-control-sm p-x b-a rounded"
                    placeholder="Search projects..."></div>
              </div>
            </form>
            <!-- link and dropdown -->
            <ul class="nav navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="" data-toggle="dropdown">
                  <i class="fa fa-fw fa-plus text-muted"></i>
                  <span>New</span>
                </a>
                <div class="dropdown-menu dropdown-menu-scale"><a class="dropdown-item"
                    ui-sref="app.inbox.compose"><span>Inbox</span></a> <a class="dropdown-item"
                    ui-sref="app.todo"><span>Todo</span></a> <a class="dropdown-item"
                    ui-sref="app.note.list"><span>Note</span> <span class="label primary m-l-xs">3</span></a>
                  <div class="dropdown-divider"></div><a class="dropdown-item" ui-sref="app.contact">Contact</a>
                </div>
              </li>
            </ul>
            <!-- / -->
          </div>
          <!-- / navbar collapse -->
        </div>
      </div>
      <div class="app-footer">
        <div class="p-a text-xs">
          <div class="pull-right text-muted">
            © Copyright <strong>Tronox</strong> <span class="hidden-xs-down">- Built with Love v1.1.3</span>
            <a ui-scroll-to="content"><i class="fa fa-long-arrow-up p-x-sm"></i></a>
          </div>
          <div class="nav">
            <a class="nav-link" href="">About</a>
            <span class="text-muted">-</span>
            <a class="nav-link label accent" href="http://themeforest.net/user/flatfull/portfolio?ref=flatfull">Get
              it</a>
          </div>
        </div>
      </div>
      <div ui-view="" class="app-body" id="view">

        <!-- ############ PAGE START-->
        <div class="padding">
          <div class="margin">
            <h5 class="m-b-0 _300">Tronox, Welcome back</h5>
            <small class="text-muted">Awesome uikit for your next project</small>
            
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="row">
                <a href="">
                <div class="col-xs-4">
                  <div class="box p-a">
                    <div class="pull-left m-r">
                      <i class="fa fa-users text-2x text-success m-y-sm"></i>
                    </div>
                    <div class="clear">
                      <div class="text-muted">Total Users</div>
                      <h4 class="m-a-0 text-md _600">{{ $user }}</h4>
                    </div>
                  </div>
                </div></a>
                <a href="">
                <div class="col-xs-4">
                  <div class="box p-a">
                    <div class="pull-left m-r">
                      <i class="fa fa-users text-2x text-success m-y-sm"></i>
                    </div>
                    <div class="clear">
                      <div class="text-muted">Active User</div>
                      <h4 class="m-a-0 text-md _600">{{$active}}</h4>
                    </div>
                  </div>
                </div></a>
                <a href="">
                <div class="col-xs-4">
                  <div class="box p-a">
                    <div class="pull-left m-r">
                      <i class="fa fa-users text-2x  m-y-sm" style="color: rgb(226, 247, 33)"></i>
                    </div>
                    
                    <div class="clear">
                      <div class="text-muted">InActive User</div>
                      <h4 class="m-a-0 text-md _600">{{$inactive}}</h4>
                    </div>
                
                  </div>
                </div>  </a>
                <a href="">
                <div class="col-xs-4">
                  <div class="box p-a">
                    <div class="pull-left m-r">
                      <i class="fa fa-university text-2x text-success m-y-sm"></i>
                    </div>
                    <div class="clear">
                      <div class="text-muted">Total Investment</div>
                      <h4 class="m-a-0 text-md _600">{{$total_invest}}</h4>
                     
                    </div>
                  </div>
                </div></a>
                <a href="">
                  <div class="col-xs-4">
                    <div class="box p-a">
                      <div class="pull-left m-r">
                        <i class="fa fa-thumbs-up text-2x text-success m-y-sm"></i>
                      </div>
                      <div class="clear">
                        <div class="text-muted">Total Withdrawal </div>
                        <h4 class="m-a-0 text-md _600">{{$total_Withdrawal}}</h4>
                        </div>
                      
                  
                    </div>
                  </div>  </a>


                  <div class="col-xs-4">
                    <div class="box p-a">
                      <div class="pull-left m-r">
                        <i class="fa fa-university text-2x text-success m-y-sm"></i>
                      </div>
                      <div class="clear">
                        <div class="text-muted">24 Hours Ago Investment</div>
                        <h4 class="m-a-0 text-md _600">{{$twentyFourHoursinvest}}</h4>
                       
                      </div>
                    </div>
                  </div>
                   <div class="col-xs-4">
                  <div class="box p-a">
                    <div class="pull-left m-r">
                      <i class="fa fa-university text-2x text-success m-y-sm"></i>
                    </div>
                    <div class="clear">
                      <div class="text-muted">24 Hours Ago Withdrawal</div>
                      <h4 class="m-a-0 text-md _600">{{$twentyFourHoursWithdrawal}}</h4>
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
          </div>
         
         

      </div>
    </div>
    @include('includes.footer'); 