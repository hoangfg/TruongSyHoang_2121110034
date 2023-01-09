<?php
use App\Models\User;
use App\Libraries\MyClass;
$id = $_REQUEST['id'];
$customer = User::find($id);
if($customer == null) {
    MyClass::set_flash('message', ['type'=>'danger', 'msg'=>'Mẫu tin không tồn tại']);
    header("location:index.php?option=customer&cat=trash");
}
$customer->delete();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Hủy thành công']);
header("location:index.php?option=customer&cat=trash");
?>