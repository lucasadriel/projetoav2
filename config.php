<?php
    session_start();
    
    try {
        $pdo = new PDO 
        ("mysql:host=localhost;dbname=id15542595_tcclucas", "id15542595_root", "0UoaRU(5Jqw0DI|&");
        
    } catch (PDOException $e) {
        echo "error" . $e->getMessage ();
        exit;
    }
?>