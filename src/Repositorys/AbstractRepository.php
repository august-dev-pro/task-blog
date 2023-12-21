<?php

namespace August\Repositorys;

use August\Helpers\Connexion;

class AbstractRepository
{
    protected $connection;

    public function __construct()
    {
        $dbConnection = new Connexion;

        $this->connection = $dbConnection->getConnection();
    }
}
