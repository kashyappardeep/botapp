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
              <a href="{{route('verify.create')}}"><button type="button" class="btn btn-sm info">Add +</button> </a>
           </div>
       
       
      <div class="table-responsive">
        <table class="table table-bordered m-a-0">
         
          <thead>
            <tr style="background: #302e2e;">
            
            
              
              
              <th>Description</th>
              <th>Update/Edit</th>
              <th>Delete</th>
              
             
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $data)
            <tr>
             
                <td>{{$data->description}}</td>
                
              
                
              <td>
                <a href="{{route('verify.edit',$data->id)}}">
                  <i class="fa fa-edit text-success"></i></a>
                </td>
                <td>
                  <form action="{{ route('verify.destroy',$data->id) }}" method="POST">
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
   