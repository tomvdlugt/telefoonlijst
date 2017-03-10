        <nav>
            <ul>
                <li>
                    <a href="?control=bezoeker&action=default">home</a>
                </li>
                <li>info school
                    <ul>
                        <li>
                            <a href="?control=bezoeker&action=directeur">directeur</a>
                        </li>
                        <?php foreach($afdelingen as $afdeling):?>
                        <li>
                            <a href="?control=bezoeker&action=afdeling&aid=<?= $afdeling->getId();?>">team <?= $afdeling->getAfkorting();?></a>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </li>
                <li>
                    <a href="?control=bezoeker&action=inloggen">inloggen</a>
                </li>
            </ul>
        </nav>

