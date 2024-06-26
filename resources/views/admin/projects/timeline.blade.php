@extends('layouts.master')

@section('pagescripts')
    <link href="{{ asset('assets/css/apps/ecommerce.css') }}" rel="stylesheet" type="text/css" />
@endsection

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
                          <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projects</a></li>
                          <li class="breadcrumb-item"><a href="{{ route('admin.projects.show', $project->id) }}">{{ $project->title }}</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><span>Timeline</span></li>
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

        <div class="col-md-12">
            @livewire('project-activity', ['project_id' => $project->id, 'content' => 'full'])
        </div>
    </div>
</div>


@endsection

@section('pagescripts')
    <script src="{{ asset('assets/js/apps/ecommerce.js') }}"></script>
@endsection