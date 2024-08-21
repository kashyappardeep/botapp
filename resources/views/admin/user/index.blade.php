@include('includes.header');  
<style>
  .pagination-container {
    text-align: center;
    margin-top: 20px;
    height: 50px;
}
.pagination-container .hidden {
    display: none;
}
.pagination-container ul {
    list-style-type: none;
    padding: 0;
    display: inline-block;
}

.pagination-container li {
    display: inline;
    margin: 0 5px;
}

.pagination-container a {
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.pagination-container a:hover {
    background-color: #000;
}

.pagination-container .active a {
    background-color: #302e2e;
    color: white;
    border: 1px solid #302e2e;
}

.result-info {
    text-align: center;
    margin-top: 10px;
    font-size: 14px;
    color: #555;
}

  </style>
    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">
      @include('includes.head');
      <div ui-view="" class="app-body" id="view">
        
  <!-- ############ PAGE START-->
  <div class="padding">
    <div class="margin">
      <h5 class="m-b-0 _300">Digitron, Welcome back</h5>
      
      
    </div>
    @php
                use Carbon\Carbon;
                @endphp
  
    <div class="box">
      <div class="box-header" style="display: ruby-text;">
        <span> <h2>Users  List
          </h2> </span>
       </div>
       
       
      <div class="table-responsive">
        <table class="table table-bordered m-a-0">
          <thead>
              <tr style="background: #302e2e;">
                  <th>Lv.</th>
                  <th>Name</th>
                  <th>Telegram Id</th>
                  <th>Referral By</th>
                  <th>Wallet</th>
                  <th>Investment</th>
                  <th>Status</th>
                  <th>Date And Time</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($users as $user)
              <tr>
                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                  @if ($user->first_name == null)
                      <td>....</td>
                  @else
                      <td>{{ $user->first_name }}</td>
                  @endif
      
                  <td>{{ $user->telegram_id }}</td>
                  <td>{{ $user->referral_by }}</td>
                  <td>{{ $user->wallet }}</td>
                  <td>
                      <div class="reveal-container">
                          <div class="revealed-text">User Investment</div>
                          <a class="reveal-button" href="{{ route('admin.user_investment', $user->id) }}">
                              <i class="fa fa-external-link text-success"></i>
                          </a>
                      </div>
                  </td>
      
                  @if ($user->status == 1)
                      <td style="color: #e4e136">Free Package</td>
                  @else
                      <td style="color: #32f10c">Paid Package</td>
                  @endif
      
                  <td>
                      @if ($user->created_at)
                          {{ \Carbon\Carbon::parse($user->created_at)->timezone('Asia/Kolkata')->format('Y-m-d H:i:s') }}
                      @else
                          No Date
                      @endif
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      
      <!-- Pagination Controls -->
      <div class="pagination-container">
        <!-- Display the page count -->
        <div class="page-info">
            Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
        </div>
    
        <!-- Display the pagination links -->
        {{ $users->links() }}
    </div>
      
      
      
      
      </div>
    </div>
  </div>
  
  <!-- ############ PAGE END-->
  
      </div>
    </div>
    <!-- / -->

    @include('includes.footer'); 
   