@include('includes.header');  

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
      @include('includes.head');
      <div ui-view="" class="app-body" id="view">
        
  <!-- ############ PAGE START-->
  <div class="padding">
   
  
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
              <th>Status</th>
             
            </tr>
          </thead>
          <tbody>
            @foreach ($contect as $contect)
            <tr>
             
              <td>{{ $contect->link }}</td>
              <td>{{ $contect->telegram_id }}</td>
              <td>{{ $contect->linkverify_id }}</td>
              <td>{{ $contect->status }}</td>
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
   