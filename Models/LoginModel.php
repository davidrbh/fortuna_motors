<?php

/**
 * Class LoginModel represents a model for user authentication and session management.
 */
class LoginModel extends Mysql
{
    /** @var int|null User ID. */
    private $intId_Usuario;
    /** @var string|null User email. */
    private $strUsuario;
    /** @var string|null User password. */
    private $strPassword;
    /** @var string|null User token. */
    private $strToken;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Authenticates a user based on email and password.
     *
     * @param string $usuario User's email
     * @param string $password User's password
     * @return array|null User data or null if authentication fails
     */
    public function loginUser(string $usuario, string $password)
    {
        $this->strUsuario = $usuario;
        $this->strPassword = $password;
        $sql = "SELECT id_usuario, status FROM usuario WHERE
                email_user = '$this->strUsuario' AND
                password = '$this->strPassword' AND
                status != 0";

        return $this->select($sql);
    }

    /**
     * Retrieves user data and role information for session.
     *
     * @param int $iduser User ID
     * @return array|null User data with role details or null if not found
     */
    public function sessionLogin(int $iduser)
    {
        $this->intId_Usuario = $iduser;
        $sql = "SELECT p.id_usuario,
                        p.cedula,
                        p.nombres,
                        p.apellidos,
                        p.telefono,
                        p.email_user,
                        r.id_rol,
                        r.nombre_rol,
                        p.status
                FROM usuario p
                INNER JOIN rol r ON p.rol_id = r.id_rol
                WHERE p.id_usuario = $this->intId_Usuario";

        $request = $this->select($sql);
        $_SESSION['userData'] = $request;
        return $request;
    }

    /**
     * Retrieves user data by email.
     *
     * @param string $strEmail User's email
     * @return array|null User data or null if not found
     */
    public function getUserEmail(string $strEmail)
    {
        $this->strUsuario = $strEmail;
        $sql = "SELECT id_usuario, nombres, apellidos, status FROM usuario WHERE email_user = '$this->strUsuario' AND status = 1";
        return $this->select($sql);
    }

    /**
     * Sets a token for a user.
     *
     * @param int $id_usuario User ID
     * @param string $token Token to set
     * @return bool True if token update is successful, false otherwise
     */
    public function setTokenUser(int $id_usuario, string $token)
    {
        $this->intId_Usuario = $id_usuario;
        $this->strToken = $token;
        $sql = "UPDATE usuario SET token = ? WHERE id_usuario = $this->intId_Usuario";
        $arrData = array($this->strToken);
        return $this->update($sql, $arrData);
    }

    /**
     * Retrieves user ID based on email and token.
     *
     * @param string $email User's email
     * @param string $token Token for verification
     * @return array|null User ID or null if not found
     */
    public function getUsuario(string $email, string $token)
    {
        $this->strUsuario = $email;
        $this->strToken = $token;
        $sql = "SELECT id_usuario FROM usuario WHERE email_user = '$this->strUsuario'
                AND token = '$this->strToken' AND status = 1";

        return $this->select($sql);
    }

    /**
     * Updates user password.
     *
     * @param int $id_usuario User ID
     * @param string $password New password
     * @return bool True if password update is successful, false otherwise
     */
    public function insertPassword(int $id_usuario, string $password)
    {
        $this->intId_Usuario = $id_usuario;
        $this->strPassword = $password;
        $sql = "UPDATE usuario SET password = ?, token = ? WHERE id_usuario = $this->intId_Usuario";
        $arrData = array($this->strPassword, "");
        return $this->update($sql, $arrData);
    }
}
