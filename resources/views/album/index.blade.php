@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Album Index</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn-lg btn-block btn-success"><a href="album/create"
                                                                                  style="text-decoration: none; color: #171a1d;">Create</a>
                    </button>
                    <br>
                    <form action="album/restore" method="post">
                        @csrf
                        <p>Restore your Album with ID</p>
                        <button type="submit" class="btn btn-warning" style="color: #171a1d;">
                            Restore
                        </button>
                        <input type="text" name="id">
                    </form>
                    <br>


                    <table class="table table-dark">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name_fa</th>
                            <th scope="col">Name_en</th>
                            <th scope="col">Do Some...</th>
                        </tr>
                        </thead>
                        @foreach($albums as $album)
                            <tbody>
                            <tr>
                                <th scope="row">{{$album->id}}</th>
                                <td>{{$album->name_fa}}</td>
                                <td>{{$album->name_en}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <button type="button" class="btn btn-warning"><a
                                                href="album/{{$album->id}}"
                                                style="text-decoration: none; color: #171a1d;">Show</a>
                                        </button>

                                        <button type="button" class="btn btn-secondary"><a
                                                href="/music/updatealbum/{{$album->id}}"
                                                style="text-decoration: none; color: #171a1d;">Update</a>
                                        </button>
                                        <form action="album/{{$album->id}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger" style="color: #171a1d;">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
