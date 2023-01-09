<?php

use App\Models\Slider;
use App\Libraries\MyClass;
use App\Libraries\Upload;
if (isset($_POST['THEM'])) {
    $slider = new Slider();
    $slider->name = $_POST['name'];
    $slider->slug = MyClass::str_slug($_POST['name']);
    $slider->link = $_POST['link'];
    $slider->position = $_POST['position'];
    $slider->sort_order = $_POST['sort_order']+1;
    // $slider->level = 1;
    $slider->status = $_POST['status'];
    $slider->created_at = date('Y-m-d H:i:s');
    $slider->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    //upload file
    if(strlen($_FILES['image']['name'])) {
        $args=array(
            'path_dir'=>'../public/images/slider/',
            'file'=>$_FILES['image'],
            'extension'=>['png','jpg','webp'],
            'maxsize'=>5000000,
            'rename'=>$slider->slug
        );
        $upload = Upload::saveFile($args);
        if($upload['success']==true) {
            $slider->image=$upload['result'];
            $slider->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công']);
            header("location:index.php?option=slider");
        } else {
            MyClass::set_flash('message', ['type' => 'danger', 'msg' => $upload['message']]);
            header("location:index.php?option=slider&cat=create");
        }
    } else {
        $slide->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công & không có image']);
        header("location:index.php?option=slider");
    }
    
}
if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $slider =Slider::find($id);
    $slider->name = $_POST['name'];
    $slider->slug = MyClass::str_slug($_POST['name']);
    $slider->link = $_POST['link'];
    $slider->position = $_POST['position'];
    $slider->sort_order = $_POST['sort_order']+1;
    // $slider->level = $slider_level->level+1;
    $slider->status = $_POST['status'];
    $slider->updated_at = date('Y-m-d H:i:s');
    $slider->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    $slider->slug=MyClass::str_slug($slider->name);
    //upload file
    if (strlen($_FILES['image']['name'])) {
        Upload::deleteFile(['path_dir'=>'../public/images/slider/', 'file' => $slider-> image]);
        $args = array(
            'path_dir' => '../public/images/slider/',
            'file' => $_FILES['image'],
            'extension' => ['png', 'jpg', 'webp'],
            'maxsize' => 5000000,
            'rename' => $slider->slug
        );
        $upload = Upload::saveFile($args);
        if ($upload['success'] == true) {
            $slider->image = $upload['result'];
            $slider->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công']);
            header("location:index.php?option=slider");
        } else {
            MyClass::set_flash('message', ['type' => 'danger', 'msg' => $upload['message']]);
            header("location:index.php?option=slider&cat=edit&id=$id");
        }
    } else {
        $slider->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công & không đổi image']);
        header("location:index.php?option=slider");
    }
}


if (isset($_POST['DELETE_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $slider = Slider::find($id);
        $slider->status = 0;
        $slider->save();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=slider");
}

if (isset($_POST['DESTROY_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $slider = Slider::find($id);
        $slider->delete();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=slider&cat=trash");
}
