<?php 
namespace App;
use PDO;
function getConnection(): PDO{//retorna um objeto PDO 
    static $pdo; 
    if ($pdo === null){ // = (atribuição) / == (comparação) / == (comparação  tipo e valor)
        $pdo = new  PDO("mysql:host=10.91.47.99;dbname=zentralhead",
        "root",
        "123",
        //  $pdo = new  PDO("mysql:host=localhost;dbname=tdszuphpdb01",
        // "root",
        // "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );


    }
    return $pdo;
}



?>