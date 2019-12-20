@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Song Create</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/music/song" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="اسم فارسی" name="name[fa]"
                                        required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="English Name" name="name[en]">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="duration" name="duration">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="release at" name="release_at">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label>Genre</label>
                                <select class="form-control form-control-sm" name="genre">
                                    @foreach($genre as $genr)
                                        <option>{{$genr->id}}.{{$genr->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>Category</label>
                                <select class="form-control form-control-sm" name="category">
                                    @foreach($category as $cat)
                                        <option>{{$cat->id}}.{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label>Album</label>
                                <select class="form-control form-control-sm" name="album">
                                    @foreach($album as $alb)
                                        <option>{{$alb->id}}.{{$alb->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Lyric</label>
                            <textarea class="form-control" name="lyric" rows="3">{{old('lyric')}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Choose your input song</label>
                            <input type="file" class="form-control-file" name="songname">
                        </div>

                        <button type="submit" class="btn btn-success">Upload</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
@stop
