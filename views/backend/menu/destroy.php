<?php

use App\Models\Menu;
use App\Libraries\MyClass;
/*
$row lay 1 mau tin
$list lay nhieu mau tin
*/

$id = $_REQUEST['id'];
$menu = Menu::find($id);
if($menu == null)
{
    MyClass::set_flash('message', ['type'=>'danger', 'msg'=>'Mẫu tin không tồn tại']);
    header("location:index.php?option=menu&cat=trash");
}
$menu->delete();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Hủy thành công']);
header("location:index.php?option=menu&cat=trash");
?>