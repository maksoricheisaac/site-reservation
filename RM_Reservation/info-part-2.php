<?php 
    session_start();

    if(!isset($_SESSION['user_id'])){
      header("Location: login.php");
      exit;
    }
    
    require 'db.php';
    $agency_id = (int)$_GET['agency_id'];
    $route_id = (int)$_GET['route_id'];

    $req = $db->prepare("SELECT route_id, CONCAT(departure_location, ' - ' ,arrival_location) AS destination, adult_price, child_price, days FROM route  WHERE agency_id = :agency_id AND route_id = :route_id ORDER BY destination ASC");
    $req->bindValue(':agency_id', $agency_id);
    $req->bindValue(':route_id', $route_id);
    $req->execute();
    $route = $req->fetch(PDO::FETCH_OBJ);

    $req = $db->prepare("SELECT agency.name, agency.phone, agency.address  FROM agency WHERE agency_id = :agency_id");
    $req->bindValue(':agency_id', $agency_id);
    $req->execute();
    $agency = $req->fetch(PDO::FETCH_OBJ);
    
    if(isset($_POST['submit'])){
        $error;
        $owner = $_POST['owner'];
        $route_id = $_POST['route_id'];
        $num_adult_seats = $_POST['num_adult_seats'];
        $num_child_seats = $_POST['num_child_seats'];

        if (empty($owner) || empty($route_id) || (empty($num_adult_seats) && empty($num_child_seats))) {
            $error = "Veuillez renseigner tous les champs";
        } else {
            $_SESSION['owner'] = $owner;
            $_SESSION['route_id'] = $route_id;
            $_SESSION['num_adult_seats'] = $num_adult_seats;
            $_SESSION['num_child_seats'] = $num_child_seats;
        
            header("Location: ticket.php?agency_id=$agency_id");
            exit;
        }
  
    }

    include './layouts/header.php';
    include './layouts/navbar.php';
?>

<main>
    <section class="row" style="padding: 0px 100px">
        <div class="col-md-12">
            <p class="d-flex align-items-center"> Nom de l'agence : <span class="fw-bold h1 ms-2"> <?= $agency->name ?> </span> </p>
            <p> Adresse : <span class="fw-bold"> <?= $agency->address ?> </span> </p>
            <p> Téléphone <span class="fw-bold"> <?= $agency->phone ?> </span> </p>
        </div>
        <div class="col-md-12 ">
            <div class="row">
                <p class="col-md-12 my-2 text-center display-6">Destination choisie</p>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Prix (Adulte)</th>
                            <th scope="col">Prix (Enfant)</th>
                            <th scope="col">Jours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td> # </td>
                        <td> <?= $route->destination ?> </td>
                        <td> <?= $route->adult_price ?> XAF</td>
                        <td> <?= $route->child_price ?> XAF</td>
                        <td> <?= $route->days ?></td>
                    </tbody>
                </table>
                <form method="POST" class="col-md-12 p-4 border rounded-3 bg-body-tertiary">
                    <?php if(!empty($error)): ?>
                        <div class="alert alert-danger"> <?= $error ?> </di>
                    <?php endif ?>
                    <div class="form-floating mb-3">
                        <input type="text" name="owner"  class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Propriétaire</label> 
                    </div>
                    <div class="mb-3">
                        <select class="form-select p-3" name="route_id" id="exampleSelect">
                            <option value=<?= $route->route_id ?>> <?= $route->destination ?> </option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-floating mb-3 col-6 ">
                            <input type="number" name="num_adult_seats" class="form-control" id="floatingPassword" placeholder="">
                            <label for="floatingNumber">Nombre de places (adulte)</label>
                        </div>
                        <div class="form-floating mb-3 col-6">
                        <input type="number" name="num_child_seats" class="form-control" id="floatingPassword" placeholder="">
                        <label for="floatingNumber">Nombre de places (enfant) </label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-danger">Effacer</button>
                        <button type="submit" name="submit" class="btn btn-primary"> Suivant </a>
                    </div>
                
                </form>
            </div>
            
           
        </div>
    </section>
</main>