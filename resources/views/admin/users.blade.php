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
                                    <th>Логин</th>
                                    <th>Email</th>
                                    <th>Действия</th>
                                </tr>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>
                                            <a href="/admin/update/user/{{$item->id}}"><button type="button" class="btn btn-default">Редактировать</button></a>
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