<?php 
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

require('db.php');

$user_id = (int)$_SESSION['user_id'];

// Sélection des billets de l'utilisateur
$requete = $db->prepare("
    SELECT ticket.ticket_id, ticket.owner, ticket.status, CONCAT(route.departure_location, ' - ', route.arrival_location) AS route, ticket.total_price, payment_mode.name AS payment_mode 
    FROM ticket 
    INNER JOIN user ON ticket.user_id = user.user_id 
    INNER JOIN payment_mode ON payment_mode.payment_mode_id = ticket.payment_mode_id 
    INNER JOIN route ON route.route_id = ticket.route_id 
    WHERE user.user_id = :user_id;
");
$requete->bindValue(':user_id', $user_id);
$requete->execute();
$infos = $requete->fetchAll(PDO::FETCH_OBJ);

include('./layouts/header.php'); 
?>
<header class="navbar sticky-top bg-dark flex-md-nowrap p-3 shadow" data-bs-theme="dark">
  <div class="d-flex align-items-center justify-content-between w-100">
    <h2 class="text-white">Mon Compte</h2>
    <a href="disconnexion.php" class="btn btn-info d-block">Se déconnecter</a>
  </div>
</header>
<main class="w-screen h-100">
    <section class="px-5">
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="my-4">Liste des billets</h1>
            <a href="agencies.php" class="btn btn-info">Ajouter un billet</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Propriétaire</th>
                    <th scope="col">route</th>
                    <th scope="col">Total</th>
                    <th scope="col">Mode de paiement</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($infos as $info): ?>
                <tr>
                    <th scope="row"><?= $info->ticket_id ?></th>
                    <td><?= $info->owner ?></td>
                    <td><?= $info->route ?></td>
                    <td><?= $info->total_price ?></td>
                    <td><?= $info->payment_mode ?></td>
                    <td>
                        <?php if ($info->status !== 'cancelled'): ?>
                            <a href=<?="annulation.php?ticket_id=$info->ticket_id" ?> class="btn btn-danger">Annuler</a>
                        <?php else: ?>
                            <button type="button" class="btn btn-success" disabled>Annulé</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>
<?php 
include('./layouts/footer.php');
$db = null;
?>
