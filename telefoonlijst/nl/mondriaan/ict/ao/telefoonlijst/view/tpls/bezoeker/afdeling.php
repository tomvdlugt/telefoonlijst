<?php   
include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
            <figure id="team">
                <div><?=$team->getOmschrijving();?></div>
                <img src="img/<?= $team->getFoto();?>" alt="onze afdeling <?= $team->getAfkorting();?>" />
                <figcaption>
                    het team <?= $team->getNaam();?> 
                </figcaption>
            </figure>
            <table>
                <caption>
                    Contacten binnen team <?= $team->getNaam();?>
                </caption>
                <thead>
                    <tr>
                        <th >nummer</th>
                        <th >naam</th>
                        <th >intern</th>
                        <th >extern</th>
                        <th >email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($contacten as $teller=>$contact):?>
                    <tr>
                        <td><?= $teller+1; ?></td>
                        <td>
                            <a href="?control=bezoeker&action=details&id=<?= $contact->getId()?>"><?= $contact->getNaam();?>
                            </a>
                        </td> 
                        <td><?= $contact->getIntern();?></td>
                        <td><?= $contact->getExtern();?></td>
                        <td>
                            <a href="mailto:<?= $contact->getEmail();?>" title="klik om te mailen"><?= $contact->getEmail();?>
                            </a>
                        </td>
                    </tr>
                    <?php  endforeach;?>
                </tbody>
            </table>
        </section>
<?php include 'includes/footer.php';