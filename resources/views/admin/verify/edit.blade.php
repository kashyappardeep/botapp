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
    
     
        <form ui-jp="parsley" action="{{route('verify.verify', $data->id)}}" method="post">
            @csrf @method('PUT')
            <div class="box">
              <div class="box-header">
                <h2>Update Description</h2>
              </div>
              <div class="box-body">
                <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Update Description</address></label>
                    <div class="col-sm-9">
                    <input type="text" name="description" value="{{ $data->description }}" class="form-control" required="">  
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 form-control-label">Update Type  </address></label>
                    <div class="col-sm-9">
                      <select name="type" class="form-control" required>
                        <option value="1" {{ $data->type == 1 ? 'selected' : '' }}>Instagram</option>
                        <option value="2" {{ $data->type == 2 ? 'selected' : '' }}>Earn by Facebook</option>
                      </select>
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 form-control-label">Update Status</address></label>
                    <div class="col-sm-9">
                      <select name="status" class="form-control" required>
                        <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>inactive</option>
                        <option value="2" {{ $data->status == 2 ? 'selected' : '' }}>active</option>
                      </select>
                    </div>
                                              
                  </div>
                 
                  
                  
                
                 <div class="dker p-a text-right">
                <button type="submit" class="btn info">Update</button>
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