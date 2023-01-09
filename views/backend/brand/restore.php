<?php

use App\Models\Brand;
use App\Libraries\MyClass;
$id = $_REQUEST['id'];
$brand = Brand::find($id);
if($brand == null)
{
    MyClass::set_flash('message', ['type'=>'danger', 'msg'=>'Mẫu tin không tồn tại']);
    header("location:index.php?option=brand");
}
$brand->status = 2;
$brand->updated_at=date('Y-m-d H:i:s');
$brand->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1; //id cua nguoi dang nhap
$brand->save();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Khôi phục thành công']);
header("location:index.php?option=brand&cat=trash");
?>