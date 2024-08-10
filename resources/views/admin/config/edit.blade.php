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
    
      
        <form ui-jp="parsley" action="{{route('Config.update',$Config->id)}}" method="post">
            @csrf @method('PUT')
            <div class="box">
              <div class="box-header">
                <h2>Update Config</h2>
              </div>
              <div class="box-body">
                <div class="form-group row">
                    <label class="col-sm-3 form-control-label">daily_roi</label>
                    <div class="col-sm-9">
                    <input type="text" name="daily_roi" value="{{ $Config->daily_roi }}" class="form-control" required="">  
                    </div>                      
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">admin_wallet_address</label>
                    <div class="col-sm-9">
                    <input type="text" name="admin_wallet_address" value="{{ $Config->admin_wallet_address }}" class="form-control" required="">  
                    </div>                      
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">level_of_referral</label>
                    <div class="col-sm-9">
                    <input type="text" name="level_of_referral" value="{{ $Config->level_of_referral }}" class="form-control" required="">  
                    </div>                      
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">gateway_key</label>
                    <div class="col-sm-9">
                    <input type="text" name="gateway_key" value="{{ $Config->gateway_key }}" class="form-control" required="">  
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