<?php 
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit;
    }
    
    require 'db.php';
    
    $req = $db->prepare("SELECT agency.agency_id, agency.name AS agency_name, agency.phone, agency.address, image_agency.name AS image_name FROM agency JOIN image_agency ON agency.image_agency_id = image_agency.image_agency_id");
    $req->execute();
    $res = $req->fetchAll(PDO::FETCH_OBJ);
    
    if($res){
       $agencies = $res;
    }
    

    include './layouts/header.php';
    include './layouts/navbar.php'
     ?>
    <main class="d-flex align-items-center justify-content-center w-full h-full">
        <section class="row">
            <div class="col-md-12">
                <h1 class="text-center h1 ">Liste des agences</h1>
                <p class=" text-center">Faites votre choix</p>
            </div>
            <div id="agences" class="col-sm-12 px-4">
                <?php foreach($agencies as $key => $agency): ?>
                    <div class="card w-100  my-2 shadow-md">
                        <div class="row">
                            <div class="col-sm-12  col-md-2 d-flex justify-content-center" >
                                <img width="150" height="150" src=<?="assets/images/agencies/$agency->image_name "?> alt="image_agency" />
                            </div>
                            <div class="card-body col-sm-12 col-md-6">
                                <h5 class="card-title text-center">
                                <?= $agency->agency_name ?>
                                </h5>
                                <p class="text-center">
                                    <span class="fw-semibold">Adresse :</span><?=  $agency->address?> | <span class="fw-semibold">Téléphone :</span><?=  $agency->phone?> 
                                </p>
                            </div>
                            <div class="card-body d-flex align-items-center justify-content-center col-sm-12 col-md-2">
                                <a href=<?="info-part-1.php?agency_id=$agency->agency_id" ?> class="btn btn-primary">Reservez-ici</a>
                            </div>

                        </div>
                        
                        
                    </div>

                <?php endforeach ?>
                
            </div>
        </section>
       
    </main>
<?php 
    include './layouts/footer.php'; 
    $db = null;
?>