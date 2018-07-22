@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1 >Приказ корисника </h1>
            </div>

            <div class="col-ld-12">
                <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Претражи..."  style="float:right; width:23%;">
             <br><br>
            </div>
             
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<br><br>
    <table class="table table-bordered" id="myTable">
        <tr>
            <th>ID</th>
            <th>IME I PREZIME</th>
            <th>E-MAIL</th> 
            <th>BROJ TELEFONA</th>
            <th>AKTIVAN</th>
            <th>REGISTROVAN</th>
            <th width="280px">AKCIJA</th>
        </tr>
    @foreach ($users as $key => $user)
    <tr>
      <td>{{ $user->id }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->phone }}</td>
      <td>{{ $user->is_admin }}</td>
      <td>{{ $user->active }}</td>
      <td>{{ $user->created_at}}</td>
      <td><a href="/admin/users/{{$user->id}}/edit"><button class='btn btn-primary'>Измени</button></td>
    </tr>
    @endforeach
    </table>

@endsection
