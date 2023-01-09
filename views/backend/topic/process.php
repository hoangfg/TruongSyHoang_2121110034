<?php

use App\Models\Topic;
use App\Libraries\MyClass;
use App\Libraries\Upload;
if (isset($_POST['THEM'])) {
    $topic = new Topic();
    $topic->name = $_POST['name'];
    $topic->slug = MyClass::str_slug($_POST['name']);
    $topic->metakey = $_POST['metakey'];
    $topic->metadesc = $_POST['metadesc'];
    $topic->parent_id = $_POST['parent_id'];
    $topic->sort_order = $_POST['sort_order'];
    // $topic->level = 1;
    $topic->status = $_POST['status'];
    $topic->created_at = date('Y-m-d H:i:s');
    $topic->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    //upload file
    $topic->save();
    MyClass::set_flash('message', ['type'=>'success','msg'=>'Thêm thành công']);
    header("location:index.php?option=topic");
}
if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $topic =Topic::find($id);
    $topic->name = $_POST['name'];
    $topic->slug = MyClass::str_slug($_POST['name']);
    $topic->metakey = $_POST['metakey'];
    $topic->metadesc = $_POST['metadesc'];
    $topic->parent_id = $_POST['parent_id'];
    $topic->sort_order = $_POST['sort_order'];
    // $topic->level = $topic_level->level+1;
    $topic->status = $_POST['status'];
    $topic->updated_at = date('Y-m-d H:i:s');
    $topic->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    $topic->slug=MyClass::str_slug($topic->name);
    $topic->save();
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công']);
    header("location:index.php?option=topic");
}
if (isset($_POST['DELETE_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $topic = Topic::find($id);
        $topic->status = 0;
        $topic->save();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=topic");
}

if (isset($_POST['DESTROY_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $topic = Topic::find($id);
        $topic->delete();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=topic&cat=trash");
}