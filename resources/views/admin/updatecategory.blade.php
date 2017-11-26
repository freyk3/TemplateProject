@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/admin/categories"><button type="button" class="btn btn-default">Вернуться</button></a>
                    </div>
                    <div class="panel-body">
                        @include('admin/navbar')
                        <div class="col-md-8">
                            @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                            @endif
                            <form method="post" action="/admin/update/category/{{$item->slug}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Наименование</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Введите наименование" value="{{$item->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Url</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Введите Url категории" value="{{$item->slug}}" required>
                                </div>

                                <div class="form-group" style="margin-top: 50px">
                                    <button type="submit" class="btn btn-primary">Редактировать</button>
                                </div>
                            </form>
                            <a href="/admin/delete/category/{{$item->slug}}"><button type="submit" class="btn btn-default">Удалить категорию</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection