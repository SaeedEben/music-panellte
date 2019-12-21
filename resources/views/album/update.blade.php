@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Update Album</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="/music/album/{{$album['id']}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">اسم فارسی  </span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing  input"
                                   aria-describedby="inputGroup-sizing-default" name="name[fa]"
                                   value="{{$album['name_fa']}}">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">English Name</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                   aria-describedby="inputGroup-sizing-default" name="name[en]"
                                   value="{{$album['name_en']}}">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">release at</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                   aria-describedby="inputGroup-sizing-default" name="release_at"
                                   placeholder="example:2010-10-10" value="{{$album['release_at']}}">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">number of tracks</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                   aria-describedby="inputGroup-sizing-default" name="number_of_track"
                                   value="{{$album['number_of_track']}}">
                        </div>

                        <div class="form-group">
                            <label>Choose your input Album image</label>
                            <input type="file" class="form-control-file" name="album_image">
                        </div>


                        <button type="submit" class="btn btn-success"> update</button>
                    </form>
                    <br>
                    <div style="width: 400px; height: 400px; float: right;">
                        <img src="{{ asset($storage )}}" class="img-thumbnail">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
