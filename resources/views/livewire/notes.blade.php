<div>
    <ul class="nav nav-pills p-3 mb-3 rounded align-items-center card flex-row">
        <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link gap-6 note-link d-flex align-items-center justify-content-center active px-3 px-md-3 me-0 me-md-2 fs-11" id="all-category">
            <i class="ti ti-list fill-white"></i>
            <span class="d-none d-md-block fw-medium">All Notes</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link gap-6 note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2 fs-11" id="note-important">
            <i class="ti ti-star fill-white"></i>
            <span class="d-none d-md-block fw-medium">Important</span>
          </a>
        </li>
        <li class="nav-item ms-auto">
          <a href="javascript:void(0)" class="btn btn-primary d-flex align-items-center px-3 gap-6" id="add-notes">
            <i class="ti ti-file fs-4"></i>
            <span class="d-none d-md-block fw-medium fs-3">Add Notes</span>
          </a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="note-full-container" class="note-has-grid row">
            @forelse($notes as $note)
            <div class="col-md-4 single-note-item all-category @if($note->starred==1) note-important @endif">
                <div class="card card-body">
                    <span class="side-stick"></span>
                    <h6 class="note-title text-truncate w-75 mb-0" data-noteHeading="Book a Ticket for Movie">{{ $note->title ?? '' }}</h6>
                    <p class="note-date fs-2">{{ Helper::formatDate($note->created_at ?? '') }}</p>
                    <div class="note-content">
                        <p class="note-inner-content" >{!! $note->description ?? '' !!}</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <a class="link me-1 " type="button" wire:click="toggleFavorite({{ $note->id }})">
                            <i class="ti ti-star fs-4 cursor-pointer"></i>
                        </a>
                        <a class="link text-danger ms-2 " type="button" wire:click="deleteNote({{ $note->id }})">
                            <i class="ti ti-trash fs-4 cursor-pointer"></i>
                        </a>
                        <div class="ms-auto">
                          <div class="category-selector btn-group">
                            <a class="nav-link category-dropdown label-group p-0" data-bs-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="true">
                              <div class="category">
                                <div class="category-business"></div>
                                <div class="category-social"></div>
                                <div class="category-important"></div>
                                <span class="more-options text-dark">
                                  <i class="ti ti-dots-vertical fs-5"></i>
                                </span>
                              </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right category-menu">
                              {{-- <a class="badge-group-item badge-business dropdown-item position-relative d-flex align-items-center" href="javascript:void(0);">Edit</a> --}}
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty 
            {{-- No Note Found --}}
            @endforelse
        </div>
      </div>


      <!-- Modal Add notes -->
      <div class="modal fade" id="addnotesmodal" tabindex="-1" role="dialog" aria-labelledby="addnotesmodalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content border-0">
            <div class="modal-header bg-primary rounded-top">
              <h6 class="modal-title text-white">Add Notes</h6>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.notes.store') }}" method="POST" id="addnotesmodalTitle">
              @csrf
              <div class="modal-body">
                <div class="notes-box">
                  <div class="notes-content">
                      <div class="row">
                        <div class="col-md-12 mb-3">
                          <div class="note-title">
                            <label class="form-label">Note Title</label>
                            <input type="text" name="title" id="note-has-title" class="form-control"  placeholder="Title" />
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="note-description">
                            <label class="form-label">Note Description</label>
                            <textarea id="note-has-description" name="description" class="form-control" placeholder="Description" rows="3"></textarea>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <div class="d-flex gap-6">
                  <a class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal">Discard</a>
                  <button  class="btn btn-primary" type="submit">Add</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      

    </div>
</div>
