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
    
      
      <form ui-jp="parsley" action="{{route('Config.store')}}" method="post">
        @csrf
        <div class="box">
         
          <div class="box-header">
            <h2>Add Config</h2>
          </div>
          <div class="box-body">
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">Daily Roi</label>
              <div class="col-sm-9">
                <input type="text" name="daily_roi" class="form-control" required="">  
              </div>
              
            </div>
            <div class="form-group row">
                <label class="col-sm-3 form-control-label">Admin Wallet</label>
                <div class="col-sm-9">
                  <input type="text" name="admin_wallet_address" class="form-control" required="">
                </div>                     
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Level Of Referral</label>
                <div class="col-sm-9">
                <input type="text" name="level_of_referral" class="form-control" required="">  
                </div>                      
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Task Amount</label>
                <div class="col-sm-9">
                <input type="text" name="task_amount" class="form-control" required="">  
                </div>                      
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">Content Reward</label>
                <div class="col-sm-9">
                <input type="text" name="content_reward" class="form-control" required="">  
                </div>                      
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">min_withdrawal</label>
                <div class="col-sm-9">
                <input type="text" name="min_withdrawal" class="form-control" required="">  
                </div>                      
              </div>
              <div class="form-group row">
                <label class="col-sm-3 form-control-label">min_investment</label>
                <div class="col-sm-9">
                <input type="text" name="min_investment" class="form-control" required="">  
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