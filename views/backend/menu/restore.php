<?php

use App\Models\Menu;
use App\Libraries\MyClass;
$id = $_REQUEST['id'];
$menu = Menu::find($id);
if($menu == null)
{
    MyClass::set_flash('message', ['type'=>'danger', 'msg'=>'Mẫu tin không tồn tại']);
    header("location:index.php?option=menu");
}
$menu->status = 2;
$menu->updated_at=date('Y-m-d H:i:s');
$menu->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1; //id cua nguoi dang nhap
$menu->save();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Khôi phục thành công']);
header("location:index.php?option=menu&cat=trash");
?>