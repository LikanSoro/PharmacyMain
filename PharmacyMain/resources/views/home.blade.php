@extends('layouts.app')

@section('content')
{{-- <h1 class="m-0">{{ __('Dashboard') }}</h1> --}}
<div class="row">
  <div class="col-lg-3">
      <div class="card">
          <div class="stat-widget-one">
              <div class="stat-icon dib"><i class="fas fa-rupee-sign color-success border-success"></i>
              </div>
              <div class="stat-content dib">
                  <div class="stat-text">Total Sales</div>
                  <div class="stat-digit">{{ $total }}</div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-3">
      <div class="card">
          <div class="stat-widget-one">
              <div class="stat-icon dib"><i class="ti-user color-primary border-primary"></i>
              </div>
              <div class="stat-content dib">
                  <div class="stat-text">Total Customers</div>
                  <div class="stat-digit">{{$customer}}</div>
              </div>
          </div>
      </div>
  </div>
  
  <div class="col-lg-3">
      <div class="card">
          <div class="stat-widget-one">
              <div class="stat-icon dib"><i class="ti-link color-danger border-danger"></i></div>
              <div class="stat-content dib">
                  <div class="stat-text">Due bills</div>
                  <div class="stat-digit">{{$due}}</div>
              </div>
          </div>
      </div>
  </div>
</div>

</div> 
    
@endsection