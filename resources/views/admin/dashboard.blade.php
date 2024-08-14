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
                      <i class="fa fa-heart text-2x text-success m-y-sm"></i>
                    </div>
                    <div class="clear">
                      <div class="text-muted">Users</div>
                      <h4 class="m-a-0 text-md _600">{{ $user }}</h4>
                    </div>
                  </div>
                </div></a>
                <a href="">
                <div class="col-xs-4">
                  <div class="box p-a">
                    <div class="pull-left m-r">
                      <i class="fa fa-bank text-2x text-success m-y-sm"></i>
                    </div>
                    <div class="clear">
                      <div class="text-muted">Total Assets</div>
                      <h4 class="m-a-0 text-md _600">0000</h4>
                    </div>
                  </div>
                </div></a>
                <a href="">
                <div class="col-xs-4">
                  <div class="box p-a">
                    <div class="pull-left m-r">
                      <i class="fa fa-chain text-2x text-success m-y-sm"></i>
                    </div>
                    
                    <div class="clear">
                      <div class="text-muted">Total Blockchain</div>
                      <h4 class="m-a-0 text-md _600">000</h4>
                    </div>
                
                  </div>
                </div>  </a>
                <a href="">
                <div class="col-xs-4">
                  <div class="box p-a">
                    <div class="pull-left m-r">
                      <i class="fa fa-video-camera text-2x text-success m-y-sm"></i>
                    </div>
                    <div class="clear">
                      <div class="text-muted">Total Adds</div>
                      <h4 class="m-a-0 text-md _600">00</h4>
                      <div style="display: flex">
                      <p >00</p>&nbsp&nbsp
                      <span>||</span>&nbsp&nbsp
                      <p >00</p>
                      </div>
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
                        <div class="text-muted">Total FeedBack </div>
                        <h4 class="m-a-0 text-md _600">0</h4>
                        <div style="display: flex">
                          <p >0</p>&nbsp&nbsp
                          <span>||</span>&nbsp&nbsp
                          <p >0</p>
                          </div>
                      
                      </div>
                      
                  
                    </div>
                  </div>  </a>
                  <a href="">
                  <div class="col-xs-4">
                    <div class="box p-a">
                      <div class="pull-left m-r">
                        <i class="fa fa-video-camera text-2x text-success m-y-sm"></i>
                      </div>
                      <div class="clear">
                        <div class="text-muted"> Completed Orders</div>
                        <h4 class="m-a-0 text-md _600">0</h4>
                      </div>
                    </div>
                  </div></a>
                  
                <div class="col-xs-12">
                  <div class="row-col box-color text-center primary">
                    <div class="row-cell p-a">
                      Followers
                      <h4 class="m-a-0 text-md _600"><a href="">2350</a></h4>
                    </div>
                    <div class="row-cell p-a dker">
                      Following
                      <h4 class="m-a-0 text-md _600"><a href="">7250</a></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- <div class="col-sm-12 col-md-7 col-lg-8">
              <div class="row-col box dark bg">
                <div class="col-sm-8">
                  <div class="box-header">
                    <h3>Activities</h3>
                    <small>Your last activity is posted 4 hours ago</small>
                  </div>
                  <div class="box-body">
                    <div ui-jp="plot" ui-refresh="app.setting.color" ui-options="
			              [
			                { 
			                  data: [[1, 6.1], [2, 6.3], [3, 6.4], [4, 6.6], [5, 7.0], [6, 7.7], [7, 8.3]], 
			                  points: { show: true, radius: 0}, 
			                  splines: { show: true, tension: 0.45, lineWidth: 2, fill: 0 } 
			                },
			                { 
			                  data: [[1, 5.5], [2, 5.7], [3, 6.4], [4, 7.0], [5, 7.2], [6, 7.3], [7, 7.5]], 
			                  points: { show: true, radius: 0}, 
			                  splines: { show: true, tension: 0.45, lineWidth: 2, fill: 0 } 
			                }
			              ], 
			              {
			                colors: ['#0cc2aa','#fcc100'],
			                series: { shadowSize: 3 },
			                xaxis: { show: true, font: { color: '#ccc' }, position: 'bottom' },
			                yaxis:{ show: true, font: { color: '#ccc' }},
			                grid: { hoverable: true, clickable: true, borderWidth: 0, color: 'rgba(120,120,120,0.5)' },
			                tooltip: true,
			                tooltipOpts: { content: '%x.0 is %y.4',  defaultTheme: false, shifts: { x: 0, y: -40 } }
			              }
			            " style="height: 162px; padding: 0px; position: relative;">
                      <canvas class="flot-base" width="621" height="243"
                        style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 414px; height: 162px;"></canvas>
                      <div class="flot-text"
                        style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                        <div class="flot-x-axis flot-x1-axis xAxis x1Axis"
                          style="position: absolute; inset: 0px; display: block;">
                          <div
                            style="position: absolute; max-width: 59px; top: 149px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 13px; text-align: center;">
                            1.0</div>
                          <div
                            style="position: absolute; max-width: 59px; top: 149px; font: 400 11px / 13px Roboto, &quot; Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 77px; text-align: center;">
                            2.0</div>
                          <div
                            style="position: absolute; max-width: 59px; top: 149px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 141px; text-align: center;">
                            3.0</div>
                          <div
                            style="position: absolute; max-width: 59px; top: 149px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 206px; text-align: center;">
                            4.0</div>
                          <div
                            style="position: absolute; max-width: 59px; top: 149px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 270px; text-align: center;">
                            5.0</div>
                          <div
                            style="position: absolute; max-width: 59px; top: 149px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 334px; text-align: center;">
                            6.0</div>
                          <div
                            style="position: absolute; max-width: 59px; top: 149px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 399px; text-align: center;">
                            7.0</div>
                        </div>
                        <div class="flot-y-axis flot-y1-axis yAxis y1Axis"
                          style="position: absolute; inset: 0px; display: block;">
                          <div
                            style="position: absolute; top: 138px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                            5.0</div>
                          <div
                            style="position: absolute; top: 103px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                            6.0</div>
                          <div
                            style="position: absolute; top: 69px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                            7.0</div>
                          <div
                            style="position: absolute; top: 35px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                            8.0</div>
                          <div
                            style="position: absolute; top: 1px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                            9.0</div>
                        </div>
                      </div><canvas class="flot-overlay" width="621" height="243"
                        style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 414px; height: 162px;"></canvas>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4 dker">
                  <div class="box-header">
                    <h3>Reports</h3>
                  </div>
                  <div class="box-body">
                    <p class="text-muted">Dales nisi nec adipiscing elit. Morbi id neque quam. Aliquam sollicitudin
                      venenatis</p>
                    <a href="" class="btn btn-sm btn-outline rounded b-success">Read More</a>
                  </div>
                </div>
              </div>
            </div> --}}
          </div>
          {{-- <div class="row">
            <div class="col-md-12 col-xl-4">
              <div class="box">
                <div class="box-header">
                  <h3>Your tasks</h3>
                  <small>Calculated in last 7 days</small>
                </div>
                <div class="box-tool">
                  <ul class="nav">
                    <li class="nav-item inline">
                      <a class="nav-link">
                        <i class="material-icons md-18"></i>
                      </a>
                    </li>
                    <li class="nav-item inline dropdown">
                      <a class="nav-link" data-toggle="dropdown">
                        <i class="material-icons md-18"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-scale pull-right">
                        <a class="dropdown-item" href="">This week</a>
                        <a class="dropdown-item" href="">This month</a>
                        <a class="dropdown-item" href="">This week</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item">Today</a>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="text-center b-t">
                  <div class="row-col">
                    <div class="row-cell p-a">
                      <div class="inline m-b">
                        <div ui-jp="easyPieChart" class="easyPieChart" ui-refresh="app.setting.color" data-redraw="true"
                          data-percent="55" ui-options="{
	                      lineWidth: 8,
	                      trackColor: 'rgba(0,0,0,0.05)',
	                      barColor: '#0cc2aa',
	                      scaleColor: 'transparent',
	                      size: 100,
	                      scaleLength: 0,
	                      animate:{
	                        duration: 3000,
	                        enabled:true
	                      }
	                    }">
                          <div>
                            <h5>55%</h5>
                          </div>
                          <canvas height="150" width="150" style="height: 100px; width: 100px;"></canvas>
                        </div>
                      </div>
                      <div>
                        Finished
                        <small class="block m-b">320</small>
                        <a href="" class="btn btn-sm white rounded">Manage</a>
                      </div>
                    </div>
                    <div class="row-cell p-a dker">
                      <div class="inline m-b">
                        <div ui-jp="easyPieChart" class="easyPieChart" ui-refresh="app.setting.color" data-redraw="true"
                          data-percent="45" ui-options="{
	                      lineWidth: 8,
	                      trackColor: 'rgba(0,0,0,0.05)',
	                      barColor: '#fcc100',
	                      scaleColor: 'transparent',
	                      size: 100,
	                      scaleLength: 0,
	                      animate:{
	                        duration: 3000,
	                        enabled:true
	                      }
	                    }">
                          <div>
                            <h5>45%</h5>
                          </div>
                          <canvas height="150" width="150" style="height: 100px; width: 100px;"></canvas>
                        </div>
                      </div>
                      <div>
                        Remaining
                        <small class="block m-b">205</small>
                        <a href="" class="btn btn-sm white rounded">Manage</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="box">
                <div class="box-header">
                  <h3>Your projects</h3>
                  <small>Calculated in last 30 days</small>
                </div>
                <div class="box-tool">
                  <ul class="nav">
                    <li class="nav-item inline">
                      <a class="nav-link">
                        <i class="material-icons md-18"></i>
                      </a>
                    </li>
                    <li class="nav-item inline dropdown">
                      <a class="nav-link" data-toggle="dropdown">
                        <i class="material-icons md-18"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-scale pull-right">
                        <a class="dropdown-item" href="">This week</a>
                        <a class="dropdown-item" href="">This month</a>
                        <a class="dropdown-item" href="">This week</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item">Today</a>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="box-body">
                  <div ui-jp="plot" ui-refresh="app.setting.color" ui-options="
	              [
	                { data: [[1, 3], [2, 2.6], [3, 3.2], [4, 3], [5, 3.5], [6, 3], [7, 3.5]], 
	                  points: { show: true, radius: 0}, 
                  	  splines: { show: true, tension: 0.45, lineWidth: 2, fill: 0.2 } 
	                },
	                { data: [[1, 3.6], [2, 3.5], [3, 6], [4, 4], [5, 4.3], [6, 3.5], [7, 3.6]], 
	                  points: { show: true, radius: 0}, 
                  	  splines: { show: true, tension: 0.45, lineWidth: 2, fill: 0.1 } 
	                }
	              ], 
	              {
	                colors: ['#fcc100','#0cc2aa'],
	                series: { shadowSize: 3 },
	                xaxis: { show: true, font: { color: '#ccc' }, position: 'bottom' },
	                yaxis:{ show: true, font: { color: '#ccc' },  min: 2},
	                grid: { hoverable: true, clickable: true, borderWidth: 0, color: 'rgba(120,120,120,0.5)' },
	                tooltip: true,
	                tooltipOpts: { content: '%x.0 is %y.4',  defaultTheme: false, shifts: { x: 0, y: -40 } }
	              }
	            " style="height: 200px; padding: 0px; position: relative;">
                    <canvas class="flot-base" width="435" height="300"
                      style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 290px; height: 200px;"></canvas>
                    <div class="flot-text"
                      style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                      <div class="flot-x-axis flot-x1-axis xAxis x1Axis"
                        style="position: absolute; inset: 0px; display: block;">
                        <div
                          style="position: absolute; max-width: 41px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 17px; text-align: center;">
                          1</div>
                        <div
                          style="position: absolute; max-width: 41px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 62px; text-align: center;">
                          2</div>
                        <div
                          style="position: absolute; max-width: 41px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 106px; text-align: center;">
                          3</div>
                        <div
                          style="position: absolute; max-width: 41px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 151px; text-align: center;">
                          4</div>
                        <div
                          style="position: absolute; max-width: 41px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 195px; text-align: center;">
                          5</div>
                        <div
                          style="position: absolute; max-width: 41px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 240px; text-align: center;">
                          6</div>
                        <div
                          style="position: absolute; max-width: 41px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 284px; text-align: center;">
                          7</div>
                      </div>
                      <div class="flot-y-axis flot-y1-axis yAxis y1Axis"
                        style="position: absolute; inset: 0px; display: block;">
                        <div
                          style="position: absolute; top: 176px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                          2.0</div>
                        <div
                          style="position: absolute; top: 141px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                          3.0</div>
                        <div
                          style="position: absolute; top: 106px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                          4.0</div>
                        <div
                          style="position: absolute; top: 71px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                          5.0</div>
                        <div
                          style="position: absolute; top: 36px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                          6.0</div>
                        <div
                          style="position: absolute; top: 1px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                          7.0</div>
                      </div>
                    </div><canvas class="flot-overlay" width="435" height="300"
                      style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 290px; height: 200px;"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="box">
                <div class="box-header">
                  <h3>Your Sales</h3>
                  <small>A general overview of your sales</small>
                </div>
                <div class="box-tool">
                  <ul class="nav">
                    <li class="nav-item inline">
                      <a class="nav-link">
                        <i class="material-icons md-18"></i>
                      </a>
                    </li>
                    <li class="nav-item inline dropdown">
                      <a class="nav-link" data-toggle="dropdown">
                        <i class="material-icons md-18"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-scale pull-right">
                        <a class="dropdown-item" href="">This week</a>
                        <a class="dropdown-item" href="">This month</a>
                        <a class="dropdown-item" href="">This week</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item">Today</a>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="box-body">
                  <div ui-jp="plot" ui-refresh="app.setting.color" ui-options="
	              [
	                { data: [[1, 2], [2, 4], [3, 5], [4, 7], [5, 6], [6, 4], [7, 5], [8, 4]] },
	                { data: [[1, 2], [2, 3], [3, 2], [4, 5], [5, 4], [6, 3], [7, 4], [8, 2]] }
	              ], 
	              {
	                bars: { show: true, fill: true,  barWidth: 0.3, lineWidth: 2, order: 1, fillColor: { colors: [{ opacity: 0.2 }, { opacity: 0.2}] }, align: 'center'},
	                colors: ['#0cc2aa','#fcc100'],
	                series: { shadowSize: 3 },
	                xaxis: { show: true, font: { color: '#ccc' }, position: 'bottom' },
	                yaxis:{ show: true, font: { color: '#ccc' }},
	                grid: { hoverable: true, clickable: true, borderWidth: 0, color: 'rgba(120,120,120,0.5)' },
	                tooltip: true,
	                tooltipOpts: { content: '%x.0 is %y.4',  defaultTheme: false, shifts: { x: 0, y: -40 } }
	              }
	            " style="height: 200px; padding: 0px; position: relative;">
                    <canvas class="flot-base" width="435" height="300"
                      style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 290px; height: 200px;"></canvas>
                    <div class="flot-text"
                      style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                      <div class="flot-x-axis flot-x1-axis xAxis x1Axis"
                        style="position: absolute; inset: 0px; display: block;">
                        <div
                          style="position: absolute; max-width: 29px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 14px; text-align: center;">
                          1</div>
                        <div
                          style="position: absolute; max-width: 29px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 51px; text-align: center;">
                          2</div>
                        <div
                          style="position: absolute; max-width: 29px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 88px; text-align: center;">
                          3</div>
                        <div
                          style="position: absolute; max-width: 29px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 125px; text-align: center;">
                          4</div>
                        <div
                          style="position: absolute; max-width: 29px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 162px; text-align: center;">
                          5</div>
                        <div
                          style="position: absolute; max-width: 29px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 199px; text-align: center;">
                          6</div>
                        <div
                          style="position: absolute; max-width: 29px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 236px; text-align: center;">
                          7</div>
                        <div
                          style="position: absolute; max-width: 29px; top: 187px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 273px; text-align: center;">
                          8</div>
                      </div>
                      <div class="flot-y-axis flot-y1-axis yAxis y1Axis"
                        style="position: absolute; inset: 0px; display: block;">
                        <div
                          style="position: absolute; top: 176px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                          0</div>
                        <div
                          style="position: absolute; top: 132px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                          2</div>
                        <div
                          style="position: absolute; top: 89px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                          4</div>
                        <div
                          style="position: absolute; top: 45px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                          6</div>
                        <div
                          style="position: absolute; top: 2px; font: 400 11px / 13px Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(204, 204, 204); left: 0px; text-align: right;">
                          8</div>
                      </div>
                    </div><canvas class="flot-overlay" width="435" height="300"
                      style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 290px; height: 200px;"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
          {{-- <div class="row">
            <div class="col-md-6 col-xl-4">
              <div class="box light lt">
                <div class="box-header">
                  <span class="label success pull-right">52</span>
                  <h3>Members</h3>
                </div>
                <ul class="list no-border p-b">
                  <li class="list-item">
                    <a herf="" class="list-left">
                      <span class="w-40 avatar danger">
                        <span>C</span>
                        <i class="on b-white bottom"></i>
                      </span>
                    </a>
                    <div class="list-body">
                      <div><a href="">Chris Fox</a></div>
                      <small class="text-muted text-ellipsis">Designer, Blogger</small>
                    </div>
                  </li>
                  <li class="list-item">
                    <a herf="" class="list-left">
                      <span class="w-40 avatar purple">
                        <span>M</span>
                        <i class="on b-white bottom"></i>
                      </span>
                    </a>
                    <div class="list-body">
                      <div><a href="">Mogen Polish</a></div>
                      <small class="text-muted text-ellipsis">Writter, Mag Editor</small>
                    </div>
                  </li>
                  <li class="list-item">
                    <a herf="" class="list-left">
                      <span class="w-40 avatar info">
                        <span>J</span>
                        <i class="off b-white bottom"></i>
                      </span>
                    </a>
                    <div class="list-body">
                      <div><a href="">Joge Lucky</a></div>
                      <small class="text-muted text-ellipsis">Art director, Movie Cut</small>
                    </div>
                  </li>
                  <li class="list-item">
                    <a herf="" class="list-left">
                      <span class="w-40 avatar warning">
                        <span>F</span>
                        <i class="on b-white bottom"></i>
                      </span>
                    </a>
                    <div class="list-body">
                      <div><a href="">Folisise Chosielie</a></div>
                      <small class="text-muted text-ellipsis">Musician, Player</small>
                    </div>
                  </li>
                  <li class="list-item">
                    <a herf="" class="list-left">
                      <span class="w-40 avatar success">
                        <span>P</span>
                        <i class="away b-white bottom"></i>
                      </span>
                    </a>
                    <div class="list-body">
                      <div><a href="">Peter</a></div>
                      <small class="text-muted text-ellipsis">Musician, Player</small>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="box">
                <div class="box-header">
                  <h3>Tasks</h3>
                  <small>20 finished, 5 remaining</small>
                </div>
                <div class="box-tool">
                  <ul class="nav">
                    <li class="nav-item inline dropdown">
                      <a class="nav-link text-muted p-x-xs" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-scale pull-right">
                        <a class="dropdown-item" href="">New task</a>
                        <a class="dropdown-item" href="">Make all finished</a>
                        <a class="dropdown-item" href="">Make all unfinished</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item">Settings</a>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="box-body">
                  <div class="streamline b-l m-l">
                    <div class="sl-item b-success">
                      <div class="sl-icon">
                        <i class="fa fa-check"></i>
                      </div>
                      <div class="sl-content">
                        <div class="sl-date text-muted">8:30</div>
                        <div>Call to customer <a href="" class="text-info">Jacob</a> and discuss the detail about the AP
                          project.</div>
                      </div>
                    </div>
                    <div class="sl-item b-info">
                      <div class="sl-content">
                        <div class="sl-date text-muted">Sat, 5 Mar</div>
                        <div>Prepare for presentation</div>
                      </div>
                    </div>
                    <div class="sl-item b-warning">
                      <div class="sl-content">
                        <div class="sl-date text-muted">Sun, 11 Feb</div>
                        <div><a href="" class="text-info">Jessi</a> assign you a task <a href=""
                            class="text-info">Mockup Design</a>.</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-footer">
                  <a href="" class="btn btn-sm btn-outline b-info rounded text-u-c pull-right">Add one</a>
                  <a href="" class="btn btn-sm white text-u-c rounded">More</a>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-xl-4">
              <div class="box">
                <div class="box-header">
                  <span class="label success pull-right">5</span>
                  <h3>Activity</h3>
                  <small>10 members update their activies.</small>
                </div>
                <div class="box-body">
                  <div class="streamline b-l m-b m-l">
                    <div class="sl-item">
                      <div class="sl-left">
                        <img src="{{asset('assets/images/a2.jpg')}}" class="img-circle">
                      </div>
                      <div class="sl-content">
                        <a href="" class="text-info">Louis Elliott</a><span class="m-l-sm sl-date">5 min ago</span>
                        <div>assign you a task <a href="" class="text-info">Mockup Design</a>.</div>
                      </div>
                    </div>
                    <div class="sl-item">
                      <div class="sl-left">
                        <img src="{{asset('assets/images/a5.jpg')}}" class="img-circle">
                      </div>
                      <div class="sl-content">
                        <a href="" class="text-info">Terry Moore</a><span class="m-l-sm sl-date">10 min ago</span>
                        <div>Follow up to close deal</div>
                      </div>
                    </div>
                    <div class="sl-item">
                      <div class="sl-left">
                        <img src="{{asset('assets/images/a8.jpg')}}" class="img-circle">
                      </div>
                      <div class="sl-content">
                        <a href="" class="text-info">Walter Paler</a><span class="m-l-sm sl-date">1 hour ago</span>
                        <div>was added to Repo</div>
                      </div>
                    </div>
                  </div>
                  <a href="" class="btn btn-sm white rounded text-u-c m-y-xs">Load More</a>
                </div>
              </div>
            </div>
          </div> --}}
          {{-- <div class="row">
            <div class="col-md-12 col-xl-4">
              <div class="box">
                <div class="box-header">
                  <h3>Messages</h3>
                </div>
                <ul class="list-group no-border">
                  <li class="list-group-item">
                    <a href="" class="pull-left w-40 m-r"><img src="{{asset('assets/images/a1.jpg')}}"
                        class="img-responsive img-circle"></a>
                    <div class="clear">
                      <a href="" class="_500 block">Jonathan Doe</a>
                      <span class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit</span>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <a href="" class="pull-left w-40 m-r"><img src="{{asset('assets/images/a2.jpg')}}"
                        class="img-responsive img-circle"></a>
                    <div class="clear">
                      <a href="" class="_500 block">Jack Michale</a>
                      <span class="text-muted">Sectetur adipiscing elit</span>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <a href="" class="pull-left w-40 m-r"><img src="{{asset('assets/images/a3.jpg')}}"
                        class="img-responsive img-circle"></a>
                    <div class="clear">
                      <a href="" class="_500 block">Jessi</a>
                      <span class="text-muted">Sectetur adipiscing elit</span>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <a href="" class="pull-left w-40 m-r"><img src="{{asset('assets/images/a4.jpg')}}"
                        class="img-responsive img-circle"></a>
                    <div class="clear">
                      <a href="" class="_500 block">Sodake</a>
                      <span class="text-muted">Vestibulum ullamcorper sodales nisi nec condimentum</span>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="box indigo-900 lt">
                <div class="box-header b-b">
                  <h2>Latest Tweets</h2>
                </div>
                <ul class="list">
                  <li class="list-item">
                    <div class="list-body">
                      <p>Wellcome <a href="" class="text-info">@Drew Wllon</a> and play this web application template,
                        have fun1 </p>
                      <small class="block text-muted"><i class="fa fa-fw fa-clock-o"></i> 2 minuts ago</small>
                    </div>
                  </li>
                  <li class="list-item">
                    <div class="list-body">
                      <p>Morbi nec <a href="" class="text-info">@Jonathan George</a> nunc condimentum ipsum dolor sit
                        amet, consectetur</p>
                      <small class="block text-muted"><i class="fa fa-fw fa-clock-o"></i> 1 hour ago</small>
                    </div>
                  </li>
                  <li class="list-item">
                    <div class="list-body">
                      <p><a href="" class="text-info">@Josh Long</a> Vestibulum ullamcorper sodales nisi nec adipiscing
                        elit. Morbi id neque quam</p>
                      <small class="block text-muted"><i class="fa fa-fw fa-clock-o"></i> 2 hours ago</small>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="box">
                <div class="box-header">
                  <h3>Feeds</h3>
                </div>
                <div class="box-divider m-a-0"></div>
                <ul class="list no-border">
                  <li class="list-item">
                    <a herf="" class="pull-left m-r">
                      <span class="w-40">
                        <img src="{{asset('assets/images/b1.jpg')}}" class="w-full" alt="...">
                      </span>
                    </a>
                    <div class="clear">
                      <a href="" class="_500 text-ellipsis">The people who party before work</a>
                      <small class="text-muted">May 12</small>
                    </div>
                  </li>
                  <li class="list-item">
                    <a herf="" class="pull-left m-r">
                      <span class="w-40">
                        <img src="{{asset('assets/images/b2.jpg')}}" class="w-full" alt="...">
                      </span>
                    </a>
                    <div class="clear">
                      <a href="" class="_500 text-ellipsis">Robot steal your job</a>
                      <small class="text-muted">May 9, 2015</small>
                    </div>
                  </li>
                  <li class="list-item">
                    <a herf="" class="pull-left m-r">
                      <span class="w-40">
                        <img src="{{asset('assets/images/b3.jpg')}}" class="w-full" alt="...">
                      </span>
                    </a>
                    <div class="clear">
                      <a href="" class="_500 text-ellipsis">Reservoir dogs and furious rabies</a>
                      <small class="text-muted">Jan 9, 2015</small>
                    </div>
                  </li>
                  <li class="list-item">
                    <a herf="" class="pull-left m-r">
                      <span class="w-40">
                        <img src="{{asset('assets/images/b4.jpg')}}" class="w-full" alt="...">
                      </span>
                    </a>
                    <div class="clear">
                      <a href="" class="_500 text-ellipsis">Changing the world</a>
                      <small class="text-muted">Jan 5, 2015</small>
                    </div>
                  </li>
                  <li class="list-item">
                    <a herf="" class="pull-left m-r">
                      <span class="w-40">
                        <img src="{{asset('assets/images/b5.jpg')}}" class="w-full" alt="...">
                      </span>
                    </a>
                    <div class="clear">
                      <a href="" class="_500 text-ellipsis">See stars</a>
                      <small class="text-muted">Jan 2, 2015</small>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div> --}}

        <!-- ############ PAGE END-->

      </div>
    </div>
    <!-- / -->

    @include('includes.footer'); 