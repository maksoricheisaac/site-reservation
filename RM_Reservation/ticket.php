<?php 
    session_start();

    if(!isset($_SESSION['user_id'])){
      header("Location: login.php");
      exit;
    }
    require('db.php');
    $user_id = (int)$_SESSION['user_id'];
    $agency_id = (int)$_GET['agency_id'];
    $route_id = (int)$_SESSION['route_id'];
    $owner = $_SESSION['owner'];
    $num_adult_seats = (int)$_SESSION['num_adult_seats'] ;
    $num_child_seats = (int)$_SESSION['num_child_seats'] ;
    
    $req = $db->prepare("SELECT 
                          agency.name AS agency_name, 
                          agency.phone, 
                          agency.address, 
                          route.departure_location, 
                          route.arrival_location, 
                          route.adult_price,
                          route.child_price,
                          route.days
                        FROM agency, route 
                        WHERE route.agency_id = agency.agency_id 
                        AND agency.agency_id = :agency_id 
                        AND route.route_id = :route_id;");
    $req->bindValue(':agency_id', $agency_id);
    $req->bindValue(':route_id', $route_id);
    $req->execute();
    $info = $req->fetch(PDO::FETCH_OBJ);
    $total_adult = $num_adult_seats * $info->adult_price;
    $total_child = $num_child_seats * $info->child_price;
    $total_price = $total_adult + $total_child;

    $req = $db->prepare("SELECT agency.name, agency.phone, agency.address  FROM agency WHERE agency_id = :agency_id");
    $req->bindValue(':agency_id', $agency_id);
    $req->execute();
    $agency = $req->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['submit'])){
        $req = $db->prepare("INSERT INTO ticket (route_id, user_id, owner, num_adult_seats, num_child_seats, total_price) VALUES(:route_id, :user_id, :owner, :num_adult_seats, :num_child_seats, :total_price)");
        $req->bindValue(':route_id', $route_id);
        $req->bindValue(':user_id', $user_id);
        $req->bindValue(':owner', $owner);
        $req->bindValue(':num_adult_seats', $num_adult_seats);
        $req->bindValue(':num_child_seats', $num_child_seats);
        $req->bindValue(':total_price', $total_price);
        $req->execute();
        $ticket_id = $db->lastInsertId();

        header("Location: payment.php?agency_id=$agency_id&ticket_id=$ticket_id");
    }

    include'./layouts/header.php';
    include'./layouts/navbar.php';
?>

<main class="d-flex align-items-center justify-content-center  wh-100 vh-100 m-auto mt-5">
    <section class="row">
        <div class="col-md-12" style="padding: 0px 200px">
            <p class="d-flex align-items-center"> Nom de l'agence : <span class="fw-bold h1 ms-2"> <?= $agency->name ?> </span> </p>
            <p> Adresse : <span class="fw-bold"> <?= $agency->address ?> </span> </p>
            <p> Téléphone <span class="fw-bold"> <?= $agency->phone ?> </span> </p>
        </div>
        <p class="col-md-12 text-center display-6">Votre billet</p>
        <div class="col-md-12" style="padding: 0px 200px">
                <div class="card w-100">
                <div class="card-header"></div>
                <div class="card-body">
                <div class="card-title text-center">
                    <h5> <?= $info->agency_name ?> </h5>
                    <p class="fw-bold"> <?= $info->address?> | Tél: <?=  $info->phone  ?> </p>
                </div>
                <form action="" method="POST">
                    <div class="card-text">
                        <p>M./Mdme : <span class="fw-semibold"> <?= $owner ?> </span></p>
                       <div class="d-flex align-items-center justify-content-between">
                        <p>Lieu de départ : <span class="fw-semibold me-5"> <?= $info->departure_location ?></span> </p>
                        <p>Lieu d'arrivée : <span class="fw-semibold me-5"> <?= $info->arrival_location ?> </span> </p>
                       </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <p>Nombre de places (adulte) : <span class="fw-semibold me-5"> <?= $num_adult_seats ?>  </span></p>
                            <p>Nombre de places (enfant) : <span class="fw-semibold me-5"> <?= $num_child_seats ?>  </span></p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <p>Prix (adulte) : <span class="fw-semibold me-5"> <?= $info->adult_price ?> XAF </span></p>
                            <p>Prix (enfant) : <span class="fw-semibold me-5"> <?= $info->child_price ?> XAF </span></p>
                        </div>
                        <p>Prix total : <span class="fw-semibold me-5"> <?= $total_price ?> XAF</span> </p>
                    </div>

                    <div class="d-flex align-items-center justify-content-between my-1">
                        <a href="index.php" class="btn btn-danger">Annuler</a>
                        <a href=<?="info-part-1.php?agency_id=$agency_id" ?> class="btn btn-warning">Modifier</a>
                        <button type="submit" name="submit" class="btn btn-primary">Continuer</p>
                    </div>
                </form>
                <div class="card-footer text-body-secondary"></div>
            </div>
        </div>
    </section>
</main>

<?php 
    include('./layouts/footer.php');
    $db = null;
?>
