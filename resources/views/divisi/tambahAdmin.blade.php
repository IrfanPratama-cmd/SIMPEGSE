@extends('admin.main')

@section('container')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-8">
        <h1 class="my-1">Tambah Admin Unit</h1>
        <div class="card mt-2">
          
          <!-- /.card-header -->
          <div class="card-body">
            <form action="/simpanAdmin" method="POST">
              @csrf
              <div class="col-lg-12">
                      <div class="mb-3">
                          <label for="simpleinput" class="form-label">Username</label>
                          <input type="text" id="simpleinput" name="name" class="form-control">
                      </div>

                      <div class="mb-3">
                          <label for="example-email" class="form-label">Email</label>
                          <input type="email" id="example-email" name="email" class="form-control" placeholder="Email">
                      </div>                     
             
                    {{-- <div class="mb-3">
                        <label for="example-select" class="form-label">Pilih Divisi</label>
                        <select class="form-select" name="divisi_id" id="example-select">
                          <option selected disabled>Pilih Divisi</option>
                          @foreach ($divisi as $d)
                            @if(old('divisi_id') == $d->id)
                                <option value="{{ $d->id}}" selected>{{ $d->nama_divisi }}</option>
                            @else
                                <option value="{{ $d->id}}">{{ $d->nama_divisi }}</option>
                            @endif
                          @endforeach
                        </select>
                    </div> --}}
                    <button type="submit" class="btn btn-success">Tambah Admin</button>                                                      
            </div> <!-- end col -->
          </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        {{-- @endforeach   --}}
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>


<!-- Datatables js -->
<script src="/hyper/assets/js/vendor/dataTables.buttons.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.bootstrap5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.html5.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.flash.min.js"></script>
<script src="/hyper/assets/js/vendor/buttons.print.min.js"></script>


@endsection