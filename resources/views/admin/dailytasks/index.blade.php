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
              </h2> </span>
              <a href="{{route('DailyTasks.create')}}"><button type="button" class="btn btn-sm info">Add +</button> </a>
           </div>
       
       
      <div class="table-responsive">
        <table class="table table-bordered m-a-0">
         
          <thead>
            <tr style="background: #302e2e;">
            
            
              
              
              <th>Description</th>
              <th>Amount</th>
              <th>Type</th>
              <th>Status</th>
              <th>Update/Edit</th>
              <th>Stop</th>
             </tr>
          </thead>
          <tbody>
            @foreach ($DailyTask as $data)
            <tr>
             
                <td>{{$data->description}}</td>
                <td>{{$data->amount}}</td>
                @if ($data->type == 1)
                <td> facebook</td>
                @else
                <td>Youtube</td>
                @endif
                
                @if ($data->status == 1)
                <td style="color: #00c753">Run</td>
                @else
                <td style="color: rgb(245, 13, 9)">Stop</td>
                @endif
                <td>
                  <a href="{{route('DailyTasks.edit',$data->id)}}">
                    <i class="fa fa-edit text-success"></i></a>
                  </td>
                  <td>
                    <form action="{{ route('DailyTasks.destroy',$data->id) }}" method="POST">
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
   