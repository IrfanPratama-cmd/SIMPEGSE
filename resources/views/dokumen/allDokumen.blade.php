@extends('admin.main')

@section('container')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item">Data Dokumen</li>
                    <li class="breadcrumb-item active">{{ $Tmdokumen->nama_dokumen }}</li>
                </ol>
            </div>
            <h2>Data Dokumen</h2>
        </div>
    </div>
</div>   

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h2 class="text-info">{{ $Tmdokumen->nama_dokumen }}</h2>
                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="app-search">
                        <form>
                            <div class="mb-2 position-relative">
                                <input type="text" class="form-control" placeholder="Search files...">
                                <span class="mdi mdi-magnify search-icon"></span>
                            </div>
                        </form>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-sm btn-light"><i class="mdi mdi-format-list-bulleted"></i></button>
                        <button type="submit" class="btn btn-sm"><i class="mdi mdi-view-grid"></i></button>
                        <button type="submit" class="btn btn-sm"><i class="mdi mdi-information-outline"></i></button>
                    </div>
                </div>

                <div class="mt-3">
                    <h5 class="mb-2">Quick Access</h5>

                        <div class="row mx-n1 g-0">
                            @foreach($dokumen as $d)
                                <div class="col-xxl-3 col-lg-6">
                                    <div class="card m-1 shadow-none border">
                                        <div class="p-2">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="avatar-sm">
                                                        <div class="btn-group btn-primary-outline dropdown">
                                                        <a href="#" class="dropdown-toggle arrow-none btn btn-light btn-xs" data-bs-toggle="dropdown" aria-expanded="false">
                                                            @if($d->extension == "pdf")
                                                                <i class="mdi mdi-file-pdf font-16"></i>
                                                            @elseif($d->extension == "doc" || $d->extension == "docx")
                                                                <i class="mdi mdi-file-document font-16"></i>
                                                            @elseif($d->extension == "png" || $d->extension == "jpg" || $d->extension == "jpeg")
                                                                <i class="mdi mdi-file-image font-16"></i>
                                                            @else
                                                                <i class="mdi mdi-folder-zip font-16"></i>
                                                            @endif
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-pencil me-2 text-muted vertical-middle"></i>Rename</a>
                                                            <a class="dropdown-item" href="/downloadDokumen/{{ $Tmdokumen->folder }}/{{ $d->nama_file }}"><i class="mdi mdi-download me-2 text-muted vertical-middle"></i>Download</a>
                                                            {{-- <form action="/hapusFile/{{ Crypt::encrypt($d->id) }}" method="post" class="dropdown-item">
                                                                @method('delete')
                                                                @csrf
                                                                <button onclick="return confirm('Are you sure?')"><i class="mdi mdi-delete me-2 text-muted vertical-middle">Hapus
                                                                  </button>
                                                            </form> --}}
                                                            <a class="dropdown-item" href="/hapusFile/{{ Crypt::encrypt($d->id) }}"><i class="mdi mdi-delete me-2 text-muted vertical-middle"></i>Remove</a>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col ps-0">
                                                    {{-- <button type="button" class="btn btn-ink">{{ Str::limit($d->nama_file, 20) }}</button> --}}
                                                    <a href="/downloadDokumen/{{ $Tmdokumen->folder }}/{{ $d->nama_file }}" class="text-muted fw-bold">{{ Str::limit($d->nama_file, 20) }}</a>
                                                    <p class="mb-0 font-13">{{ number_format($d->size / 1048576, 2) . ' MB' }}</p>
                                                </div>
                                            </div> <!-- end row -->
                                        </div> <!-- end .p-2-->
                                    </div> <!-- end col -->
                                </div> <!-- end col-->
                            @endforeach
                        </div> <!-- end row-->

                </div> <!-- end .mt-3-->


                <div class="mt-3">
                    <h5 class="mb-3">Recent</h5>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0">Name</th>
                                    <th class="border-0">Last Modified</th>
                                    <th class="border-0">Size</th>
                                    <th class="border-0">Owner</th>
                                    <th class="border-0" style="width: 80px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dokumen as $d)
                                <tr>
                                    <td>
                                        <span class="ms-2 fw-semibold"><a href="javascript: void(0);" class="text-reset">{{ Str::limit($d->nama_file, 20) }}</a></span>
                                    </td>
                                    <td>
                                        <p class="mb-0">{{ $d->tanggal_upload }}</p>
                                        <span>{{ $d->waktu_upload }}</span>
                                    </td>
                                    <td>{{ number_format($d->size / 1048576, 2) . ' MB' }}</td>
                                    <td>
                                        {{ $d->user->name }}
                                    </td>
                                    <td class="">
                                        <div class="btn-group dropdown">
                                            <a href="#" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end" style="">
                                                <a class="dropdown-item" href="#"><i class="mdi mdi-share-variant me-2 text-muted vertical-middle"></i>Share</a>
                                                <a class="dropdown-item" href="#"><i class="mdi mdi-link me-2 text-muted vertical-middle"></i>Get Sharable Link</a>
                                                <a class="dropdown-item" href="#"><i class="mdi mdi-pencil me-2 text-muted vertical-middle"></i>Rename</a>
                                                <a class="dropdown-item" href="#"><i class="mdi mdi-download me-2 text-muted vertical-middle"></i>Download</a>
                                                <a class="dropdown-item" href="#"><i class="mdi mdi-delete me-2 text-muted vertical-middle"></i>Remove</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end card-body-->
            
        </form>
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>

  <script>
      
  </script>

@endsection
