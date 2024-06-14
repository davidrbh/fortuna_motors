<?php

/**
 * Clase que representa el login.
 * -------------------------------
 * Class that represents login.
 */
class Login extends Controllers
{
    public function __construct()
    {
        session_start();
        if (isset($_SESSION["login"])) {
            header("Location:" . base_url() . '/home');
        }
        parent::__construct();
    }

    public function login()
    {
        $data  = [
            'page_tag' => 'Login - Fortuna Admin',
            'page_title' => 'login',
            'page_name' => 'login',
            'page_functions_js' => 'functions_login.js',
        ];
        $this->views->getView($this, "login", $data);
    }

    // public function login()
    // {

    // 	$data['page_tag'] = "Login - SIGCABAIMA";
    // 	$data['page_title'] = "Login";
    // 	$data['page_name'] = "login";
    // 	$data['page_functions_js'] = "functions_login.js";

    // 	$this->views->getView($this, "login", $data);
    // }

    // public function loginUser()
    // {
    // 	//dep($_POST);
    // 	if ($_POST) {
    // 		if (empty($_POST['txtEmail']) || empty($_POST['txtPassword'])) {
    // 			$arrResponse = array('status' => false, 'msg' => 'Error de datos');
    // 		} else {
    // 			$strUsuario = strtolower(strClean($_POST['txtEmail']));
    // 			$strPassword = hash("SHA256", $_POST['txtPassword']);
    // 			$requestUser = $this->model->loginUser($strUsuario, $strPassword);
    // 			if (empty($requestUser)) {
    // 				$arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecto.');
    // 			} else {
    // 				$arrData = $requestUser;
    // 				if ($arrData['status'] == 1) {

    // 					$_SESSION['id_User'] = $arrData['id_usuario'];
    // 					$_SESSION['login'] = true;
    // 					$_SESSION['timeout'] = true;
    // 					$_SESSION['inicio'] = time();

    // 					$arrData = $this->model->sessionLogin($_SESSION['id_User']);

    // 					sessionUser($_SESSION['id_User']); 
    // 					//$_SESSION['userData'] = $arrData; 

    // 					$arrResponse = array('status' => true, 'msg' => 'ok');

    // 				} else {
    // 					$arrResponse = array('status' => false, 'msg' => 'Usuario inactivo.');
    // 				}
    // 			}

    // 		}
    // 		sleep(1);
    // 		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    // 	}
    // 	die();
    // }


    // public function resetPass()
    // {
    // 	if ($_POST) {


    // 		if (empty($_POST['txtEmailReset'])) {
    // 			$arrResponse = array('status' => false, 'msg' => 'Error de datos');
    // 		} else {
    // 			$token = token();
    // 			$strEmail = strtolower(strClean($_POST['txtEmailReset']));
    // 			$arrData = $this->model->getUserEmail($strEmail);

    // 			if (empty($arrData)) {
    // 				$arrResponse = array('status' => false, 'msg' => 'Usuario no existente.');
    // 			} else {
    // 				$id_usuario = $arrData['id_usuario'];
    // 				$nombre_usuario = $arrData['nombres'] . ' ' . $arrData['apellidos'];

    // 				$url_recovery = base_url() . '/login/confirmUser/' . $strEmail . '/' . $token;
    // 				$requestUpdate = $this->model->setTokenUser($id_usuario, $token);

    // 				$dataUsuario = array(
    // 					'nombre_usuario' => $nombre_usuario,
    // 					'email' => $strEmail,
    // 					'asunto' => 'Recuperar cuenta - ' . NOMBRE_REMITENTE,
    // 					'url_recovery' => $url_recovery
    // 				);
    // 				if ($requestUpdate) {
    // 					$sendEmail = sendMailLocal($dataUsuario, 'email_cambioPassword');

    // 					if ($sendEmail) {
    // 						$arrResponse = array(
    // 							'status' => true,
    // 							'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña.'
    // 						);
    // 					} else {
    // 						$arrResponse = array(
    // 							'status' => false,
    // 							'msg' => 'No es posible realizar el proceso, intenta más tarde.'
    // 						);
    // 					}
    // 				} else {
    // 					$arrResponse = array(
    // 						'status' => false,
    // 						'msg' => 'No es posible realizar el proceso, intenta más tarde.'
    // 					);
    // 				}
    // 			}
    // 		}
    // 		sleep(1);
    // 		echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    // 	}
    // 	die();
    // }



    // public function confirmUser(string $params)
    // {
    // 	if (empty($params)) {
    // 		header('location: ' . base_url());
    // 	} else {

    // 		$arrParams = explode(',', $params);
    // 		$strEmail = strClean($arrParams[0]);
    // 		$strToken = strClean($arrParams[1]);

    // 		$arrResponse = $this->model->getUsuario($strEmail, $strToken);
    // 		if (empty($arrResponse)) {
    // 			header("location: " . base_url());
    // 		} else {
    // 			$data['page_tag'] = "Cambiar contraseña - SIGCABAIMA";
    // 			$data['page_title'] = "cambiar_contraseña";
    // 			$data['page_name'] = "Cambiar Contraseña";
    // 			$data['email'] = $strEmail;
    // 			$data['token'] = $strToken;
    // 			$data['id_usuario'] = $arrResponse['id_usuario'];
    // 			$data['page_functions_js'] = "functions_login.js";
    // 			$this->views->getView($this, "cambiar_password", $data);
    // 		}
    // 	}

    // 	die();

    // }

    // public function setPassword()
    // {
    // 	if (
    // 		empty($_POST['id_usuario']) || empty($_POST['txtEmail']) || empty($_POST['txtToken']) || empty($_POST['txtPassword']) ||
    // 		empty($_POST['txtPasswordConfirm'])
    // 	) {

    // 		$arrResponse = array(
    // 			'status' => false,
    // 			'msg' => 'Error de datos'
    // 		);
    // 	} else {
    // 		$intId_Usuario = intval($_POST['id_usuario']);
    // 		$strPassword = $_POST['txtPassword'];
    // 		$strPasswordConfirm = ($_POST['txtPasswordConfirm']);
    // 		$strEmail = strClean($_POST['txtEmail']);
    // 		$strToken = strClean($_POST['txtToken']);

    // 		if ($strPassword != $strPasswordConfirm) {
    // 			$arrResponse = array(
    // 				'status' => false,
    // 				'msg' => 'Las contraseñas no son iguales.'
    // 			);
    // 		} else {
    // 			$arrResponseUser = $this->model->getUsuario($strEmail, $strToken);
    // 			if (empty($arrResponseUser)) {
    // 				$arrResponse = array(
    // 					'status' => false,
    // 					'msg' => 'Error de datos.'
    // 				);
    // 			} else {
    // 				$strPassword = hash("SHA256", $strPassword);
    // 				$requestPass = $this->model->insertPassword(
    // 					$intId_Usuario,
    // 					$strPassword
    // 				);
    // 			}
    // 			if ($requestPass) {
    // 				$arrResponse = array(
    // 					'status' => true,
    // 					'msg' => 'Contraseña actualizada con éxito.'
    // 				);
    // 			} else {
    // 				$arrResponse = array(
    // 					'status' => false,
    // 					'msg' => 'No es posible realizar el proceso, intente, más tarde.'
    // 				);
    // 			}
    // 		}

    // 	}
    // 	sleep(1);
    // 	echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    // 	die();
    // }

}
