@extends('layout/aplikasi')
@section('konten')

<a href="/siswa" class="btn btn-secondary">Kembali</a>
<form action="/siswa/store" method="POST" enctype="multipart/form-data">
@csrf
<div class="mb-3">
  <label for="noid" class="form-label">Nomor Induk</label>
  <input class="form-control" type="text" id="noid" name="nomor_induk">
  <!--<input class="form-control" type="text" id="noid" name="nomor_induk" value="{{Session::get('nomor_induk')}}">-->
</div>

<div class="mb-3">
  <label for="noid" class="form-label">Nama</label>
  <input class="form-control" type="text" id="noid" name="nama" >
</div>

<div class="mb-3">
  <label for="noid" class="form-label">Alamat</label>
  <input class="form-control" type="text" id="noid" name="alamat" >
</div>

<div class="mb-3">
  <label for="foto" class="form-label">Upload Foto</label>
  <input class="form-control" type="file" id="foto" name="foto" >
</div>

<input type="submit" value="Simpan" class="btn btn-primary" >

</form>


@endsection