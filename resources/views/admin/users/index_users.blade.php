@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1 >Prikaz vodica</h1>
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
            <th>ADMIN</th>
            <th></th>
            <th></th>
        </tr>
    @foreach ($users as $user)
    <tr>
      <td>{{ $user->id }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->phone }}</td>
      <td>{{ $user->is_admin }}</td>
      <td><a href="/admin/users/{{$user->id}}/edit"><button class='btn btn-primary'>Izmeni</button></td>
      <td><a href="/admin/users/{{$user->id}}/delete"><button class='btn btn-primary'>Obrisi</button></td>
    </tr>
    @endforeach
    </table>
  <a href="{{ URL::route('users.create')}}"><button class='btn btn-primary'>Dodaj novog vodica</button></a>

{{--}}    {!! $users->render() !!}

</div>


<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[2];
    td3 = tr[i].getElementsByTagName("td")[0];
    td4 = tr[i].getElementsByTagName("td")[4];
    if (td || td2) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 ||
    td3.innerHTML.toUpperCase().indexOf(filter) > -1 || td4.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
--}}
@endsection
