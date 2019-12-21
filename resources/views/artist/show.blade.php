@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Show {{$artist['name']['en']}}</h1>
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
                                    <input class="form-control" type="text" value="{{$artist['name']['fa']}}" readonly
                                           style="margin-top: 10px;">
                                    <label>name</label>
                                    <input class="form-control" type="text" value="{{$artist['name']['en']}}" readonly
                                           style="margin-top: 10px;">

                                    <label>Biography</label>
                                    <textarea class="form-control" type="text" readonly
                                              style="margin-top: 10px;">{{$artist['biography']}}</textarea>
                                </div>
                            </div>
                        </form>
                    </div>



                </div>
            </div>
        </div>
    </div>
@stop
