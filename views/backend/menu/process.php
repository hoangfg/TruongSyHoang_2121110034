<?php

use App\Models\Menu;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Topic;
use App\Models\Post;
use App\Libraries\MyClass;
use App\Libraries\Upload;


if (isset($_POST['update_sort_order'])) {
    $list_menu = $_POST['sort_order'];
    foreach ($list_menu as $id => $sort_order) {
        $menu = Menu::find($id);
        $menu->sort_order = $sort_order;
        $menu->save();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Lưu sắp xếp thành công']);
    header("location:index.php?option=menu");
}

if (isset($_POST['AddCategory'])) {
    if (isset($_POST['categoryId'])) {
        $List_categoryId = $_POST['categoryId'];
        foreach ($List_categoryId as $id) {
            $category = Category::find($id);
            $menu = new Menu();
            $menu->name = $category->name;
            $menu->link = 'index.php?option=product&cat=' . $category['slug'];
            $menu->type = 'category';
            $menu->table_id = $id;
            $menu->sort_order = 1;
            $menu->position = $_POST['position'];
            $menu->parent_id = 0;
            $menu->level = 1;
            $menu->created_at = date('Y-m-d H:i:s');
            $menu->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
            $menu->status = 2;
            $menu->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm danh mục sản phẩm thành công']);
        }
    } else {
        MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Chưa chọn danh mục']);
    }
    header("location:index.php?option=menu");
}
if (isset($_POST['AddBrand'])) {
    if (isset($_POST['brandId'])) {
        $List_brandId = $_POST['brandId'];
        foreach ($List_brandId as $id) {
            $brand = Brand::find($id);
            $menu = new Menu();
            $menu->name = $brand->name;
            $menu->link = 'index.php?option=product&cat=' . $brand['slug'];
            $menu->type = 'brand';
            $menu->table_id = $id;
            $menu->sort_order = 1;
            $menu->position = $_POST['position'];
            $menu->parent_id = 0;
            $menu->level = 1;
            $menu->created_at = date('Y-m-d H:i:s');
            $menu->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
            $menu->status = 2;
            $menu->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công']);
        }
    } else {
        MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Chưa nhập tên và đường dẫn']);
    }
    header("location:index.php?option=menu");
}
if (isset($_POST['AddTopic'])) {
    if (isset($_POST['topicId'])) {
        $List_topicId = $_POST['topicId'];
        foreach ($List_topicId as $id) {
            $topic = Topic::find($id);
            $menu = new Menu();
            $menu->name = $topic->name;
            $menu->link = 'index.php?option=product&cat=' . $topic['slug'];
            $menu->type = 'topic';
            $menu->table_id = $id;
            $menu->sort_order = 1;
            $menu->position = $_POST['position'];
            $menu->parent_id = 0;
            $menu->level = 1;
            $menu->created_at = date('Y-m-d H:i:s');
            $menu->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
            $menu->status = 2;
            $menu->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm chủ đề bài viết thành công']);
        }
    } else {
        MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Chưa chọn chủ đề bài viết']);
    }
    header("location:index.php?option=menu");
}
if (isset($_POST['AddPage'])) {
    if (isset($_POST['pageId'])) {
        $List_pageId = $_POST['pageId'];
        foreach ($List_pageId as $id) {
            $page = Post::find($id);
            $menu = new Menu();
            $menu->name = $page->title;
            $menu->link = 'index.php?option=product&cat=' . $page['slug'];
            $menu->type = 'page';
            $menu->table_id = $id;
            $menu->sort_order = 1;
            $menu->position = $_POST['position'];
            $menu->parent_id = 0;
            $menu->level = 1;
            $menu->created_at = date('Y-m-d H:i:s');
            $menu->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
            $menu->status = 2;
            $menu->save();
            MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm trang đơn thành công']);
        }
    } else {
        MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Chưa chọn trang đơn']);
    }
    header("location:index.php?option=menu");
}
if (isset($_POST['AddCustom'])) {
    if (strlen($_POST['name']) > 0 && strlen($_POST['link'] > 0)) {
        $menu = new Menu();
        $menu->name = $_POST['name'];
        $menu->link = $_POST['link'];
        $menu->type = 'custom';
        $menu->sort_order = 1;
        $menu->position = $_POST['position'];
        $menu->parent_id = 0;
        $menu->level = 1;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
        $menu->status = 2;
        $menu->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công']);
    } else {
        MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Đường dẫn hoặc tên menu không hợp lệ']);
    }
    header("location:index.php?option=menu");
}
if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $menu = Menu::find($id);
    $menu->name = $_POST['name'];
    $menu->link = $_POST['link'];

    $menu->position = $_POST['position'];
    $menu->parent_id = $_POST['parent_id'];
    $menu->level = ($menu->parent_id == 0) ? 1 : 2;
    $menu->updated_at = date('Y-m-d H:i:s');
    $menu->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
    $menu->status = $_POST['status'];
    if (strlen($_POST['link']) < 5) {
        MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Đường dẫn không hợp lệ']);
        header("location:index.php?option=menu&cat=edit&id=$id");
    }
    else {
        $menu->save();
        MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công']);
        header("location:index.php?option=menu");
    }
}


if (isset($_POST['DELETE_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $menu = Menu::find($id);
        $menu->status = 0;
        $menu->save();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=menu");
}

if (isset($_POST['DESTROY_ALL'])) {
    $list = $_POST['checkId'];
    foreach ($list as $id) {
        $menu = Menu::find($id);
        $menu->delete();
    }
    MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Xóa thành công']);
    header("location:index.php?option=menu&cat=trash");
}