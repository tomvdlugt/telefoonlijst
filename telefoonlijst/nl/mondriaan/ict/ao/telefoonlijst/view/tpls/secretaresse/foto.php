<?php 
include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
            <form method="post" id="foto_form" enctype="multipart/form-data">
               <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                <figure id="details">
                    <img src="img/personen/<?= $gebruiker->getFoto();?>" alt="mijn foto:  <?= $gebruiker->getNaam();?>" />
                    <figcaption>
                        de huidige foto van <?= $gebruiker->getNaam();?> 
                    </figcaption>  
                </figure>
                <div>
                    <input type="file" name="foto" accept="image/*" required />
                    <input type="submit" name="upload" value="load up" />
                </div>
            </form>
            <br id ="breaker" />
        </section>
<?php include 'includes/footer.php';