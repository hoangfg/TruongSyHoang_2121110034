<?php 
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
if(!isset($_SESSION['useradmin']))
{
    header("location:login.php");
}
require_once('../vendor/autoload.php');
require_once('../config/database.php');
use App\Libraries\Route;// goi class
Route::route_admin();
