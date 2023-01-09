<?php

use App\Models\Category;
use App\Libraries\MyClass;
/*
$row lay 1 mau tin
$list lay nhieu mau tin
*/

$id = $_REQUEST['id'];
$category = Category::find($id);
if($category == null)
{
    MyClass::set_flash('message', ['type'=>'danger', 'msg'=>'Mẫu tin không tồn tại']);
    header("location:index.php?option=category&cat=trash");
}
$category->delete();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Hủy thành công']);
header("location:index.php?option=category&cat=trash");
?>