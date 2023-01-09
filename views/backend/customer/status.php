<?php

use App\Models\User;
use App\Libraries\MyClass;
$id = $_REQUEST['id'];
$customer = User::find($id);
if($customer == null)
{
    MyClass::set_flash('message', ['type'=>'danger', 'msg'=>'Mẫu tin không tồn tại']);
    header("location:index.php?option=customer");
}
$customer->status = ($customer->status == 1) ? 2 : 1;
$customer->updated_at=date('Y-m-d H:i:s');
$customer->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1; //id cua nguoi dang nhap
$customer->save();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công']);
header("location:index.php?option=customer");
?>