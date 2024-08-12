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
                @if ($investment->status ==1)
                <td style="color: #e4e136">Pending Requser </td> 
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
   