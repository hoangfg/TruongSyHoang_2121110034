<?php

use App\Models\Order;
use App\Libraries\MyClass;
/*
$row lay 1 mau tin
$list lay nhieu mau tin
*/
$id = $_REQUEST['id'];
$order = Order::find($id);
if($order == null)
{
    MyClass::set_flash('message', ['type'=>'danger', 'msg'=>'Mẫu tin không tồn tại']);
    header("location:index.php?option=order");
}
$order->status = 5;
$order->updated_at=date('Y-m-d H:i:s');
$order->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1; //id cua nguoi dang nhap
$order->save();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
header("location:index.php?option=order");
