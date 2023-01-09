<?php

use App\Models\Product;
use App\Libraries\MyClass;
/*
$row lay 1 mau tin
$list lay nhieu mau tin
*/

$id = $_REQUEST['id'];
$product = Product::find($id);
if($product == null)
{
    MyClass::set_flash('message', ['type'=>'danger', 'msg'=>'Mẫu tin không tồn tại']);
    header("location:index.php?option=product");
}
$product->status = ($product->status == 1) ? 2 : 1;
$product->updated_at=date('Y-m-d H:i:s');
$product->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1; //id cua nguoi dang nhap
$product->save();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công']);
header("location:index.php?option=product");
?>