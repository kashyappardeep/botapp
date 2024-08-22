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
        <span> <h2>Withdraw Users Request List
          </h2>   <form method="GET" action="{{ route('admin.withdraw_request') }}">
            
            <select name="status" class="btn btn-sm info" onchange="this.form.submit()">
              <option value="" {{ is_null(request('1')) || request('1') === '' ? 'selected' : '' }}>Select Request</option>
              <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Pending Request</option>
              <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Complete</option>
              <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Rejected</option>
          </select>
        </form></span>
       </div>
       
       
      <div class="table-responsive">
        <table class="table table-bordered m-a-0">
         
          <thead>
            <tr style="background: #302e2e;">
            
            
              <th>Name </th>
              <th>Telegram Id </th>
              <th>address</th>
              <th>amount</th>
              <th>Date and time</th>
              <th>Status</th>
              <th>Verify</th>
             
            </tr>
          </thead>
          <tbody>
            @foreach ($Withdraw as $Withdraw)
            <tr>
                                      
                <td>{{ $Withdraw->user->first_name}}</td>
                <td>{{$Withdraw->user->telegram_id}}</td>
                <td>{{$Withdraw->address}}</td>
                <td>{{$Withdraw->amount}}</td>
                <td>
                  @if ($Withdraw->created_at)
                    {{ \Carbon\Carbon::parse($Withdraw->created_at)->timezone('Asia/Kolkata')->format('Y-m-d H:i:s') }}
                  @else
                    No Date
                  @endif
                </td>
                {{-- <td>{{ \Carbon\Carbon::parse($Withdraw->created_at)->timezone('Asia/Kolkata')->format('Y-m-d H:i:s') }}</td> --}}
                
                {{-- <td>{{$Withdraw->created_at}}</td> --}}
                @if ($Withdraw->status ==1)
                <td style="color: #e4e136">Pending Request </td> 
                @elseif($Withdraw->status ==2)
                <td style="color: #32f10c"> Complete </td>
                @else
                <td style="color: hsl(0, 91%, 50%)">Rrejected </td>
                @endif
                
                <td style="    display: flex;">
                  @if($Withdraw->status ==1)
                  <form action="{{ route('admin.status_change', $Withdraw->id) }}" method="POST">
                    @csrf
                    @method('POST') <!-- Change to POST if your route uses POST -->
                    <button type="submit" class="open-modal" data-id="" data-toggle="modal" data-target="#inputModal" style="background: none;">
                        <i class="fa fa-check" style="color: #00c853;"></i>
                    </button>
                </form>
                @else
                <button type="submit" class="open-modal" data-id="" data-toggle="modal" data-target="#inputModal" style="background: none;">
                  <i class="fa fa-check" style="color: #00c853;"></i>
              </button>
              @endif
                
                  &nbsp;
                  @if($Withdraw->status ==1)
                 <form action="{{ route('admin.reject_Status', $Withdraw->id) }}" method="POST">
                      @csrf
                      @method('POST')
                      <input type="hidden" name="status" value="2">
                  <button type="submit" style="background: none;">
                      <i class="fa fa-remove" style="color: red;"></i>
                  </button>
              </form>
              @else
              <button type="submit" class="open-modal" data-id="" data-toggle="modal" data-target="#inputModal" style="background: none;">
                <i class="fa fa-remove" style="color: #f60505;"></i>
            </button>
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
   