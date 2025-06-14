<?php 
session_start(); 

$route = $_GET['route'] ?? 'product';
$action = $_GET['action'] ?? 'index';

// ROUTING 1 – xử lý route kiểu ?route=account&action=login
switch ($route) {
    case 'account':
        require_once 'app/controllers/AccountController.php';
        $controller = new AccountController();

        switch ($action) {
            case 'register':
                $controller->register();
                exit;
            case 'login':
                $controller->login();
                exit;
            case 'save':
                $controller->save();
                exit;
            case 'checklogin':
                $controller->checkLogin();
                exit;
            case 'logout':
                $controller->logout();
                exit;
            case 'forgot-password':
                $controller->forgotPassword();
                exit;
            case 'send-reset-email':
                $controller->sendResetEmail();
                exit;
            case 'reset-password':
                $controller->resetPassword();
                exit;
            case 'process-reset-password':
                $controller->processResetPassword();
                exit;
            case 'change-password':
                $controller->changePassword();
                exit;
            case 'process-change-password':
                $controller->processChangePassword();
                exit;
            default:
                $controller->login();
                exit;
        }
        break;
        case 'product':
            break;
    // Có thể thêm routing khác như:
    // case 'category': ...
    //     break;
}


// ROUTING 2 – fallback: kiểu /product/add
require_once 'app/models/ProductModel.php'; 
require_once 'app/helpers/SessionHelper.php'; 

$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Tìm controller
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'ProductController';

// Tìm action
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

if (!file_exists('app/controllers/' . $controllerName . '.php')) {
    die('Controller not found');
}

require_once 'app/controllers/' . $controllerName . '.php';

$controller = new $controllerName();

if (!method_exists($controller, $action)) {
    die('Action not found');
}

call_user_func_array([$controller, $action], array_slice($url, 2));
