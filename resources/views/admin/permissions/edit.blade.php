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
                          <li class="breadcrumb-item active" aria-current="page"><span>Permissions</span></li>
                      </ol>
                  </nav>
              </div>
          </li>
      </ul>
  </header>
</div>
{{ $role }}
<!--  Navbar Ends / Breadcrumb Area  -->
<!-- Main Body Starts -->
<div class="layout-px-spacing">
    <div class="layout-top-spacing mb-2">
        <div class="col-md-12">
            <div class="row">
                <div class="container-fluid">
                    <div class="row layout-top-spacing">
                        <div class="col-lg-12 layout-spacing">
                            {{-- <form action="{{ route('admin.permissions.update',$role->id) }}" method="POST"> --}}
                            @csrf @method('PUT')
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection