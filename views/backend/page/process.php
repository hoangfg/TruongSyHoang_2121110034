<?php

use App\Models\Post;
use App\Libraries\MyClass;
use App\Libraries\Upload;

if (isset($_POST['THEM'])) {
    $post = new Post();
    $post->title = $_POST['title'];
    $post->slug = MyClass::str_slug($_POST['title']);
    $post->detail = $_POST['detail'];
    $post->metakey = $_POST['metakey'];
    $post->metadesc = $_POST['metadesc'];
    // $post->level = 1;
    $post->status = $_POST['status'];
    $post->type = 'page';
    $post->created_at = date('Y-m-d H:i:s');
    $post->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    //upload file
    if (strlen($_FILES['image']['name'])) {
        $args = array(
            'path_dir' => '../public/images/post/',
            'file' => $_FILES['image'],
            'extension' => ['png', 'jpg', 'webp'],
            'maxsize' => 5000000,
            'rename' => $post->slug
        );
        $upload = Upload::saveFile($args);
        if ($upload['success'] == true) {
            $post->image = $upload['result'];
            $post->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công']);
            header("location:index.php?option=page");
        } else {
            MyClass::set_flash('message', ['type' => 'danger', 'msg' => $upload['message']]);
            header("location:index.php?option=page&cat=create");
        }
    } else {
        $page->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công & không có image']);
        header("location:index.php?option=page");
    }
}
if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $post = Post::find($id);

    $post->title = $_POST['title'];
    $post->slug = MyClass::str_slug($_POST['title']);
    $post->detail = $_POST['detail'];
    $post->metakey = $_POST['metakey'];
    $post->metadesc = $_POST['metadesc'];


    // $post->level = 1;
    $post->status = $_POST['status'];
    $post->type = 'page';
    $post->updated_at = date('Y-m-d H:i:s');
    $post->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    //upload file
    $post->slug = MyClass::str_slug($post['title']);
    if (strlen($_FILES['image']['name'])) {
        Upload::deleteFile(['path_dir' => '../public/images/post/', 'file' => $post->image]);
        $args = array(
            'path_dir' => '../public/images/post/',
            'file' => $_FILES['image'],
            'extension' => ['png', 'jpg', 'webp'],
            'maxsize' => 5000000,
            'rename' => $post->slug
        );
        $upload = Upload::saveFile($args);
        if ($upload['success'] == true) {
            $post->image = $upload['result'];
            $post->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công']);
            header("location:index.php?option=page");
        } else {
            MyClass::set_flash('message', ['type' => 'danger', 'msg' => $upload['message']]);
            header("location:index.php?option=page&cat=edit&id=$id");
        }
    } else {
        $post->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công & không đổi image']);
        header("location:index.php?option=page");
    }
}
if (isset($_POST['DELETE_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $post = Post::find($id);
        $post->status = 0;
        $post->save();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=page");
}

if (isset($_POST['DESTROY_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $post = Post::find($id);
        $post->delete();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=page&cat=trash");
}
