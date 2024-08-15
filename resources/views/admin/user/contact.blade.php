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
        <h2>Users Content and Earn Data</h2> 
    </div>
       
       
      <div class="table-responsive">
        <table class="table table-bordered m-a-0">
         
          <thead>
            <tr style="background: #302e2e;">
            
              <th>Link</th>
              <th>Telegram Id</th>
              <th>Link Verify Id</th>
              <th>Date And Time</th>
              <th>Status</th>
             
            </tr>
          </thead>
          <tbody>
            @foreach ($contect as $contect)
            <tr>
             
              <td>{{ $contect->link }}</td>
              <td>{{ $contect->telegram_id }}</td>
              <td>{{ $contect->linkverify_id }}</td>
              <td>{{ \Carbon\Carbon::parse($contect->created_at)->timezone('Asia/Kolkata')->format('Y-m-d H:i:s') }}</td>
                
              {{-- <td>{{ $contect->created_at }}</td> --}}
              @if ($contect->status ==1)
                <td style="color: #e4e136">Pending Request </td> 
                @elseif($contect->status ==2)
                <td style="color: #32f10c"> Complete </td>
                @else
                <td style="color: #f82b02">Rrejected </td>
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
   