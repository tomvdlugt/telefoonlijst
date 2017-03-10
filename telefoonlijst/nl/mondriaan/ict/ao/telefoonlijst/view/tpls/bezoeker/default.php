<?php include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
            <figure>
                <img src="img/locatie.png" alt="ons schoolgebouw" />
                <figcaption>
                    <table>
                        <th colspan="2">onze gegevens</th>
                        <tr><td>school:</td><td>ROC Mondriaan school voor ICT</td></tr>
                        <tr><td>straat:</td><td>tinwerf 10</td></tr>
                        <tr><td>postcode:</td><td>2544 ED</td></tr>
                        <tr><td>plaats:</td><td>Den Haag</td></tr>
                        <tr><td>postcode:</td><td>2544 ED</td></tr>
                        <tr><td>telefoon:</td><td>088 6663600</td></tr>
                    </table>
                </figcaption>
            </figure>
            <div>
                <?php foreach($afdelingen as $afdeling):?>
                    <a href="?control=bezoeker&action=afdeling&aid=<?= $afdeling->getId();?>" title="klik hier voor extra informatie over het team <?= $afdeling->getAfkorting();?>">
                        <figure>
                            <img src="img/<?= $afdeling->getFoto();?>" alt="onze afdeling <?= $afdeling->getAfkorting();?>" />
                            <figcaption>
                                het team <?= $afdeling->getNaam();?> 
                            </figcaption>
                        </figure>
                    </a>
                <?php endforeach;?>
            </div>
            <br id ="breaker" />
        </section>
<?php include 'includes/footer.php';
