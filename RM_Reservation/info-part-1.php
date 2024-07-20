<?php 
  session_start();

  if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
  }
  require 'db.php';
  $agency_id = (int)$_GET['agency_id'];
  $req = $db->prepare("SELECT route_id, CONCAT(departure_location, ' - ' ,arrival_location) AS destination, adult_price, child_price, days FROM route  WHERE agency_id = :agency_id ORDER BY destination ASC");
  $req->bindValue(':agency_id', $agency_id);
  $req->execute();
  $routes = $req->fetchAll(PDO::FETCH_OBJ);

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

  <main class="d-grid  wh-100 vh-100 m-auto">
    <section class="row">
      <div class="col-md-12" style="padding: 0px 100px">
        <p class="d-flex align-items-center"> Nom de l'agence : <span class="fw-bold h1 ms-2"> <?= $agency->name ?> </span> </p>
        <p> Adresse : <span class="fw-bold"> <?= $agency->address ?> </span> </p>
        <p> Téléphone <span class="fw-bold"> <?= $agency->phone ?> </span> </p>
      </div>
      <div class="col-md-12 " style="padding: 0px 100px">
        <p class="text-center display-6">Voici la liste de toutes destinations</p>
        <table class="table table-striped table-bordered" >
          <thead>
            <tr>
              <th scope="col">Destination</th>
              <th scope="col">Prix (Adulte)</th>
              <th scope="col">Prix (Enfant)</th>
              <th scope="col">Jours</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($routes as $route) :?>
              <tr>
                <td> <?= $route->destination ?> </td>
                <td> <?= $route->adult_price ?> XAF</td>
                <td> <?= $route->child_price ?> XAF</td>
                <td> <?= $route->days ?></td>
                <td> <a class="btn btn-primary" href=<?="info-part-2.php?agency_id=$agency_id&route_id=$route->route_id" ?> > Choisir </a> </td>
              </tr>
            <?php endforeach ?>
              
          </tbody>
        </table>
      </div>
      
    </section>
    
  
  </main>
<?php  require'./layouts/footer.php';
  $db = null;
?>