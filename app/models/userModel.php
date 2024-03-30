<?php

namespace app\models;

class UserModel extends Model {

    protected int $idUser;
    public string $email;
    public string $password;
    public string $pseudo;
    public string $name;
    public string $firstname;
    public bool $isAdmin;


    public function __construct() {
        $this->table = '_user';
    }
    
    public function setSession($idUser, $email, $pseudo, $isAdmin) {

        $_SESSION['user'] = [
            'idUser' => $idUser,
            'email' => $email,
            'pseudo' => $pseudo,
            'isAdmin' => $isAdmin
        ];
    }

    public function login(string $email, string $password) {
        $db = DbConnector::getInstance();
        var_dump($db);
        
        if ($db !== null) {
            $user = $this->findOneByOneParam('email', $email);
            $passwordDb = $user->password;

            if (password_verify(trim($password), trim($passwordDb))) {
                $this->setSession($idUser = $user->idUser, $email, $pseudo = $user->pseudo, $isAdmin = $user->isAdmin);
                return true;
            }
            else return false;
        }
        else return null;
    }

    public function logout(){

        session_destroy();
    }

    public function isLoggedOn() {
        
        if (!isset($_SESSION)) {
            session_start();
            return false;
        }
        
        if (isset($_SESSION['user'])) {
            $user = $this->findBy([$email=>$_SESSION["email"]]);
            if ($user["email"] === $_SESSION["email"] && $user["password"] === $_SESSION["password"])
            {
                return true;
            }
        }
    }

    public function findOneByMail($email) {

        return $this->request('SELECT * FROM `_user` WHERE email = ?', [$email])->fetch();
    }

    public function verifyExistingMail($email) {

        $result = $this->request('SELECT email FROM `_user` WHERE email = ?', [$email])->fetch();

        if ($result) {
            return false;
        }
    }

    public function verifyExistingPseudo($pseudo) {

        $result = $this->request('SELECT pseudo FROM `_user` WHERE pseudo = ?', [$pseudo])->fetch();

        if ($result) {
            return false;
        }
    }

    /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of pseudo
     */ 
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */ 
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of isAdmin
     */ 
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set the value of isAdmin
     *
     * @return  self
     */ 
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }
}