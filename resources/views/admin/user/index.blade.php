@include('includes.header');  

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
      @include('includes.head');
      <div ui-view="" class="app-body" id="view">
        
  <!-- ############ PAGE START-->
  <div class="padding">
    <div class="margin">
      <h5 class="m-b-0 _300">Digitron, Welcome back</h5>
      
      
    </div>
   
  
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
              <th>Investment</th>
              <th>Status</th>
             
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $users)
            <tr>
              @if ($users->first_name == null)
                <td>....</td>
                @else
                <td>{{$users->first_name}}</td>
              @endif
                
                <td>{{$users->telegram_id}}</td>
                <td>{{$users->referral_by}}</td>
                <td>{{$users->wallet}}</td>
                <td> 
                  <div class="reveal-container">
                    <div class="revealed-text">User Investment</div>
                    <a class="reveal-button" href="{{route('admin.user_investment', $users->id)}}">
                 <i class="fa fa-external-link text-success"></i>
                  </a>
                  </div>
                </td>
                @if ($users->status ==1)
                <td style="color: #e4e136">Free Package </td> 
                @else
                <td style="color: #32f10c"> Paid Package </td>
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
   