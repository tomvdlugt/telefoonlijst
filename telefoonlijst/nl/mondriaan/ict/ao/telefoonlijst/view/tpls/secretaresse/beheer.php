<?php 
include 'includes/header.php';
include 'includes/menu.php';?>
    <section id='content'>
        <table id="contacten">
            <caption>dit zijn alle werknemers van de school voor ict</caption>
            <thead>
                <tr>
                    <td>foto</td>
                    <td>naam</td>
                    <td>email</td>
                    <td>intern</td>
                    <td>extern</td>
                    <td>afd</td>
                    <td colspan="3">acties</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($contacten as $contact):?>
                <tr>
                    <td>
                        <figure>
                            <img src="img/personen/<?= $contact->getFoto();?>" alt="de foto van <?= $contact->getNaam();?>" />
                        </figure>
                    </td>
                    <td><?= $contact->getNaam();?></td>
                    <td><?= $contact->getEmail();?></td>
                    <td><?= $contact->getIntern();?></td>
                    <td><?= $contact->getExtern();?></td>
                    <td ><?= $contact->getAfdelings_afkorting()?></td>
                    <td title="reset het wachtwoord van dit contact naar qwerty"><a href='?control=secretaresse&action=resetww&id=<?= $contact->getId();?>'><img src="img/resetww.png"></a></td>
                    <td title="bewerk de contact gegevens van dit contact"><a href='?control=secretaresse&action=update&id=<?= $contact->getId();?>'><img src="img/bewerk.png"></a></td>
                    <td title="verwijder dit contact definitief"><a href='?control=secretaresse&action=delete&id=<?= $contact->getId();?>'><img src="img/verwijder.png"></a></td>
                </tr>
                <?php endforeach;?>
                <tr>
                    <td>
                        <a href='?control=secretaresse&action=add'>
                            <figure>
                                <img src="img/toevoegen.png" alt='voeg een contact toe image' title='voeg een contact toe' />
                            </figure>
                        </a>
                    </td>
                    <td colspan='8'>voeg een contact aan de school toe</td>
                </tr>
            </tbody>
        </table>
        <br id ="breaker" />
    </section>
<?php include 'includes/footer.php';