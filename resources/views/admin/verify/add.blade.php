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
    
      
      <form ui-jp="parsley" action="{{route('verify.store')}}" method="post">
        @csrf
        <div class="box">
         
          <div class="box-header">
            <h2>Add verify</h2>
          </div>
          <div class="box-body">
            
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">Description</label>
              <div class="col-sm-9">
                <input type="text" name="description" class="form-control" required="">  
              </div>
              
            </div>
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">Add Type  </address></label>
                <div class="col-sm-9">
                  <select name="type" class="form-control" required>
                    <option value="1">Instagram</option>
                    <option value="2">Earn by Facebook</option>
                  </select>
                </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">Add Status</address></label>
                <div class="col-sm-9">
                  <select name="status" class="form-control" required>
                    <option value="1">inactive</option>
                    <option value="2">active</option>
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