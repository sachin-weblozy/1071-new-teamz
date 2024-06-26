@extends('layouts.master')
   
@section('content')
<div class="sub-header-container">
  <header class="header navbar navbar-expand-sm">
      <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
          <i class="las la-bars"></i>
      </a>
      <ul class="navbar-nav flex-row">
          <li>
              <div class="page-header">
                  <nav class="breadcrumb-one" aria-label="breadcrumb">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                          {{-- <li class="breadcrumb-item"><a href="javascript:void(0);">{{ $project->title }}</a></li> --}}
                          <li class="breadcrumb-item active" aria-current="page"><span>{{ $space->name }}</span></li>
                      </ol>
                  </nav>
              </div>
          </li>
      </ul>
  </header>
</div>
<!--  Navbar Ends / Breadcrumb Area  -->
<!-- Main Body Starts -->
<div class="layout-px-spacing">                
    <div class="row layout-spacing layout-top-spacing" id="cancel-row">
        <div class="col-lg-12">
            <div class="">
                <div class="widget-content searchable-container grid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <div class="">
                                    <h5 class="header-title mb-3 d-inline">{{ $space->name }}</h5>
                                    <a href="{{ route('admin.spaces.addmembers',$space->id) }}" class="float-right btn btn-outline-primary">Add Members</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection