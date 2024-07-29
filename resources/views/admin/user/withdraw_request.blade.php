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
              <th>address</th>
              <th>amount</th>
              <th>Status</th>
             
            </tr>
          </thead>
          <tbody>
            @foreach ($Withdraw as $Withdraw)
            <tr>
              @if ($Withdraw->user->first_name == null)
                <td>....</td>
                @else
                <td>{{$Withdraw->id}}</td>
              @endif
                
                <td>{{$user->address}}</td>
                <td>{{$user->amount}}</td>
                @if ($user->status ==1)
                <td style="color: #e4e136">Pending Requser </td> 
                @else
                <td style="color: #32f10c"> Complete </td>
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
   