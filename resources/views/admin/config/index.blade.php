@include('includes.header');  

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
      @include('includes.head');
      <div ui-view="" class="app-body" id="view">
        
  <!-- ############ PAGE START-->
  <div class="padding">
   
  
    <div class="box">
        <div class="box-header" style="display: ruby-text;">
            <span> <h2>Confin List
              </h2> </span>
              <a href="{{route('Config.create')}}"><button type="button" class="btn btn-sm info">Add +</button> </a>
           </div>
       
       
      <div class="table-responsive">
        <table class="table table-bordered m-a-0">
         
          <thead>
            <tr style="background: #302e2e;">
            
            
              <th>daily_roi </th>
              <th>admin_wallet_address</th>
              <th>level_of_referral</th>
              <th>gateway_key</th>
              <th>content_reward</th>
              <th>Edit</th>
              <th>Delete</th>
              
             
            </tr>
          </thead>
          <tbody>
            @foreach ($Config as $Config)
            <tr>
             
                <td>{{$Config->daily_roi}}</td>
                <td>{{$Config->admin_wallet_address}}</td>
                @if ($Config->level_of_referral == null)
                <td>....</td>
                @else
                <td>{{$Config->level_of_referral}}</td>
              @endif
              
                @if ($Config->gateway_key == null)
                <td>....</td>
                @else
                <td>{{$Config->gateway_key}}</td>
              @endif
              <td>{{$Config->content_reward}}</td>
              <td>
                <a href="{{route('Config.update',$Config->id)}}">
                  <i class="fa fa-edit text-success"></i></a>
                </td>
                <td>
                  <form action="{{ route('Config.destroy',$Config->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: none;"><i class="fa fa-trash-o" style="color: red;"></i></button>
                </form>
                  {{-- <a href="{{route('fiat_currencies.destroy',$FiatCurrency->id)}}"></a> --}}
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
   