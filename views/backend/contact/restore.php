<?php

use App\Models\Contact;
use App\Libraries\MyClass;
$id = $_REQUEST['id'];
$contact = Contact::find($id);
if($contact == null)
{
    MyClass::set_flash('message', ['type'=>'danger', 'msg'=>'Mẫu tin không tồn tại']);
    header("location:index.php?option=contact");
}
$contact->status = 2;
$contact->updated_at=date('Y-m-d H:i:s');
$contact->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1; //id cua nguoi dang nhap
$contact->save();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Khôi phục thành công']);
header("location:index.php?option=contact&cat=trash");
?>