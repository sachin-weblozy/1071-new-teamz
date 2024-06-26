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
                          <li class="breadcrumb-item active" aria-current="page"><span>Spaces</span></li>
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
    <div class="layout-top-spacing mb-2">
        <div class="col-md-12">
            <div class="row">
                <div class="container-fluid">
                    <div class="row layout-top-spacing">
                        <div class="col-lg-12 layout-spacing">
                            <form action="{{ route('admin.spaces.store') }}" method="POST">
                            @csrf
                            <div class="statbox widget box box-shadow mb-4">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <div class="makeitSticky z">
                                                <h4>Add Space</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 ml-2">
                                        <div class="mt-2">
                                            <div class="form-group row">
                                                <label class="col-3">Name</label>
                                                <div class="col-9">
                                                    <input class="form-control form-control-solid" type="text" name="name" placeholder="Space Name" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3">Description (optional)</label>
                                                <div class="col-9">
                                                    <input class="form-control form-control-solid" type="text" name="description" placeholder="Description" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3">Select Project</label>
                                                <div class="col-9">
                                                    <select name="project" id="" class="form-control form-control-solid" required>
                                                        <option value="" selected disabled>Select Project</option>
                                                        @foreach($projects as $project)
                                                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-footer text-right">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <a href="{{ route('admin.spaces.index') }}" class="btn btn-outline-primary">Cancel</a>
                                </div>
                            </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection