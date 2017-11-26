@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/admin"><button type="button" class="btn btn-default">Вернуться</button></a>
                        <a href="/admin/create/{{$category}}"><button type="button" class="btn btn-primary col-md-offset-10">Добавить</button></a>
                    </div>
                    <div class="panel-body">
                        @include('admin/navbar')
                        <div class="col-md-9">
                            <table class="table table-bordered">
                                <tr>
                                    <th>id</th>
                                    <th>Наименование</th>
                                    <th>Текст</th>
                                    <th>Img на главной</th>
                                    <th>Img в профиле</th>
                                    <th>Порядок</th>
                                    <th>Действия</th>
                                </tr>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td><p style="max-height: 250px; overflow: auto">{{$item->text}}</p></td>
                                        <td>
                                            <img src="/{{$item->index_img}}" class="img-rounded" style="max-width: 140px; max-height: 140px">
                                        </td>
                                        <td>
                                            <img src="/{{$item->main_img}}" class="img-rounded" style="max-width: 140px; max-height: 140px">
                                        </td>
                                        <td>
                                            {{$item->order_num}}
                                        </td>
                                        <td>
                                            <a href="/admin/update/{{$item->category}}/{{$item->id}}"><button type="button" class="btn btn-default">Редактировать</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection