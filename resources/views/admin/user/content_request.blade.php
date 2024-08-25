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
    
     
        <form action="{{ route('admin.contact_status_change', $request_accept->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="box">
              <div class="box-header">
                <h2>Send User Amount</h2>
              </div>
              <div class="box-body">
                <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Telegram_Id</label>
                    <div class="col-sm-9">
                    <input type="text" name="telegram_id" value="{{ $request_accept->telegram_id }}" class="form-control" required="" readonly>  
                    </div>                      
                  </div>
<<<<<<< HEAD
                  {{-- <div class="form-group row">
=======
                  <div class="form-group row">
>>>>>>> 9e6cd4e14bc9cf82a6cd2845d47a40224bd14bba
                    <label class="col-sm-3 form-control-label">Amount</label>
                    <div class="col-sm-9">
                    <input type="text" name="amount"  class="form-control" required="" placeholder="Enter Send Amount">  
                    </div>                      
<<<<<<< HEAD
                  </div> --}}
=======
                  </div>
>>>>>>> 9e6cd4e14bc9cf82a6cd2845d47a40224bd14bba
                 
                  
                  
                
                 <div class="dker p-a text-right">
                <button type="submit" class="btn info">Send </button>
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