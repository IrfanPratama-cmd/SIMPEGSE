@extends('admin.main')

@section('container')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<h1>Gaji Pegawai</h1>
<hr>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">


              {{-- @if($cekPegawai >= 1) --}}
                <div class="row">
                    @foreach($gaji as $g)
                    <div class="col-md-3">
                        <div class="card border-info border">
                            <div class="card-body">
                                <h4 class="card-title text-center">Gaji ke - {{ $loop->iteration }}</h4>
                                <p class="text-center">Tanggal : {{ $g->tanggal_penggajian }}</p>
                                <div class="d-grid">
                                    <a href="/detailGaji/{{ Crypt::encrypt($g->id) }}" class="btn btn-info btn-sm">Detail Gaji</a>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div>
                    @endforeach
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>




@endsection