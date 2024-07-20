<?php 
    require 'db.php';
    include './layouts/header.php';
    include './layouts/navbar.php'
?>
    <main class=" flex items-center justify-center w-screen h-screen">
        
        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold text-body-emphasis">RM Reservation</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Bienvenu(e) sur notre site de reservation de billet</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="agencies.php" class="btn btn-primary">Voir les agences</a>
                </div>
            </div>
        </div>
       
    </main>
<?php include './layouts/footer.php'  ?>
