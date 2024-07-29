@include('includes.header');  

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
      @include('includes.head');
      <div ui-view="" class="app-body" id="view">
        
  <!-- ############ PAGE START-->
  <div class="padding">
   
  
    <div class="box">
      <div class="box-header" style="display: ruby-text;">
        <span> <h2>Users  List
          </h2> </span>
       </div>
       
       
      <div class="table-responsive">
        <table class="table table-bordered m-a-0">
         
          <thead>
            <tr style="background: #302e2e;">
            
            
              <th>Name </th>
              <th>Telegram Id</th>
              <th>Referral By</th>
              <th>Wallet</th>
              <th>Status</th>
             
            </tr>
          </thead>
          <tbody>
            @foreach ($user as $user)
            <tr>
              @if ($user->first_name == null)
                <td>....</td>
                @else
                <td>{{$user->first_name}}</td>
              @endif
                
                <td>{{$user->telegram_id}}</td>
                <td>{{$user->referral_by}}</td>
                <td>{{$user->wallet}}</td>
                @if ($user->status ==1)
                <td style="color: #e4e136">Free Packeg </td> 
                @else
                <td style="color: #32f10c"> Paid Packeg </td>
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
   