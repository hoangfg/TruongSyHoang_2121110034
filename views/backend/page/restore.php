<?php

use App\Models\Post;
use App\Libraries\MyClass;
$id = $_REQUEST['id'];
$page = Post::find($id);
if($page == null)
{
    MyClass::set_flash('message', ['type'=>'danger', 'msg'=>'Mẫu tin không tồn tại']);
    header("location:index.php?option=page");
}
$page->status = 2;
$page->updated_at=date('Y-m-d H:i:s');
$page->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1; //id cua nguoi dang nhap
$page->save();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Khôi phục thành công']);
header("location:index.php?option=page&cat=trash");
?>