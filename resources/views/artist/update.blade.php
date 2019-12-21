@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Update Artist</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="../artist/{{$artist['id']}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">اسم فارسی  </span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing  input"
                                   aria-describedby="inputGroup-sizing-default" name="name[fa]" value="{{$artist['name_fa']}}">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">English Name</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                   aria-describedby="inputGroup-sizing-default" name="name[en]" value="{{$artist['name_en']}}">
                        </div>

                        <div class="form-group">
                            <label>Artist Biography</label>
                            <textarea class="form-control" rows="3" name="biography">{{$artist['biography']}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>for change Artist image please choose some</label>
                            <input type="file" class="form-control-file" name="image">
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
