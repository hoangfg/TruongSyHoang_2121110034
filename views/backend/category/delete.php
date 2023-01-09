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
    header("location:index.php?option=category");
}
$category->status = 0;
$category->updated_at=date('Y-m-d H:i:s');
$category->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1; //id cua nguoi dang nhap
$category->save();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
header("location:index.php?option=category");
