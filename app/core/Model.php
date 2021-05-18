<?php

declare(strict_types=1);

abstract class Model
{
    private const DRIVER = DATABASE['DRIVER'];
    private const HOST = DATABASE['HOST'];
    private const DBNAME = DATABASE['DBNAME'];
    private const USER = DATABASE['USER'];
    private const PASSWORD = DATABASE['PASSWORD'];
    /**
     * Stores the connection with the database made.
     * 
     * @var object
     */
    protected object $conn;

    /**
     * Make the connection with the database.
     */
    public function __construct()
    {
        $this->conn = new PDO(self::DRIVER . ':host=' . self::HOST . ';dbname=' . self::DBNAME, self::USER, self::PASSWORD);
    }
}
