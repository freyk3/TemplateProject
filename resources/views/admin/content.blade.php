@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/admin"><button type="button" class="btn btn-default">Вернуться</button></a>
                    </div>
                    <div class="panel-body">
                        @include('admin/navbar')

                        <div class="col-md-9">
                            <table class="table table-bordered">
                                <tr>
                                    <th>id</th>
                                    <th>Наименование</th>
                                    <th>Текст</th>
                                    <th>Действия</th>
                                </tr>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->text}}</td>
                                        <td>
                                            <a href="/admin/update/content/{{$item->id}}"><button type="button" class="btn btn-default">Редактировать</button></a>
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