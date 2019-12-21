@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Show {{$album['name']['en']}}</h1>
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
                                    <input class="form-control" type="text" value="{{$album['name']['fa']}}" readonly
                                           style="margin-top: 10px;">
                                    <label>name</label>
                                    <input class="form-control" type="text" value="{{$album['name']['en']}}" readonly
                                           style="margin-top: 10px;">

                                    <label>release at</label>
                                    <input class="form-control" type="text" readonly
                                              style="margin-top: 10px;" value="{{$album['release_at']}}">
                                    <label>number of tracks</label>
                                    <input class="form-control" type="text" readonly
                                              style="margin-top: 10px;" value="{{$album['number_of_track']}}">
                                </div>
                            </div>
                        </form>
                    </div>



                </div>
            </div>
        </div>
    </div>
@stop
