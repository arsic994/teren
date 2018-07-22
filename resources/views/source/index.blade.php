@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Измена извора</div>
                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form class="form-horizontal" method="post" action="/insert">
                        <table class="table" >
                           <input class="form-control" type="hidden" name="_token" value="{{ csrf_token() }}">
                           <tr>
                            <th>Додајте нови извор:</th>
                            <td><input class="form-control" id="source_data" type="text" name="source_data"></td>
                            <td>
                                <button type ="submit" class='btn btn-primary' name="submit" value="add">Додај</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <table class="table">
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Source
                        </th>
                        <th>
                            Edit Source
                        </th>
                    </tr>
                    @foreach($source_data as $data)
                    <tr>
                        <td>{{ $data -> id}}</td>
                        <td>{{ $data -> source_data}}</td>
                        <td>
                            <form class="form-horizontal" method="get" action="{{route('source.update.new', $data->id)}}">
                                <input type="text" name="source_data" value="{{ $data -> source_data}}">

                                <button class='btn btn-primary' type="submit" style="float: right;">Izmeni</button>
                            </form>
                        </td>

                        <td>
                            <a href="/delete/{{ $data ->id, $data -> source_data }}"><button class='btn btn-primary' >Izbrisi</button></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <button class='btn btn-primary' type="button" onclick="window.location='{{ url('/admin') }}'">Назад</button>
    </div>
</div>
</div>
@endsection

