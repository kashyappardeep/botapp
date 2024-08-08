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
              <a href="{{route('address.create')}}"><button type="button" class="btn btn-sm info">Add +</button> </a>
           </div>
       
       
      <div class="table-responsive">
        <table class="table table-bordered m-a-0">
         
          <thead>
            <tr style="background: #302e2e;">
            
            
              <th>User Id </th>
              
              <th>Address</th>
              <th>Update/Edit</th>
              <th>Delete</th>
              
             
            </tr>
          </thead>
          <tbody>
            @foreach ($address as $address)
            <tr>
             
                <td>{{$address->user_id}}</td>
                <td>{{$address->address}}</td>
              
                
              <td>
                <a href="{{route('address.edit',$address->id)}}">
                  <i class="fa fa-edit text-success"></i></a>
                </td>
                <td>
                  <form action="{{ route('address.destroy',$address->id) }}" method="POST">
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
   