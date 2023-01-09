<?php

use App\Models\Category;
use App\Libraries\MyClass;
use App\Libraries\Upload;
if (isset($_POST['THEM'])) {
    $category = new Category();
    $category->name = $_POST['name'];
    $category->slug = MyClass::str_slug($_POST['name']);
    $category->metakey = $_POST['metakey'];
    $category->metadesc = $_POST['metadesc'];
    $category->parent_id = $_POST['parent_id'];
    $category->sort_order = $_POST['sort_order'];
    $category->level = 1;
    $category->status = $_POST['status'];
    $category->created_at = date('Y-m-d H:i:s');
    $category->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    //upload file
    if(strlen($_FILES['image']['name'])) {
        $args=array(
            'path_dir'=>'../public/images/category/',
            'file'=>$_FILES['image'],
            'extension'=>['png','jpg','webp'],
            'maxsize'=>5000000,
            'rename'=>$category->slug
        );
        $upload = Upload::saveFile($args);
        if($upload['success']==true) {
            $category->image=$upload['result'];
            $category->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công']);
            header("location:index.php?option=category");
        } else {
            MyClass::set_flash('message', ['type' => 'danger', 'msg' => $upload['message']]);
            header("location:index.php?option=category&cat=create");
        }
    } else {
        $category->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công & không có image']);
        header("location:index.php?option=category");
    }
}
if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $category =Category::find($id);
    $category_level = Category::find($_POST['parent_id']);
    $category->name = $_POST['name'];
    $category->slug = MyClass::str_slug($_POST['name']);
    $category->metakey = $_POST['metakey'];
    $category->metadesc = $_POST['metadesc'];
    $category->parent_id = $_POST['parent_id'];
    $category->sort_order = $_POST['sort_order'];
    $category->level = $category_level->level+1;
    $category->status = $_POST['status'];
    $category->updated_at = date('y-m-d H:i:s');
    $category->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    $category->slug=MyClass::str_slug($category->name);
    //upload file
    if (strlen($_FILES['image']['name'])) {
        Upload::deleteFile(['path_dir'=>'../public/images/category/', 'file' => $category-> image]);
        $args = array(
            'path_dir' => '../public/images/category/',
            'file' => $_FILES['image'],
            'extension' => ['png', 'jpg', 'webp'],
            'maxsize' => 5000000,
            'rename' => $category->slug
        );
        $upload = Upload::saveFile($args);
        if ($upload['success'] == true) {
            $category->image = $upload['result'];
            $category->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công']);
            header("location:index.php?option=category");
        } else {
            MyClass::set_flash('message', ['type' => 'danger', 'msg' => $upload['message']]);
            header("location:index.php?option=category&cat=edit&id=$id");
        }
    } else {
        $category->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công & không đổi image']);
        header("location:index.php?option=category");
    }
}
if (isset($_POST['DELETE_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $category = Category::find($id);
        $category->status = 0;
        $category->save();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=category");
}

if (isset($_POST['DESTROY_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $category = Category::find($id);
        $category->delete();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=category&cat=trash");
}