<?php
session_start(); // Única llamada a session_start()
require_once('./Controllers/controller.php');
require_once('./Controllers/loginController.php');

$mvc = new MVCController();

if (isset($_GET['action']) && $_GET['action'] === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController = new AuthController();
    $authController->login($_POST['username'], $_POST['password']);
} else {
    $mvc->template();
}