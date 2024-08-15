@include('includes.header');  

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
      @include('includes.head');
      <div ui-view="" class="app-body" id="view">
        
  <!-- ############ PAGE START-->
  <div class="padding">
   
  
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
              <th>address</th>
              <th>amount</th>
              <th>Date And Time</th>
              <th>Status</th>
              
              <th>Verify</th>
             
            </tr>
          </thead>
          <tbody>
            @foreach ($investment as $investment)
            <tr>
              @if ($investment && $investment->user && $investment->user->first_name)
            <td>{{ $investment->user->first_name}}</td>
                @else
                  <td>{{$investment->id}}</td>
                  @endif
                
                <td>{{$investment->address}}</td>
                <td>{{$investment->amount}}</td>
                <td>{{$investment->created_at}}</td>
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
   