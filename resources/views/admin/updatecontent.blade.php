@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/admin/content"><button type="button" class="btn btn-default">Вернуться</button></a>
                    </div>
                    <div class="panel-body">
                        @include('admin/navbar')
                        <div class="col-md-8">
                            @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                            @endif
                            <form method="post" action="/admin/update/content/{{$item->id}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <strong><p>{{$item->name}}</p></strong>
                                </div>
                                <div class="form-group">
                                    <label for="text">Текст</label>
                                    <textarea class="form-control" id="text" name="text" rows="3" required>{{$item->text}}</textarea>
                                </div>

                                <div class="form-group" style="margin-top: 50px">
                                    <button type="submit" class="btn btn-primary">Редактировать</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection