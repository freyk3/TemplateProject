@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/admin/{{$item->category}}"><button type="button" class="btn btn-default">Вернуться</button></a>
                    </div>
                    <div class="panel-body">
                        @include('admin/navbar')
                        <div class="col-md-8">
                            @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                            @endif
                            <form method="post" action="/admin/update/{{$category}}/{{$item->id}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Наименование</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Введите наименование" value="{{$item->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="text">Описание</label>
                                    <textarea class="form-control" id="text" name="text" rows="3" required>{{$item->text}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="index_img">Изображение на главной странице</label>
                                    <input type="file" id="index_img" name="index_img">
                                </div>
                                <div class="form-group">
                                    <label for="main_img">Главное изображение на странице товара</label>
                                    <input type="file" id="main_img" name="main_img">
                                </div>
                                <div class="form-group">
                                    <label for="order_num">Порядок</label>
                                    <input type="text" class="form-control" id="order_num" name="order_num" placeholder="Введите любое целое число" value="{{$item->order_num}}" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="avail" <?php if($item->avail==1) { echo 'checked';}?>>Есть в наличии
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label for="collection_images">Добавить изображения коллекции</label>
                                    <input type="file" id="collection_images" name="collection_images[]" multiple>
                                </div>

                                @if(isset($collection_images))
                                    <div class="form-group">
                                        @foreach($collection_images as $image)
                                            <img src="/userfiles/{{$category}}/{{$item->id}}/collection/{{$image}}" class="img-rounded" style="max-height: 140px; max-width: 140px">
                                            <a href="/admin/deleteImage/{{$category}}/{{$item->id}}?image={{$image}}">Удалить</a>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="form-group" style="margin-top: 50px">
                                    <button type="submit" class="btn btn-primary">Редактировать</button>
                                </div>
                            </form>
                            <a href="/admin/delete/{{$category}}/{{$item->id}}"><button type="submit" class="btn btn-default">Удалить товар</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection