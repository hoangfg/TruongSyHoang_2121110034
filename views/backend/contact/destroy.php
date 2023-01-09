<?php

use App\Models\Contact;
use App\Libraries\MyClass;

$id = $_REQUEST['id'];
$contact = Contact::find($id);
if($contact == null)
{
    MyClass::set_flash('message', ['type'=>'danger', 'msg'=>'Mẫu tin không tồn tại']);
    header("location:index.php?option=contact&cat=trash");
}
$contact->delete();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Hủy thành công']);
header("location:index.php?option=contact&cat=trash");
?>