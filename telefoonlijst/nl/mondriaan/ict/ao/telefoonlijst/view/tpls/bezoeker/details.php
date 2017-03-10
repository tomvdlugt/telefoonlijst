<?php   
include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
            <figure id="details">
                <div>
                    <table id="details_table">
                        <caption>
                            Detail gegevens van  <?= $contact->getNaam();?>
                        </caption>
                        <tr>
                            <td >intern</td><td><?= $contact->getIntern();?></td>
                        </tr>
                        <tr>
                            <td >extern</td><td><?= $contact->getExtern();?></td>
                        </tr>
                        <tr>
                            <th >email</th><td><a href="mailto:<?= $contact->getEmail();?>" title="klik om te mailen"><?= $contact->getEmail();?></a></td>
                        </tr>
                    </table>
                </div>
                <img src="img/personen/<?= $contact->getFoto();?>" alt="mijn foto:  <?= $contact->getNaam();?>" />
                <figcaption>
                    de huidige foto van <?= $contact->getNaam();?> 
                </figcaption>
            </figure>
        <br id ="breaker" />
        </section>
<?php include 'includes/footer.php';