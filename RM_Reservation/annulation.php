<?php 
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit;
    }
    require('db.php');

    
    $req = $db->prepare("SELECT purchase_date FROM ticket WHERE ticket_id = :ticket_id");
    $req->bindValue(':ticket_id', (int)$_GET['ticket_id'], PDO::PARAM_INT);
    $req->execute();
    $ticket = $req->fetch(PDO::FETCH_ASSOC);

    if ($ticket) {
        $date_achat = new DateTime($ticket['purchase_date']);
        $currentDate = new DateTime();
        $intervalle = $currentDate->diff($date_achat);

        
        if ($intervalle->days <= 2) {
            
            $req = $db->prepare("UPDATE ticket SET status = 'cancelled' WHERE ticket_id = :ticket_id");
            $req->bindValue(':ticket_id', (int)$_GET['ticket_id'], PDO::PARAM_INT);
            $req->execute();

            header("Location: myAccount.php");
            exit;
        } else {
            echo "Le délai d'annulation de 2 jours est dépassé. Le ticket ne peut pas être annulé.";
        }
    } else {
        echo "ticket non trouvé.";
    }

