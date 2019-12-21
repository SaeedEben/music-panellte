@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Show {{$song['name']['en']}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-10 d-flex justify-content-center mb-5">
                        <div style="width: 400px; height: 400px; float: right;">
                            <img src="{{ asset($storage )}}" class="img-thumbnail">
                        </div>
                        <form style="margin-right: 50px;">
                            <div class="row">
                                <div class="col">
                                    <label>نام</label>
                                    <input class="form-control" type="text" value="{{$song['name']['fa']}}" readonly
                                           style="margin-top: 10px;">
                                    <label>name</label>
                                    <input class="form-control" type="text" value="{{$song['name']['en']}}" readonly
                                           style="margin-top: 10px;">
                                    <label>release at</label>
                                    <input class="form-control" type="text" value="{{$song['release_at']}}" readonly
                                           style="margin-top: 10px;">
                                    <label>Duration</label>
                                    <input class="form-control" type="text" value="{{$song['duration']}}" readonly
                                           style="margin-top: 10px;">
                                    <label>Lyric</label>
                                    <textarea class="form-control" type="text" readonly
                                              style="margin-top: 10px;">{{$song['lyric']}}</textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col">
                                <label>Category</label>
                                <input type="text" class="form-control" readonly value="{{$category->name->en}}">
                            </div>
                            <div class="col">
                                <label>Album</label>
                                <input type="text" class="form-control" readonly value="{{$album->name->en}}">
                            </div>
                            <div class="col">
                                <label>genres</label>
                                @foreach($genres as $genre)
                                    <input type="text" class="form-control" readonly value="{{$genre->name->en}}">
                                @endforeach
                            </div>
                            <div class="col">
                                <label>Artists</label>
                                @foreach($artists as $artist)
                                    <input type="text" class="form-control" readonly value="{{$artist->name->en}}">
                                @endforeach
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@stop
