<?php

use App\Models\User;
use App\Libraries\MyClass;
$id = $_REQUEST['id'];
$user = User::find($id);
if($user == null)
{
    MyClass::set_flash('message', ['type'=>'danger', 'msg'=>'Mẫu tin không tồn tại']);
    header("location:index.php?option=user");
}
$user->status = ($user->status == 1) ? 2 : 1;
$user->updated_at=date('Y-m-d H:i:s');
$user->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1; //id cua nguoi dang nhap
$user->save();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công']);
header("location:index.php?option=user");
?>