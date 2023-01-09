<?php

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Orderdetail;
use App\Libraries\Cart;
//them vao gio hang
if (isset($_REQUEST['addcart'])) {
    $id = $_REQUEST['addcart'];
    $product = Product::find($id);
    $cart_item = array(
        'id' => $product->id,
        'price' => $product->price,
        'qty' => 1,
        'amount' => $product->price

    );
    if (isset($_SESSION['contentcart'])) {
        $carts = $_SESSION['contentcart'];
        if ((Cart::cart_exists($carts, $id) == true)) {
            $carts = Cart::cart_update($carts, $id, 1);
        } else {
            $carts[] = $cart_item;
        }
        $_SESSION['contentcart'] = $carts;
    } else {
        $carts[] = $cart_item;
        $_SESSION['contentcart'] = $carts;
    }
    header('location:index.php?option=cart');
}
//xoa khoi gio hang
if (isset($_REQUEST['delcart'])) {
    $id = $_REQUEST['delcart'];
    if (isset($_SESSION['contentcart'])) {
        $carts = $_SESSION['contentcart'];
        $carts = Cart::cart_delete($carts, $id);
        $_SESSION['contentcart'] = $carts;
    }
    header('location:index.php?option=cart');
}
//cap nhat gio hang
if (isset($_POST['updateCart'])) {
    $arr_qty = $_POST['qty'];
    foreach ($arr_qty as $id => $number) {
        $carts = $_SESSION['contentcart'];
        $carts = Cart::cart_update($carts, $id, $number, "update");
        $_SESSION['contentcart'] = $carts;
    }
    header('location:index.php?option=cart');
    // print_r($arr_qty);

}
//thanh toan
if (isset($_REQUEST['checkoutcart'])) {
    $id = $_SESSION['user_id'];
    $user = User::find($id);

    $date = getdate();
    $order = new Order();  
    $order->code = $date[0];
    $order->user_id = $_SESSION['user_id'];
    $order->deliveryname = (isset($_POST['deliveryname']) && $_POST['deliveryname'] != "") ? $_POST['deliveryname'] : $user['name'] ;
    $order->deliveryphone = (isset($_POST['deliveryphone']) && $_POST['deliveryphone'] != "") ? $_POST['deliveryphone'] : $user['phone'] ;
    $order->deliveryemail = (isset($_POST['deliveryemail']) && $_POST['deliveryemail'] != "") ? $_POST['deliveryemail'] : $user['email'] ;
    $order->deliveryaddress = (isset($_POST['deliveryaddress']) && $_POST['deliveryaddress'] != "") ? $_POST['deliveryaddress'] : $user['address'] ;
    $order->created_at = date('Y-m-d H:i:s');
    $order->status = 2;


    if ($order->save()) {
        $carts = $_SESSION['contentcart'];
        foreach ($carts as $cart) {
            $orderdertail = new Orderdetail();
            $orderdertail->order_id = $order->id;
            $orderdertail->product_id = $cart['id'];
            $orderdertail->price = $cart['price'];
            $orderdertail->qty = $cart['qty'];
            $orderdertail->amount = $cart['amount'];
            $orderdertail->save();
        }
    }
    unset($_SESSION['contentcart']);
    header('location:index.php?option=cart');
    //echo "$order->deliveryname";
    // print_r($date);
}

//hien thi

if (isset($_REQUEST['checkout'])) {
    require_once('views/frontend/cart-checkout.php');
} else {
    require_once('views/frontend/cart-content.php');
}
