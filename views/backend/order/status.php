<?php 
use App\Models\Order;
use App\Libraries\MyClass;
$id = $_REQUEST['id'];
$order = Order::find($id);
if($order == null) {
    MyClass::set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
    header("location:index.php?option=order");
}
$type = $_REQUEST['type'];
switch ($type) {
    case 'xacnhan': {
        $order -> status=1;
        break;
    }
    case 'donggoi': {
        $order -> status=2;
        break;
    }
    case 'vanchuyen': {
        $order -> status=3;
        break;
    }
    case 'dagiao': {
        $order -> status=4;
        break;
    }
    case 'huy': {
        $order -> status=5;
        break;
    }
}
$order -> updated_at = date('Y-m-d H:i:s');
$order -> updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id']:1;
$order -> save();
MyClass::set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công']);
header("location:index.php?option=order");
?>