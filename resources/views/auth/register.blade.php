@extends('layout/aplikasi')
@section('konten')

<h4>Register</h4>
<form action="/auth/store" method="POST" enctype="multipart/form-data">
@csrf
<div class="mb-3">
  <label for="username" class="form-label">Username</label>
  <input class="form-control" type="text" id="username" name="username">
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input class="form-control" type="text" id="email" name="email" >
  </div>

  <div class="mb-3">
  <label for="password" class="form-label">Password</label>
  <input class="form-control" type="text" id="password" name="password" >
</div>

<input type="hidden" value="Aktif" name="status">
<input type="submit" value="Register" class="btn btn-primary" >

</form>

<a href="/auth/login" ><< Login </a>

@endsection