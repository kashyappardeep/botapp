@include('includes.header');




<div id="content" class="app-content box-shadow-z0" role="main">
  @include('includes.head');
   
    <div ui-view="" class="app-body" id="view">
      
<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-2">
    </div>
   
    <div class="col-sm-8">
    
      
      <form ui-jp="parsley" action="{{route('DailyTasks.update',$DailyTask->id)}}" method="post">
        @csrf @method('PUT')
        <div class="box">
         
          <div class="box-header">
            <h2>Daily Task </h2>
          </div>
          <div class="box-body">
            
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">Description</label>
              <div class="col-sm-9">
                <textarea name="description" class="form-control" required="" style="height: 127px;">{{ $DailyTask->description }}</textarea>

                {{-- <input type="text" name="description" value="{{ $DailyTask->description }}" class="form-control" required="">   --}}
              </div>
              
            </div>
            <div class="form-group row">
                <label class="col-sm-3 form-control-label">Amount</label>
                <div class="col-sm-9">
                  <input type="text" name="amount" value="{{$DailyTask->amount}}" class="form-control" required="">  
                </div>
                
              </div>
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">Add Type  </address></label>
                <div class="col-sm-9">
                  <select name="type" class="form-control" required>
                    <option value="1" {{ $DailyTask->type == 1 ? 'selected' : '' }}>Facebook</option>
                    <option value="2" {{ $DailyTask->type == 2 ? 'selected' : '' }}>Youtube</option>
                    
                  </select>
                </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">Add Status</address></label>
                <div class="col-sm-9">
                  <select name="status" class="form-control" required>
                    <option value="1" {{ $DailyTask->type == 1 ? 'selected' : '' }}>Active</option>
                    <option value="2" {{ $DailyTask->type == 2 ? 'selected' : '' }}>InActive</option>
                    
                  </select>
                </div>
                                          
              </div>
         
          </div>
          <div class="dker p-a text-right">
            <button type="submit" class="btn info">Submit</button>
          </div>
        </div>
      </form>
    </div>
    
  </div>
  

</div>

<!-- ############ PAGE END-->

    </div>
  </div>





@include('includes.footer'); 