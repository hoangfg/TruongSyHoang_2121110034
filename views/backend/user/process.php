<?php 
use App\Models\User;
use App\Libraries\MyClass;
use App\Libraries\Upload;

if(isset($_POST['THEM'])) {
    $user = new User();
    $user ->name = $_POST['name'];
    $user ->username = $_POST['username'];
    $user -> slug = MyClass::str_slug($_POST['name']);
    $user ->password = sha1($_POST['password']);
    $user ->email = $_POST['email'];
    $user ->gender = $_POST['gender'];
    $user ->address = $_POST['address'];
    $user ->phone = $_POST['phone'];
    $user ->roles = 1;
    $user ->status = $_POST['status'];
    $user ->created_at = date('Y-m-d H:i:s');
    $user -> created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id']:1;
    if($_POST['password'] != $_POST['password_re']) {
        MyClass::set_flash('message', ['type'=>'danger', 'msg'=> 'Your password is not correct, please enter again.']);
        header("location:index.php?option=user&cat=create");
    }
    
    if (strlen($_FILES['image']['name'])) {
        $args = array(
            'path_dir' => '../public/images/user/',
            'file' => $_FILES['image'],
            'extension' => ['png', 'jpg', 'webp'],
            'maxsize' => 5000000,
            'rename' => $user->slug
        );
        $upload = Upload::saveFile($args);
        
        if ($upload['success'] == true) {
            $user->image = $upload['result'];
            $user->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công']);
            header("location:index.php?option=user");
        } else {
            MyClass::set_flash('message', ['type' => 'danger', 'msg' => $upload['message']]);
            header("location:index.php?option=user&cat=create");
        }
    } else {
        $user->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công & không có image']);
        header("location:index.php?option=user");
    }

}
if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $user = User::find($id);
    $user->name = $_POST['name'];
    $user->username = $_POST['username'];
    $user->slug = MyClass::str_slug($_POST['name']);
    $user->password = sha1($_POST['password']);
    $user->email = $_POST['email'];
    $user->gender = $_POST['gender'];
    $user->address = $_POST['address'];
    $user->phone = $_POST['phone'];
    $user->roles = 1;
    $user->status = $_POST['status'];
    $user->updated_at = date('Y-m-d H:i:s');
    $user->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    if ($_POST['password'] != $_POST['password_re']) {
        MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Your password is not correct, please enter again.']);
        header("location:index.php?option=user&cat=edit&id=$id");
    }
    $user->slug = MyClass::str_slug($user['name']);
    if (strlen($_FILES['image']['name'])) {
        Upload::deleteFile(['path_dir' => '../public/images/user/', 'file' => $user->image]);
        $args = array(
            'path_dir' => '../public/images/user/',
            'file' => $_FILES['image'],
            'extension' => ['png', 'jpg', 'webp'],
            'maxsize' => 5000000,
            'rename' => $user->slug
        );
        $upload = Upload::saveFile($args);
        if ($upload['success'] == true) {
            $user->image = $upload['result'];
            $user->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công']);
            header("location:index.php?option=user");
        } else {
            MyClass::set_flash('message', ['type' => 'danger', 'msg' => $upload['message']]);
            header("location:index.php?option=user&cat=edit&id=$id");
        }
    } else {
        $user->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công & không đổi image']);
        header("location:index.php?option=user");
    }
}

if (isset($_POST['DELETE_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $user = User::find($id);
        $user->status = 0;
        $user->save();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=user");
}

if (isset($_POST['DESTROY_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $user = User::find($id);
        $user->delete();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=user&cat=trash");
}