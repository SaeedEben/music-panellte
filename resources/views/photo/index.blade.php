@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Photos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                        <strong style="float: left;">Song Images</strong>

                                    @foreach($song as $simage)
                                        <img src="{{$simage}}" alt="Lights" style="width:200px; height: 200px;" class="rounded float-right">
                                    @endforeach

                </div>

                <div class="line" style="width: 100%; height: 1px; background-color: #171a1d;"></div>

                <div class="card-body">
                <strong style="float: left;">Artist Images</strong>

                            @foreach($artist as $aimage)
                                    <img src="{{$aimage}}" alt="Lights" style="width:200px; height: 200px;" class="rounded float-right">

                            @endforeach

                        <br>
                </div>
                <div class="line" style="width: 100%; height: 1px; background-color: #171a1d;"></div>

                <div class="card-body">
                        <strong style="float: left;">Album Images</strong>
                            @foreach($album as $alimage)
                                    <img src="{{$alimage}}" alt="Lights" style="width:200px; height: 200px;" class="rounded float-right">


                            @endforeach

                    </div>
                </div>
            </div>
        </div>
@stop
