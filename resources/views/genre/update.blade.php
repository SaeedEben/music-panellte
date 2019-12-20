@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="/music/genre/{{$genre['id']}}" method="post">
                        @csrf
                        @method('put')
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">اسم فارسی  </span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                   aria-describedby="inputGroup-sizing-default" name="name[fa]" value="{{$genre['name_fa']}}">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">English Name</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                   aria-describedby="inputGroup-sizing-default" name="name[en]" value="{{$genre['name_en']}}">
                        </div>
                        <button type="submit" class="btn btn-success"> update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop