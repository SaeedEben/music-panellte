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
                    <form action="../artist" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">اسم فارسی  </span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing  input"
                                   aria-describedby="inputGroup-sizing-default" name="name[fa]">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">English Name</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Sizing example input"
                                   aria-describedby="inputGroup-sizing-default" name="name[en]">
                        </div>

                        <div class="form-group">
                            <label>Artist Biography</label>
                            <textarea class="form-control" rows="3" name="biography"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success"> create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
