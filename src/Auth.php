<?php
namespace App;

class Auth {

    public function check ()
    {
        if (isset($_GET['admin'])) {
            throw new \Exception('Accès interdit');
        }
        //TODO : Ecrire le code
    }





}