@include('includes.header');  

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
      @include('includes.head');
      <div ui-view="" class="app-body" id="view">
        
  <!-- ############ PAGE START-->
  <div class="padding">
   
    @php
    use Carbon\Carbon;
    @endphp
    <div class="box">
        <div class="box-header" style="display: ruby-text;">
             <h2>User Investment Histroy
              </h2> 
           </div>
       
       
      <div class="table-responsive">
        <table class="table table-bordered m-a-0">
         
          <thead>
            <tr style="background: #302e2e;">
            
            
              <th>user_id </th>
              <th>telegram_id</th>
              <th>amount</th>
              <th>address</th>
              <th>invest_at</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($investment as $investment)
            <tr>
             
                <td>{{$investment->user_id}}</td>
                <td>{{$investment->user->telegram_id}}</td>
                <td>{{$investment->amount}}</td>
                <td>{{$investment->address}}</td>
                {{-- <td>{{$investment->invest_at}}</td> --}}
                <td>
                  @if ($investment->created_at)
                    {{ \Carbon\Carbon::parse($investment->created_at)->timezone('Asia/Kolkata')->format('Y-m-d H:i:s') }}
                  @else
                    No Date
                  @endif
                </td>
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
   