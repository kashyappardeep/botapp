@include('includes.header');  

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
      @include('includes.head');
      <div ui-view="" class="app-body" id="view">
        
  <!-- ############ PAGE START-->
  <div class="padding">
   
  
    <div class="box">
      <div class="box-header" style="display: ruby-text;">
        <h2>Users Claim Historys </h2> 
    </div>
       
       
      <div class="table-responsive">
        <table class="table table-bordered m-a-0">
         
          <thead>
            <tr style="background: #302e2e;">
            
              <th>User Id</th>
              <th>Telegram Id</th>
              <th>Amount</th>
             
            </tr>
          </thead>
          <tbody>
            @foreach ($ClaimHistory as $ClaimHistory)
            <tr>
             
              <td>{{ $ClaimHistory->user_id }}</td>
              <td>{{ $ClaimHistory->telegram_id }}</td>
              <td>{{ $ClaimHistory->amount }}</td>
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
   