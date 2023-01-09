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
    header("location:index.php?option=product&cat=trash");
}
$product->delete();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Hủy thành công']);
header("location:index.php?option=product&cat=trash");
?>