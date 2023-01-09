<?php

use App\Models\Brand;
use App\Libraries\MyClass;
use App\Libraries\Upload;
if (isset($_POST['THEM'])) {
    $brand = new Brand();
    $brand->name = $_POST['name'];
    $brand->slug = MyClass::str_slug($_POST['name']);
    $brand->metakey = $_POST['metakey'];
    $brand->metadesc = $_POST['metadesc'];
    $brand->sort_order = $_POST['sort_order'];
    // $brand->level = 1;
    $brand->status = $_POST['status'];
    $brand->created_at = date('Y-m-d H:i:s');
    $brand->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    //upload file
    if(strlen($_FILES['image']['name'])) {
        $args=array(
            'path_dir'=>'../public/images/brand/',
            'file'=>$_FILES['image'],
            'extension'=>['png','jpg','webp'],
            'maxsize'=>5000000,
            'rename'=>$brand->slug
        );
        $upload = Upload::saveFile($args);
        if ($upload['success'] == true) {
            $brand->image = $upload['result'];
            $brand->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công']);
            header("location:index.php?option=brand"); 
        } else {
            MyClass::set_flash('message', ['type' => 'danger', 'msg' => $upload['message']]);
            header("location:index.php?option=brand&cat=create");             
        }
    }
    else {
        $brand->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công & không có image']);
        header("location:index.php?option=brand"); 
    }
   
}
if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $brand =Brand::find($id);
    $brand->name = $_POST['name'];
    $brand->slug = MyClass::str_slug($_POST['name']);
    $brand->metakey = $_POST['metakey'];
    $brand->metadesc = $_POST['metadesc'];
    $brand->sort_order = $_POST['sort_order'];
    // $brand->level = $brand_level->level+1;
    $brand->status = $_POST['status'];
    $brand->updated_at = date('Y-m-d H:i:s');
    $brand->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    $brand->slug=MyClass::str_slug($brand->name);
    //upload file
    if (strlen($_FILES['image']['name'])) {
        Upload::deleteFile(['path_dir'=>'../public/images/brand/', 'file' => $brand-> image]);
        $args = array(
            'path_dir' => '../public/images/brand/',
            'file' => $_FILES['image'],
            'extension' => ['png', 'jpg', 'webp'],
            'maxsize' => 5000000,
            'rename' => $brand->slug
        );
        $upload = Upload::saveFile($args);
        if ($upload['success'] == true) {
            $brand->image = $upload['result'];
            $brand->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công']);
            header("location:index.php?option=brand");
        } else {
            MyClass::set_flash('message', ['type' => 'danger', 'msg' => $upload['message']]);
            header("location:index.php?option=brand&cat=edit&id=$id");
        }
    } else {
        $brand->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công & không đổi image']);
        header("location:index.php?option=brand");
    }  
}

if (isset($_POST['DELETE_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $brand = Brand::find($id);
        $brand->status = 0;
        $brand->save();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=brand");
}

if (isset($_POST['DESTROY_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $brand = Brand::find($id);
        $brand->delete();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=brand&cat=trash");
}