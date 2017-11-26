@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/admin/categories"><button type="button" class="btn btn-default">Вернуться</button></a>
                        <a href="/admin/create/category"><button type="button" class="btn btn-primary col-md-offset-10">Добавить</button></a>
                    </div>
                    <div class="panel-body">
                        @include('admin/navbar')
                        <div class="col-md-8">
                            @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                            @endif
                            <form method="post" action="/admin/create/category" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Наименование</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Введите наименование" required>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Url</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Введите url категории" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Создать</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection