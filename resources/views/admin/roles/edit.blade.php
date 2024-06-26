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
                          <li class="breadcrumb-item active" aria-current="page"><span>Edit Role</span></li>
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
                            <form action="{{ route('admin.roles.update',$role->id) }}" method="POST">
                            @csrf @method('PUT')
                                <div class="statbox widget box box-shadow mb-4">
                                    <div class="widget-header">
                                        <div class="row">
                                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                <div class="makeitSticky z">
                                                    <h4>Manage Permissions for {{ $role->name ?? '' }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 ml-2">
                                            <div class="mt-2">
                                                <div class="form-group row">
                                                    <label class="col-3">Permissions</label>
                                                    <div class="col-9">
                                                        <div class="checkbox-inline">
                                                        @forelse($permissions as $permission)
                                                        <label class="checkbox">
															<input type="checkbox"  name="permissions[]" value="{{$permission->name}}"  @if(count($role->permissions->where('id',$permission->id))) checked="checked" checked @endif>
															<span></span>{{ $permission->name }}
                                                        </label>
                                                        @empty 
                                                        no permission found, please create new permission 
                                                        @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-footer text-right">
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary">Cancel</a>
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