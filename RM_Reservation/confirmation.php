<?php
    session_start();

    if(!isset($_SESSION['user_id'])){
      header("Location: login.php");
      exit;
    }
    require('db.php');
    $ticket_id = (int)$_GET['ticket_id'];
    $payment_mode_id = (int)$_GET['payment_mode_id'];

 
    
try {
  
    $stmt = $db->prepare("SELECT COUNT(*) FROM payment_mode WHERE payment_mode_id = :payment_mode_id");
    $stmt->bindValue(':payment_mode_id', $payment_mode_id, PDO::PARAM_INT);
    $stmt->execute();
    $payment_mode_exists = $stmt->fetchColumn();

    if (!$payment_mode_exists) {
        throw new Exception("Le mode de paiement spécifié n'existe pas.");
    }

    $stmt = $db->prepare("UPDATE ticket SET payment_mode_id = :payment_mode_id, purchase_date = :purchase_date, status = 'valid' WHERE ticket_id = :ticket_id");
    $stmt->bindValue(':payment_mode_id', $payment_mode_id, PDO::PARAM_INT);
    $stmt->bindValue(':ticket_id', $ticket_id, PDO::PARAM_INT);
    $stmt->bindValue(':purchase_date', date('Y-m-d H:i:s'));
    $stmt->execute();

    header('Location: myAccount.php');
    exit;
} catch (PDOException $e) {
    // Gérer les erreurs PDO
    echo "Erreur PDO : " . $e->getMessage();
} catch (Exception $e) {
    // Gérer d'autres exceptions
    echo "Erreur : " . $e->getMessage();
}
