@include('includes.header');  

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
      @include('includes.head');
      <div ui-view="" class="app-body" id="view">
        
  <!-- ############ PAGE START-->
  <div class="padding">
   
  
    <div class="box">
      <div class="box-header" style="display: ruby-text;">
        <h2>User List </h2> 
    </div>
       
       
      <div class="table-responsive">
        <table class="table table-bordered m-a-0">
         
          <thead>
            <tr style="background: #302e2e;">
            
              <th>User Id</th>
              <th>Telegram Id</th>
              <th>first Name</th>
              <th>Last Name</th>
              <th>Wallet</th>
              <th>statu</th>
             
            </tr>
          </thead>
          <tbody>
            @foreach ($user as $user)
            <tr>
             
              <td>{{ $user->id }}</td>
              <td>{{ $user->telegram_id }}</td>
              <td>{{ $user->first_name }}</td>
              <td>{{ $user->last_name }}</td>
              <td>{{ $user->wallet }}</td>
              @if ($user->status == 1)
              <td style="color: #edfc43">Free Packeg</td>
              @else
              <td style="color: #00c853  ">Paid Packeg</td>
                  
              @endif
               
            </tr>
            @endforeach
           
          </tbody>
        </table>
      
      </div>
    </div>
  </div>
  
  <!-- ############ PAGE END-->
  
      </div>
    </div>
    <!-- / -->

    @include('includes.footer'); 
   