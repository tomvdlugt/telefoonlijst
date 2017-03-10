<?php 
include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
            <table id="contacten">
                <thead>
                    <caption>
                        dit zijn alle werknemers van de school voor ict
                    </caption>
                    <tr>
                        <td>foto</td>
                        <td>naam</td>
                        <td>email</td>
                        <td>intern</td>
                        <td>extern</td>
                        <td>afd</td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($contacten as $contact):?>
                    <tr>
                        <td>
                            <figure>
                                <img src="img/personen/<?= $contact->getFoto();?>" alt="de foto van <?= $contact->getNaam();?>">
                            </figure>
                        </td>
                        <td><?= $contact->getNaam();?></td>
                        <td>
                            <a href="mailto: <?= $contact->getEmail();?>"><?= $contact->getEmail();?></a>
                        </td>
                        <td><?= $contact->getIntern();?></td>
                        <td><?= $contact->getExtern();?></td>
                        <td title ="<?= $contact->getAfdelings_naam();?>"> <?=$contact->getAfdelings_afkorting()?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <br id ="breaker">
        </section>
<?php include 'includes/footer.php';