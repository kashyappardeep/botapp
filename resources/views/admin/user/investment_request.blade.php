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
        <span> <h2>Investment Users Request List
          </h2>
          
          <form method="GET" action="{{ route('admin.investment_request') }}">
            
            <select name="status" class="btn btn-sm info" onchange="this.form.submit()">
              <option value="" {{ is_null(request('1')) || request('1') === '' ? 'selected' : '' }}>Select Request</option>
              <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Pending Request</option>
              <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Complete</option>
              <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Rejected</option>
          </select>
        </form> </span>
          
       </div>
      
       
      <div class="table-responsive">
      <table class="table table-bordered m-a-0">
         
          <thead>
            <tr style="background: #302e2e;">
            
            
              <th>Name </th>
              <th>Telegram Id </th>
              <th>Address</th>
              <th>Amount</th>
<<<<<<< HEAD
=======
              <th>transaction </th>
>>>>>>> 9e6cd4e14bc9cf82a6cd2845d47a40224bd14bba
              <th>Date And Time</th>
              <th>Status</th>
              
              <th>Verify</th>
             
            </tr>
          </thead>
          <tbody>
            @foreach ($investment as $investment)
            <tr>
              @if ($investment->user !== null) 
              <td>{{ $investment->user->first_name}}</td>
            @else 
            <td>...</td>
            @endif
            @if ($investment->user !== null) 
            <td>{{ $investment->user->telegram_id}}</td>
            @else 
            <td>...</td>
            @endif
                  
                 
                
                <td>{{$investment->address}}</td>
                <td>{{$investment->amount}}</td>
<<<<<<< HEAD
=======
                <td>{{$investment->tx_hash}}</td>
>>>>>>> 9e6cd4e14bc9cf82a6cd2845d47a40224bd14bba
               <td> @if ($investment->created_at)
                {{ \Carbon\Carbon::parse($investment->created_at)->timezone('Asia/Kolkata')->format('Y-m-d H:i:s') }}
              @else
                No Date
              @endif</td>
            </td>
                {{-- <td>{{ \Carbon\Carbon::parse($investment->created_at)->timezone('Asia/Kolkata')->format('Y-m-d H:i:s') }}</td> --}}
                  {{-- <td>{{$investment->created_at}}</td> --}}
                @if ($investment->status ==1)
                <td style="color: #e4e136">Pending Request </td> 
                @elseif($investment->status ==2)
                <td style="color: #32f10c"> Complete </td>
                @else
                <td style="color: #f82b02">Rrejected </td>
                @endif
                
                <td style="    display: flex;">
                  @if($investment->status ==1)
                  <form action="{{ route('admin.invist_status_change', $investment->id) }}" method="POST">
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
                  @if($investment->status ==1)
                 <form action="{{ route('admin.invest_reject_Status', $investment->id) }}" method="POST">
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
   