@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/admin/{{$category}}"><button type="button" class="btn btn-default">Вернуться</button></a>
                        <a href="/admin/create/{{$category}}"><button type="button" class="btn btn-primary col-md-offset-10">Добавить</button></a>
                    </div>
                    <div class="panel-body">
                        @include('admin/navbar')
                        <div class="col-md-8">
                            @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                            @endif
                            <form method="post" action="/admin/create/{{$category}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Наименование</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Введите наименование" required>
                                </div>
                                <div class="form-group">
                                    <label for="text">Описание</label>
                                    <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="index_img">Изображение на главной странице</label>
                                    <input type="file" id="index_img" name="index_img" required>
                                </div>
                                <div class="form-group">
                                    <label for="main_img">Главное изображение на странице товара</label>
                                    <input type="file" id="main_img" name="main_img" required>
                                </div>
                                <div class="form-group">
                                    <label for="order_num">Порядок</label>
                                    <input type="text" class="form-control" id="order_num" name="order_num" placeholder="Введите любое целое число" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="avail">Есть в наличии
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label for="collection_images">Изображения в коллекции</label>
                                    <input type="file" id="collection_images" name="collection_images[]" multiple>
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