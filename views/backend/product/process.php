<?php

use App\Models\Product;
use App\Libraries\MyClass;
use App\Libraries\Upload;

if (isset($_POST['THEM'])) {
    $product = new Product();
    $product->name = $_POST['name'];
    $product->slug = MyClass::str_slug($_POST['name']);
    $product->detail = $_POST['detail'];
    $product->metakey = $_POST['metakey'];
    $product->metadesc = $_POST['metadesc'];

    $product->category_id = $_POST['category_id'];
    $product->brand_id = $_POST['brand_id'];
    $product->qty = $_POST['qty'];
    $product->price = $_POST['price'];
    $product->price_sale = $_POST['price_sale'];
    // $product->level = 1;
    $product->status = $_POST['status'];
    $product->created_at = date('Y-m-d H:i:s');
    $product->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    //upload file
    if (strlen($_FILES['image']['name'])) {
        $args = array(
            'path_dir' => '../public/images/product/',
            'file' => $_FILES['image'],
            'extension' => ['png', 'jpg', 'webp'],
            'maxsize' => 5000000,
            'rename' => $product->slug
        );
        $upload = Upload::saveFile($args);
        if ($upload['success'] == true) {
            $product->image = $upload['result'];
            $product->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công']);
            header("location:index.php?option=product");
        } else {
            MyClass::set_flash('message', ['type' => 'danger', 'msg' => $upload['message']]);
            header("location:index.php?option=product&cat=create");
        }
    } else {
        $product->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công & không có image']);
        header("location:index.php?option=product");
    }
}
if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $product = Product::find($id);

    $product->name = $_POST['name'];
    $product->slug = MyClass::str_slug($_POST['name']);
    $product->detail = $_POST['detail'];
    $product->metakey = $_POST['metakey'];
    $product->metadesc = $_POST['metadesc'];
    $product->category_id = $_POST['category_id'];
    $product->brand_id = $_POST['brand_id'];
    $product->qty = $_POST['qty'];
    $product->price = $_POST['price'];
    $product->price_sale = $_POST['price_sale'];
    // $product->level = $product_level->level+1;
    $product->status = $_POST['status'];
    $product->updated_at = date('y-m-d H:i:s');
    $product->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;

    $product->slug = MyClass::str_slug($product->name);
    //upload file
    if (strlen($_FILES['image']['name'])) {
        Upload::deleteFile(['path_dir' => '../public/images/product/', 'file' => $product->image]);
        $args = array(
            'path_dir' => '../public/images/product/',
            'file' => $_FILES['image'],
            'extension' => ['png', 'jpg', 'webp'],
            'maxsize' => 5000000,
            'rename' => $product->slug
        );
        $upload = Upload::saveFile($args);
        if ($upload['success'] == true) {
            $product->image = $upload['result'];
            $product->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công']);
            header("location:index.php?option=product");
        } else {
            MyClass::set_flash('message', ['type' => 'danger', 'msg' => $upload['message']]);
            header("location:index.php?option=product&cat=edit&id=$id");
        }
    } else {
        $product->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công & không đổi image']);
        header("location:index.php?option=product");
    }
}

if (isset($_POST['DELETE_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $product = Product::find($id);
        $product->status = 0;
        $product->save();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=product");
}

if (isset($_POST['DESTROY_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $product = Product::find($id);
        $product->delete();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=product&cat=trash");
}
