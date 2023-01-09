<?php

use App\Models\Post;
use App\Libraries\MyClass;
/*
$row lay 1 mau tin
$list lay nhieu mau tin
*/

$id = $_REQUEST['id'];
$page = Post::find($id);
if($page == null)
{
    MyClass::set_flash('message', ['type'=>'danger', 'msg'=>'Mẫu tin không tồn tại']);
    header("location:index.php?option=page&cat=trash");
}
$page->delete();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Hủy thành công']);
header("location:index.php?option=page&cat=trash");
?>