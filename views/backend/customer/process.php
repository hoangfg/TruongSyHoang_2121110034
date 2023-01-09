<?php

use App\Models\User;
use App\Libraries\MyClass;
use App\Libraries\Upload;

if (isset($_POST['THEM'])) {
    $customer = new User();
    $customer->name = $_POST['name'];
    $customer-> username = $_POST['username'];
    $customer->slug = MyClass::str_slug($_POST['name']);
    $customer->password = sha1($_POST['password']);
    $customer->email = $_POST['email'];
    $customer->gender = $_POST['gender'];
    $customer->address = $_POST['address'];
    $customer->phone = $_POST['phone'];
    $customer->roles = 0;
    $customer->status = $_POST['status'];
    $customer->created_at = date('Y-m-d H:i:s');
    $customer->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    if ($_POST['password'] != $_POST['password_re']) {
        MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Your password is not correct, please enter again.']);
        header("location:index.php?option=customer&cat=create");
    }
    $customer->slug = MyClass::str_slug($customer['name']);
    if (strlen($_FILES['image']['name'])) {
        $args = array(
            'path_dir' => '../public/images/user/',
            'file' => $_FILES['image'],
            'extension' => ['png', 'jpg', 'webp'],
            'maxsize' => 5000000,
            'rename' => $customer->slug
        );
        $upload = Upload::saveFile($args);

        if ($upload['success'] == true) {
            $customer->image = $upload['result'];
            $customer->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công']);
            header("location:index.php?option=customer");
        } else {
            MyClass::set_flash('message', ['type' => 'danger', 'msg' => $upload['message']]);
            header("location:index.php?option=customer&cat=create");
        }
    } else {
        $customer->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công & không có image']);
        header("location:index.php?option=customer");
    }
}
if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $customer = User::find($id);
    $customer->name = $_POST['name'];
    $customer->username = $_POST['username'];
    $customer->slug = MyClass::str_slug($_POST['name']);
    $customer->password = sha1($_POST['password']);
    $customer->email = $_POST['email'];
    $customer->gender = $_POST['gender'];
    $customer->address = $_POST['address'];
    $customer->phone = $_POST['phone'];
    $customer->roles = 0;
    $customer->status = $_POST['status'];
    $customer->updated_at = date('Y-m-d H:i:s');
    $customer->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    if ($_POST['password'] != $_POST['password_re']) {
        MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Your password is not correct, please enter again.']);
        header("location:index.php?option=customer&cat=edit&id=$id");
    }

    if (strlen($_FILES['image']['name'])) {
        Upload::deleteFile(['path_dir' => '../public/images/user/', 'file' => $customer->image]);
        $args = array(
            'path_dir' => '../public/images/user/',
            'file' => $_FILES['image'],
            'extension' => ['png', 'jpg', 'webp'],
            'maxsize' => 5000000,
            'rename' => $customer->slug
        );
        $upload = Upload::saveFile($args);
        if ($upload['success'] == true) {
            $customer->image = $upload['result'];
            $customer->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công']);
            header("location:index.php?option=customer");
        } else {
            MyClass::set_flash('message', ['type' => 'danger', 'msg' => $upload['message']]);
            header("location:index.php?option=customer&cat=edit&id=$id");
        }
    } else {
        $customer->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công & không đổi image']);
        header("location:index.php?option=customer");
    }
}

if (isset($_POST['DELETE_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $customer = User::find($id);
        $customer->status = 0;
        $customer->save();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=customer");
}

if (isset($_POST['DESTROY_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $customer = User::find($id);
        $customer->delete();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=customer&cat=trash");
}