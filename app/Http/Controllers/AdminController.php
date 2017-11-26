<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\Content;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\User;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function __construct()
    {

    }
    
    public function admin()
    {
        $view['categories'] = Category::all();
        return view('admin/admin', $view);
    }
    public function users()
    {
        $view['categories'] = Category::all();
        $view['items'] = User::all();
        return view('admin/users', $view);
    }
    public function content()
    {
        $view['categories'] = Category::all();
        $view['items'] = Content::all();
        return view('admin/content', $view);
    }
    public function categories()
    {
        $view['items'] = $view['categories'] = Category::all();
        return view('admin/categories', $view);
    }
    public function itemtable($category)
    {
        $view['category'] = $category;
        $view['categories'] = Category::all();
        $view['items'] = Item::where('category', $category)->get();
        return view('admin/admintable', $view);
    }
    
    public function createpage($category)
    {
        $view['categories'] = Category::all();
        $view['category'] = $category;
        return view('admin/create', $view);
    }
    public function updatepage($category, $id)
    {
        $view['categories'] = Category::all();
        $item = Item::where('category',$category)->where('id',$id)->first();
        $dir = 'userfiles/'.$category.'/'.$id.'/collection';
        if(file_exists($dir))
        {
            $images = scandir($dir);
            unset($images[0]);
            unset($images[1]);
            $view['collection_images'] = $images;
        }

        $view['item'] = $item;
        $view['category'] = $category;
        return view('admin/update', $view);
    }


    public function create($category, Request $request)
    {
        if(!is_numeric($request->order_num))
        {
            Session::flash('message', 'В поле порядка допустимы только целые числа');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/admin/create/'.$category);
        }

        $imgTipe1 = $request->file('index_img')->guessExtension();
        $imgTipe2 = $request->file('main_img')->guessExtension();

        if($imgTipe1 != 'jpg' && $imgTipe1 != 'jpeg' && $imgTipe1 != 'png')
        {
            Session::flash('message', 'Неверный формат изображения 1: Допускается только jpg, jpeg, png');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/admin/create/'.$category);
        }
        if($imgTipe2 != 'jpg' && $imgTipe2 != 'jpeg' && $imgTipe2 != 'png')
        {
            Session::flash('message', 'Неверный формат изображения 2: Допускается только jpg, jpeg, png');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/admin/create/'.$category);
        }

        if($request->hasFile('collection_images'))
        foreach ($request->file('collection_images') as $image)
        {
            $imgTipe = $image->guessExtension();
            if($imgTipe != 'jpg' && $imgTipe != 'jpeg' && $imgTipe != 'png')
            {
                Session::flash('message', 'Неверный формат изображения: Допускается только jpg, jpeg, png');
                Session::flash('alert-class', 'alert-danger');
                return redirect('/admin/create/'.$category);
            }
        }

        $item = new Item();
        $item->category = $category;
        $item->name = $request->name;
        $item->text = $request->text;
        $item->avail = ($request->avail == 'on') ? 1 : 0;
        $item->order_num = $request->order_num;
        $item->index_img = '';
        $item->main_img = '';
        $item->save();

        if($request->hasFile('collection_images')) {
            $i = 0;
            foreach ($request->file('collection_images') as $image) {

                $image->move('userfiles/' . $category . '/' . $item->id . '/collection', $i . time() . '.' . $image->guessExtension());
                $i++;
            }
        }

        $indexImgPath = 'userfiles/'.$category.'/'.$item->id;
        $mainImgPath = 'userfiles/'.$category.'/'.$item->id;
        $request->file('index_img')->move($indexImgPath,'index.'.$imgTipe1);
        $request->file('main_img')->move($mainImgPath,'vnutr0.'.$imgTipe2);
        $item->index_img = $indexImgPath.'/index.'.$imgTipe1;
        $item->main_img = $mainImgPath.'/vnutr0.'.$imgTipe2;
        $item->save();

        $view['category'] = $category;
        return redirect('admin/'.$category);
    }
    public function update($category, $id, Request $request)
    {
        $item = Item::where('category',$category)->where('id',$id)->first();

        if($request->hasFile('index_img'))
        {
            $imgTipe1 = $request->file('index_img')->guessExtension();
            if($imgTipe1 != 'jpg' && $imgTipe1 != 'jpeg' && $imgTipe1 != 'png')
            {
                Session::flash('message', 'Неверный формат изображения 1: Допускается только jpg, jpeg, png');
                Session::flash('alert-class', 'alert-danger');
                return redirect('/admin/update/'.$category.'/'.$id);
            }
        }
        if($request->hasFile('main_img'))
        {
            $imgTipe2 = $request->file('main_img')->guessExtension();
            if($imgTipe2 != 'jpg' && $imgTipe2 != 'jpeg' && $imgTipe2 != 'png')
            {
                Session::flash('message', 'Неверный формат изображения 2: Допускается только jpg, jpeg, png');
                Session::flash('alert-class', 'alert-danger');
                return redirect('/admin/update/'.$category.'/'.$id);
            }
        }

        if($request->hasFile('collection_images'))
        {
            foreach ($request->file('collection_images') as $image)
            {
                $imgTipe = $image->guessExtension();
                if($imgTipe != 'jpg' && $imgTipe != 'jpeg' && $imgTipe != 'png')
                {
                    Session::flash('message', 'Неверный формат изображения: Допускается только jpg, jpeg, png');
                    Session::flash('alert-class', 'alert-danger');
                    return redirect('/admin/create/'.$category);
                }
            }

            $i = 0;
            foreach ($request->file('collection_images') as $image)
            {

                $image->move('userfiles/'.$category.'/'.$item->id.'/collection', $i.time().'.'.$image->guessExtension());
                $i++;
            }
        }

        if($request->hasFile('index_img'))
        {
            $indexImgPath = 'userfiles/'.$category.'/'.$item->id;
            $request->file('index_img')->move($indexImgPath,'index.'.$imgTipe1);
            $item->index_img = $indexImgPath.'/index.'.$imgTipe1;
        }
        if($request->hasFile('main_img'))
        {
            $mainImgPath = 'userfiles/'.$category.'/'.$item->id;
            $request->file('main_img')->move($mainImgPath,'vnutr0.'.$imgTipe2);
            $item->main_img = $mainImgPath.'/vnutr0.'.$imgTipe2;
        }


        $item->name = $request->name;
        $item->text = $request->text;
        $item->avail = ($request->avail == 'on') ? 1 : 0;
        $item->order_num = $request->order_num;
        $item->save();
        return redirect('admin/'.$category);
    }

    public function delete($category, $id, Request $request)
    {
        $item = Item::where('category',$category)->where('id',$id)->first();
        $item->delete();
        return redirect('/admin/'.$category);
    }

    public function deleteImage($category, $id, Request $request)
    {
        $fileName = 'userfiles/'.$category.'/'.$id.'/collection/'.$request->image;
        unlink($fileName);
        return redirect('/admin/update/'.$category.'/'.$id);

    }

    public function createcategory(Request $request)
    {
        if($request->method() == 'POST')
        {
            if(!preg_match('|^[A-Z0-9]+$|i', $request->slug))
            {
                Session::flash('message', 'Url допустимо только латинские буквы и числа');
                Session::flash('alert-class', 'alert-danger');
                return redirect('/admin/create/category');
            }

            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->save();
            return redirect('/admin/categories');
        }
        $view['categories'] = Category::all();
        return view('admin/createcategory', $view);
    }
    public function updatecategory($slug, Request $request)
    {
        if($request->method() == 'POST')
        {
            $category = Category::where('slug',$slug)->first();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->save();
            return redirect('/admin/categories');
        }

        $view['item'] = Category::where('slug',$slug)->first();
        $view['categories'] = Category::all();
        return view('admin/updatecategory', $view);
    }

    public function deletecategory($slug, Request $request)
    {
        $category = Category::where('slug', $slug)->first();
        $items = Item::where('category', $slug);
        foreach ($items as $item)
            $item->delete();
        $category->delete();
        return redirect('/admin/categories');
    }

    public function updateuser($id, Request $request)
    {
        if($request->method() == 'POST')
        {
            $category = User::where('id',$id)->first();
            $category->name = $request->name;
            $category->email = $request->email;
            $category->password = bcrypt($request->password);
            $category->save();
            return redirect('/admin/users');
        }

        $view['item'] = User::where('id',$id)->first();
        $view['categories'] = Category::all();
        return view('admin/updateuser', $view);
    }

    public function updatecontent($id, Request $request)
    {
        if($request->method() == 'POST')
        {
            $content = Content::where('id',$id)->first();
            $content->text = $request->text;
            $content->save();
            return redirect('/admin/content');
        }

        $view['item'] = Content::where('id',$id)->first();
        $view['categories'] = Category::all();
        return view('admin/updatecontent', $view);
    }

}
