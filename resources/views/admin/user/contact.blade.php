@include('includes.header')  

<!-- content -->
<div id="content" class="app-content box-shadow-z0" role="main">
  @include('includes.head')
  <div ui-view="" class="app-body" id="view">
    
    <!-- ############ PAGE START -->
    <div class="padding">
      @php
      use Carbon\Carbon;
      @endphp
      
      <div class="box">
        <div class="box-header" style="display: ruby-text;">
          <h2>Users Content and Earn Data</h2> 
          <form method="GET" action="{{ route('admin.contact_request') }}">
            
            <select name="status" class="btn btn-sm info" onchange="this.form.submit()">
              <option value="" {{ is_null(request('1')) || request('1') === '' ? 'selected' : '' }}>Select Request</option>
              <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Pending Request</option>
              <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Complete</option>
              <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Rejected</option>
          </select>
        </form> 
        </div>
        
        <div class="table-responsive">
          <table class="table table-bordered m-a-0">
            <thead>
              <tr style="background: #302e2e;">
                <th>Link</th>
                <th>Telegram Id</th>
                <th>Type</th>
                <th>Link Verify Id</th>
                <th>Date And Time</th>
                <th>Status</th>
                <th>Verify</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($contect as $contect)
              <tr>
                <td>{{ $contect->link }}</td>
                <td>{{ $contect->telegram_id }}</td>
                @if ($contect->type == 1)
                <td>Instagram</td>
                @else
                <td>Facebook</td>
                @endif
                <td>@if($contect->linkVerify)
                  {{ $contect->linkVerify->description }}
              @else
                  No Description Available
              @endif</td>
                <td>
                  @if ($contect->created_at)
                    {{ \Carbon\Carbon::parse($contect->created_at)->timezone('Asia/Kolkata')->format('Y-m-d H:i:s') }}
                  @else
                    No Date
                  @endif
                </td>
                
                @if ($contect->status == 1)
                  <td style="color: #e4e136">Pending Request</td> 
                @elseif ($contect->status == 2)
                  <td style="color: #32f10c">Complete</td>
                @else
                  <td style="color: #f82b02">Rejected</td>
                @endif
                <td style="    display: flex;">
                  @if($contect->status ==1)
                  <form action="{{ route('admin.ShowcontacttStatus', $contect->id) }}" method="GET">
                    @csrf
                    <button type="submit" class="open-modal" data-id="" data-toggle="modal" data-target="#inputModal" style="background: none;">
                        <i class="fa fa-check" style="color: #00c853;"></i>
                    </button>
                </form>
                
                @else
                <button type="submit" class="open-modal" data-id="" data-toggle="modal" data-target="#inputModal" style="background: none;">
                  <i class="fa fa-check" style="color: #00c853;"></i>
              </button>
              @endif
                
                  &nbsp;
                  @if($contect->status ==1)
                 <form action="{{ route('admin.contact_reject_Status', $contect->id) }}" method="POST">
                      @csrf
                      @method('POST')
                      <input type="hidden" name="status" value="2">
                  <button type="submit" style="background: none;">
                      <i class="fa fa-remove" style="color: red;"></i>
                  </button>
              </form>
              @else
              <button type="submit" class="open-modal" data-id="" data-toggle="modal" data-target="#inputModal" style="background: none;">
                <i class="fa fa-remove" style="color: #f60505;"></i>
            </button>
            @endif
              </td> 
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- ############ PAGE END -->
  </div>
</div>
<!-- / -->

@include('includes.footer')
