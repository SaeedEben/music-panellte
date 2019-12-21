@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Update {{$song['name_en']}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-10 d-flex justify-content-center mb-5">

                        <form style="margin-right: 50px;" method="post" action="../song/{{$song['id']}}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col">
                                    <label>نام</label>
                                    <input class="form-control" type="text" value="{{$song['name_fa']}}"
                                           style="margin-top: 10px;" name="name[fa]">
                                    <label>name</label>
                                    <input class="form-control" type="text" value="{{$song['name_en']}}"
                                           style="margin-top: 10px;" name="name[en]">
                                    <label>release at</label>
                                    <input class="form-control" type="text" value="{{$song['release_at']}}"
                                           style="margin-top: 10px;" name="release_at">
                                    <label>Duration</label>
                                    <input class="form-control" type="text" value="{{$song['duration']}}"
                                           style="margin-top: 10px;" name="duration">
                                    <label>Lyric</label>
                                    <textarea class="form-control" type="text"
                                              style="margin-top: 10px;" name="lyric">{{$song['lyric']}}</textarea>
                                    <br>
                                    <div class="form-group">
                                        <label>Choose your input song image</label>
                                        <input type="file" class="form-control-file" name="song_image">
                                    </div>

                                    <button type="submit" class="btn btn-success"> Update </button>
                                </div>
                            </div>
                        </form>
                        <br>

                        <div style="width: 400px; height: 400px; margin-right: 100px;">
                            <img src="{{ asset($storage )}}" class="img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
