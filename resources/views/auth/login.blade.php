@extends('layout/aplikasi')
@section('konten')

<h4>Login</h4>
<form action="/auth/sign-in" method="POST" enctype="multipart/form-data">
@csrf
<div class="mb-3">
  <label for="username" class="form-label">Username</label>
  <input class="form-control" type="text" id="username" name="username">
  </div>

  <div class="mb-3">
  <label for="password" class="form-label">Password</label>
  <input class="form-control" type="text" id="password" name="password" >
</div>

<input type="submit" value="Login" class="btn btn-primary" >

</form>

<a href="/auth/register" >Register >></a>

@endsection