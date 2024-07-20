<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';


$req = $db->query("SELECT payment_mode_id, image, name FROM payment_mode ");

$payment_modes = $req->fetchAll(PDO::FETCH_OBJ);


$agency_id = (int)$_GET['agency_id'];
$ticket_id = (int)$_GET['ticket_id'];

include './layouts/header.php';
include './layouts/navbar.php';
?>
<main class="d-flex align-items-center justify-content-center wh-100 vh-100">
    <section class="row">
        <div class="col-md-12">
            <h1 class="text-center display-1">Modes de paimement</h1>
            <p class="text-center">Choississez votre mode de paiment</p>
        </div>
        <div class="col-md-12 d-flex " style="padding: 0px 250px">
        <?php foreach ($payment_modes as $method): ?>
            <div class="card w-50 col-md-4 mx-2">
                <div class="card-details">
                    <img class="rounded-2" width="200" height="200" src=<?="assets/images/payment_mode/$method->image" ?> />
                </div>
                <a href="confirmation.php?ticket_id=<?= $ticket_id ?>&payment_mode_id=<?= $method->payment_mode_id ?>" class="card-button text-center text-decoration-none">Valider</a>
            </div>
        
        <?php endforeach; ?>

        
    </div>
    </section>
    
    
</main>

<?php 
include('./layouts/footer.php');
$db = null;
?>
