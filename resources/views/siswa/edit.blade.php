@extends('layout/aplikasi')
@section('konten')

<a href="/siswa" class="btn btn-secondary">Kembali</a>
<form action="/siswa/{{ $data->nomor_induk }}" method="POST" enctype="multipart/form-data">
@method('put')
@csrf
<!--<div class="mb-3">
  <label for="noid" class="form-label">Nomor Induk</label>
  <input class="form-control" type="text" id="noid" name="nomor_induk" value="{{$data->nomor_induk}}">
  <input class="form-control" type="text" id="noid" name="nomor_induk" value="{{Session::get('nomor_induk')}}">
</div>-->

<div class="mb-3">
  <label for="noid" class="form-label">Nama</label>
  <input class="form-control" type="text" id="noid" name="nama" value="{{$data->nama}}">
</div>

<div class="mb-3">
  <label for="noid" class="form-label">Alamat</label>
  <input class="form-control" type="text" id="noid" name="alamat" value="{{$data->alamat}}">
</div>

@if ($data->foto)
<div class="mb-3"><img src="{{ url('foto').'/'.$data->foto }}" style="max-width:50px; max-height:50px;" ></div>
@endif

<div class="mb-3">
  <label for="foto" class="form-label">Upload Foto</label>
  <input class="form-control" type="file" id="foto" name="foto" >
</div>

<input type="submit" value="Update" class="btn btn-primary" >

</form>


@endsection