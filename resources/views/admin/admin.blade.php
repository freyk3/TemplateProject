@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Выберете категорию</div>

                <div class="panel-body text-center">
                    <a href="/admin/categories"><button type="button" class="btn btn-primary btn-lg btn-film" style="margin-top: 50px">Категории</button></a><br>
                    <a href="/admin/content"><button type="button" class="btn btn-primary btn-lg btn-film" style="margin-top: 10px">Контент</button></a><br>
                    <a href="/admin/users"><button type="button" class="btn btn-primary btn-lg btn-film" style="margin-top: 10px">Пользователи</button></a><br>
                    @foreach($categories as $category)
                        <a href="/admin/{{$category->slug}}"><button type="button" class="btn btn-primary btn-lg btn-film" style="margin-top: 10px">{{$category->name}}</button></a><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
