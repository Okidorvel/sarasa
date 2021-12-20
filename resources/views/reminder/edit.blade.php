@extends('layouts.app')

@section('title', 'Edit Grup')

@section('content-header')
<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
    style="background-image: url({{ asset('/img/cover-bg.jpg') }}); background-size: cover; background-position: center top;">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card shadow h-100">
                    <div class="card-header border-0">
                        <div
                            class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-between text-center text-md-left">
                            <div class="mb-3">
                                <h2 class="mb-0">Edit Reminder</h2>
                                <p class="mb-0 text-sm">Kelola Reminder</p>
                            </div>
                            <div class="mb-3">
                                <a href="{{ route("reminder.index") }}?page={{ request('page') }}"
                                    class="btn btn-success" title="Kembali"><i class="fas fa-arrow-left"></i>
                                    Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
@include('layouts.components.alert')
<div class="card bg-secondary shadow h-100">
    <div class="card-body">
        <form autocomplete="off" action="{{ route('reminder.update', $reminder) }}" method="post"
            enctype="multipart/form-data">
            @csrf @method('patch')
            <div class="form-group row">
                <label class="form-control-label col-form-label col-md-3" for="nama">Nama</label>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                        placeholder="Masukkan Nama..." value="{{ old('nama', $reminder->nama) }}">
                    @error('nama')<span class="invalid-feedback font-weight-bold">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="form-control-label col-form-label col-md-3" for="keterangan">Deskripsi</label>
                <div class="col-md-9">
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                        placeholder="Masukkan Deskripsi ...">{{ old('deskripsi', $reminder->deskripsi) }}</textarea>
                    @error('deskripsi')<span class="invalid-feedback font-weight-bold">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="form-control-label col-form-label col-md-3" for="kategori">Kategori</label>
                <div class="col-md-9">
                    <select class="form-control @error('kategori') is-invalid @enderror" name="kategori"
                        id="kategori">
                        <option selected value="">Pilih Jenis Kategori</option>
                        <option value="1"
                            {{ old('kategori', $reminder->kategori) == 1 ? 'selected="true"' : ''  }}>
                            Reminder</option>
                        <option value="2"
                            {{ old('kategori', $reminder->kategori) == 2 ? 'selected="true"' : ''  }}>
                            Note</option>
                    </select>
                    @error('jenis_kelamin')<span
                        class="invalid-feedback font-weight-bold">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="form-control-label col-form-label col-md-3" for="tanggal">Tanggal</label>
                <div class="col-md-9">
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                        placeholder="Masukkan Tanggal ..." value="{{ old('tanggal', $reminder->tanggal) }}">
                    @error('tanggal')<span class="invalid-feedback font-weight-bold">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="form-control-label col-form-label col-md-3" for="waktu">Waktu</label>
                <div class="col-md-9">
                    <input type="time" class="form-control @error('waktu') is-invalid @enderror" name="waktu"
                        placeholder="Masukkan Waktu..." value="{{ old('waktu', $reminder->waktu) }}">
                    @error('waktu')<span
                        class="invalid-feedback font-weight-bold">{{ $message }}</span>@enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block" id="simpan">SIMPAN</button>
        </form>
    </div>
</div>
@endsection
