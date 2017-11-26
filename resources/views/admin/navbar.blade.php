<div class="col-md-3 navbar-left">
    <a href="/admin/categories"><button type="button" class="btn btn-primary btn-lg" style=" white-space: normal; width: 230px;">Категории</button></a><br>
    <a href="/admin/content"><button type="button" class="btn btn-primary btn-lg" style="margin-top: 10px; white-space: normal; width: 230px;">Контент</button></a><br>
    <a href="/admin/users"><button type="button" class="btn btn-primary btn-lg" style="margin-top: 10px;  white-space: normal; width: 230px;">Пользователи</button></a><br>
    @foreach($categories as $category)
        <a href="/admin/{{$category->slug}}"><button type="button" class="btn btn-primary btn-lg" style="margin-top: 10px; white-space: normal; width: 230px;">{{$category->name}}</button></a><br>
    @endforeach
</div>