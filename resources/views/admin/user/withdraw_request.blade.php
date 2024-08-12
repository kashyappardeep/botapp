@include('includes.header');  

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
      @include('includes.head');
      <div ui-view="" class="app-body" id="view">
        
  <!-- ############ PAGE START-->
  <div class="padding">
   
  
    <div class="box">
      <div class="box-header" style="display: ruby-text;">
        <span> <h2>Withdraw Users Request List
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
            @foreach ($Withdraw as $Withdraw)
            <tr>
              @if ($Withdraw && $Withdraw->user && $Withdraw->user->first_name)
    <td>{{ $Withdraw->user->first_name}}</td>
@else
    <td>{{$Withdraw->id}}</td>
@endif
                
                <td>{{$Withdraw->address}}</td>
                <td>{{$Withdraw->amount}}</td>
                @if ($Withdraw->status ==1)
                <td style="color: #e4e136">Pending Requser </td> 
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
   