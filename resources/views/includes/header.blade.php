<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Cryptobarter Admin | Dashboard</title>
  <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="{{asset('assets/images/logo.png')}}">
  <meta name="apple-mobile-web-app-title" content="Cryptobarter">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="{{asset('assets/images/logo.png')}}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  
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

    <!-- aside -->
    <div id="aside" class="app-aside modal fade folded md nav-expand">
      <div class="left navside indigo-900 dk" layout="column">
        <div class="navbar navbar-md no-radius">
          <!-- brand -->
          <a class="navbar-brand">

            <img src="{{asset('assets/images/logo.png')}}" alt="." class="">
            <span class="hidden-folded inline">Bot App </span>
          </a>
          <!-- / brand -->
        </div>
        <div flex class="hide-scroll">
          <nav class="scroll nav-active-primary">

            <ul class="nav" ui-nav>
              

              <li>
                <a href="{{route('dashboard.index')}}">
                  <span class="nav-icon">
                    <i class="material-icons">&#xe3fc;
                      <span ui-include="'assets/images/i_0.svg'"></span>
                    </i>
                  </span>
                  <span class="nav-text">Dashboard</span>
                </a>
              </li>


              <li>
                <a href="{{route('Userlist.index')}}">
                  <span class="nav-icon">
                    <i class="fa fa-users">
                    </i>
                  </span>
                  <span class="nav-text">Users</span>
                </a>
                
              </li>
              <li>
                <a href="{{route('InvestmentHistory.index')}}">
                  <span class="nav-icon">
                    <i class="fa fa-history">
                    </i>
                  </span>
                  <span class="nav-text">Investment Historys</span>
                </a>
                </li>
                <li>
                  <a href="{{route('claim_history.index')}}">
                    <span class="nav-icon">
                      <i class="fa fa-history">
                      </i>
                    </span>
                    <span class="nav-text">Claim Historys</span>
                  </a>
                  </li>
                  <li>
                    <a>
                      <span class="nav-icon">
                        <i class="fa fa-users">
                        </i>
                      </span>
                      <span class="nav-text">Config</span>
                    </a>
                    </li>
                    <li>
                      <a>
                        <span class="nav-icon">
                          <i class="fa fa-level-up">
                          </i>
                        </span>
                        <span class="nav-text"> Levels</span>
                      </a>
                      </li>
                      <li>
                        <a>
                          
                          <span class="nav-icon">
                            <i class="fa fa-address-card"  aria-hidden="true">
                            </i>
                          </span>
                          <span class="nav-text">Address</span>
                        </a>
                        </li>
             
              <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                 
                  <span class="nav-icon">
                    <i class="fa fa-sign-out">
                    </i>
                  </span>
                  <span class="nav-text">Sign out</span>
                </a>
                
              </li>
             
              

            </ul>
          </nav>
        </div>
        <div flex-no-shrink>
          <div ui-include="'views/blocks/aside.bottom.0.html'"></div>
        </div>
      </div>
    </div>
  