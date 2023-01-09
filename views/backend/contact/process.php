<?php

use App\Libraries\MyClass;
use App\Models\Contact;

if (isset($_POST['TRALOI'])) {
    $id = $_POST['id'];
    $contact = Contact::find($id);
    $contact->replaydetail = $_POST['replaydetail'];
    $contact->updated_at = date('Y-m-d H:i:s');
    $contact->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    $contact -> status = 2;
    $contact -> save();
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Trả lời thành công']);
    header("location:index.php?option=contact");
}
if (isset($_POST['DELETE_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $contact = Contact::find($id);
        $contact->status = 0;
        $contact->save();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=contact");
}

if (isset($_POST['DESTROY_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $contact = Contact::find($id);
        $contact->delete();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=contact&cat=trash");
}
