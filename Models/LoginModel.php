<?php

/**
 * Class LoginModel represents a model for user authentication and session management.
 */
class LoginModel extends Mysql
{
    /** @var int|null User ID. */
    private $intId_User;
    /** @var string|null User email. */
    private $strUser;
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
     * @param string $user User's email
     * @param string $password User's password
     * @return array|null User data or null if authentication fails
     */
    public function loginUser(string $user, string $password)
    {
        $this->strUser = $user;
        $this->strPassword = $password;
        $sql = "SELECT id_user, status 
                FROM users 
                WHERE email_user = '$this->strUser' 
                AND password = '$this->strPassword' 
                AND status != 0";

        return $this->select($sql);
    }

    /**
     * Retrieves user data and role information for session.
     *
     * @param int $idUser User ID
     * @return array|null User data with role details or null if not found
     */
    public function sessionLogin(int $idUser)
    {
        $this->intId_User = $idUser;
        $sql = "SELECT p.id_user,
                        p.cedula,
                        p.name,
                        p.last_name,
                        p.phone,
                        p.email_user,
                        r.id_rol,
                        r.name_rol,
                        p.status
                FROM users p
                INNER JOIN roles r 
                ON p.rol_id = r.id_rol
                WHERE p.id_user = $this->intId_User";

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
        $this->strUser = $strEmail;
        $sql = "SELECT id_user, name, last_name, status 
                FROM users 
                WHERE email_user = '$this->strUser' 
                AND status = 1";
        return $this->select($sql);
    }

    /**
     * Sets a token for a user.
     *
     * @param int $id_user User ID
     * @param string $token Token to set
     * @return bool True if token update is successful, false otherwise
     */
    public function setTokenUser(int $id_user, string $token)
    {
        $this->intId_User = $id_user;
        $this->strToken = $token;
        $sql = "UPDATE users 
                SET token = ? 
                WHERE id_user = $this->intId_User";
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
    public function getUser(string $email, string $token)
    {
        $this->strUser = $email;
        $this->strToken = $token;
        $sql = "SELECT id_user 
                FROM users 
                WHERE email_user = '$this->strUser'
                AND token = '$this->strToken' 
                AND status = 1";

        return $this->select($sql);
    }

    /**
     * Updates user password.
     *
     * @param int $id_user User ID
     * @param string $password New password
     * @return bool True if password update is successful, false otherwise
     */
    public function insertPassword(int $id_user, string $password)
    {
        $this->intId_User = $id_user;
        $this->strPassword = $password;
        $sql = "UPDATE users 
                SET password = ?, token = ? 
                WHERE id_user = $this->intId_User";
        $arrData = array($this->strPassword, "");
        return $this->update($sql, $arrData);
    }
}
