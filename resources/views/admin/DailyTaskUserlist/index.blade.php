@include('includes.header');  

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
      @include('includes.head');
      <div ui-view="" class="app-body" id="view">
        
  <!-- ############ PAGE START-->
  <div class="padding">
   
  
    <div class="box">
        <div class="box-header" style="display: ruby-text;">
            <span> <h2>Daily Tasks List
              </h2> <form method="GET" action="{{ route('admin.contact_request') }}">
            
                <select name="status" class="btn btn-sm info" onchange="this.form.submit()">
                  <option value="" {{ is_null(request('1')) || request('1') === '' ? 'selected' : '' }}>Select Request</option>
                  <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Pending Request</option>
                  <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Complete</option>
                  <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Rejected</option>
              </select>
            </form> </span></div>
       
       
      <div class="table-responsive">
        <table class="table table-bordered m-a-0">
         
          <thead>
            <tr style="background: #302e2e;">
            
            
              
              
              <th>Name</th>
              <th>Telegram Id</th>
              <th>Description</th>
              <th>Link</th>
              <th>Amount</th>
              <th>Date</th>
              <th>Type</th>
              <th>Status</th>
              
              <th>Accept</th>
              <th>Reject</th>
             </tr>
          </thead>
          <tbody>
            @foreach ($DailyTask as $data)
            <tr>
             
                <td>{{$data->user->first_name}}</td>
                <td>{{$data->user->telegram_id}}</td>
                <td>{{$data->daily_task->description}}</td>
                <td>{{$data->link}}</td>
                <td>{{$data->amount}}</td>
                <td>{{$data->created_at}}</td>
                @if ($data->type == 1)
                <td>facebook</td>
                @else
                <td>Youtube</td>
                @endif
                
                @if ($data->status == 1)
                <td style="color: #d5de25">pending</td>
                @elseif ($data->status == 2)
                <td style="color: #00c753">Complete</td>
                @else
                <td style="color: #ed0e0a">Reject</td>
                @endif
                @if ($data->status == 1)
                <td>
                  <a href="{{route('TaskUserlist.show',$data->id)}}">
                    <button type="submit" style="background: none;">
                      <i class="fa fa-edit text-success"></i></button></a>
                  </td>
                  @else
                  <td> <button type="submit" style="background: none;">
                    <i class="fa fa-edit text-success"></i></button></td>
                  @endif
                  @if ($data->status == 1)
                  <td>
                    <form action="{{ route('TaskUserlist.destroy',$data->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" style="background: none;">
                        <i class="fa fa-trash-o" style="color: red;"></i></button>
                  </form>
                    {{-- <a href="{{route('fiat_currencies.destroy',$FiatCurrency->id)}}"></a> --}}
                    </td>
                    @else
                    <td> <button type="submit" style="background: none;">
                      <i class="fa fa-trash-o" style="color: red;"></i></button></td>
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
   