<?php

final class Helper
{ 
    #don't touch anything here	
    public static function getUrlParam($name)
    {
        if (!array_key_exists($name, $_GET))
        {
            throw new NotFoundException('URL parameter "' . $name . '" not found.');
        }
        return $_GET[$name];
    }

    public static function redirect($page, array $params = []) 
    {
        header('Location: ' . self::createLink($page, $params));
        die();
    }

    public static function createLink($page, array $params = [])
    {
        unset($params['page']);
        return (empty($params))?$page :$page.'&'.http_build_query($params);
    }

    public static function capitalize($string) 
    {
        return ucfirst(mb_strtolower($string));
    }

    public static function escape($string)
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}

// declare the class in index.php
final class User{

    private $id;
    private $name;
    private $email;
    private $password;

    function __construct(){

    }

    public function setParam(stdClass $user){

        if(array_key_exists('id', $user)){
            $this->id = $user->id;
        }

        if(array_key_exists('name', $user)){
            $this->name = $user->name;
        }

        if(array_key_exists('email', $user)){
            $this->email = $user->email;
        }

        if(array_key_exists('password', $user)){
            $this->password = $user->password;
        }
    }

    public function register( array $user){
        $errors = [];

        if(trim($user['name'])){
            $this->name = $user['name'];
        }
        else{
            $errors[] = new ValidatorError('name','name cannot be empty');
        }

        if(trim($user['email'])){
            $this->email = $user['email'];
        }
        else{
            $errors[] = new ValidatorError('email','email cannot be empty');
        }

        if(trim($user['password'])){
            $this->password = $user['password'];
        }
        else{
            $errors[] = new ValidatorError('password','password cannot be empty');
        }
        
        if(trim($user['password2'])){
            if($user['password2'] != $this->password){
                $errors[] = new ValidatorError('Password Match','Password and passwordRepeat must match');
            }
        }
        else{
            $errors[] = new ValidatorError('passwordRepeat','passwordRepeat cannot be empty');
        }
        
        return $errors;
    }

    public function login( array $user){
        $errors = [];

        if(trim($user['email'])){
            $this->email = $user['email'];
        }
        else{
            $errors[] = new ValidatorError('email','email cannot be empty');
        }

        if(trim($user['password'])){
            $this->password = $user['password'];
        }
        else{
            $errors[] = new ValidatorError('password','password cannot be empty');
        }

        return $errors;
    }

    public function forgot( array $user){
        $errors = [];
        if(trim($user['name'])){
            $this->name = $user['name'];
        }
        else{
            $errors[] = new ValidatorError('name','name cannot be empty');
        }

        if(trim($user['email'])){
            $this->email = $user['email'];
        }
        else{
            $errors[] = new ValidatorError('email','email cannot be empty');
        }

        return $errors;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }
}
?>