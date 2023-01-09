<?php

use App\Models\Slider;
use App\Libraries\MyClass;
$id = $_REQUEST['id'];
$slider = Slider::find($id);
if($slider == null)
{
    MyClass::set_flash('message', ['type'=>'danger', 'msg'=>'Mẫu tin không tồn tại']);
    header("location:index.php?option=slider");
}
$slider->status = 2;
$slider->updated_at=date('Y-m-d H:i:s');
$slider->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1; //id cua nguoi dang nhap
$slider->save();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Khôi phục thành công']);
header("location:index.php?option=slider&cat=trash");
?>