<?php 
include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
                <form  method="post" id="gebruiker_form">
                    <table >
                        <caption>
                            wijzig hier je wachtwoord,  <?= $gebruiker->getNaam();?>
                        </caption>
                        <tr>
                            <td >nieuw wachtwoord (1x)</td>
                            <td>
                                <input type="password" name="nww1" required />
                            </td>
                        </tr>
                        <tr>
                            <td >nieuw wachtwoord (2x)</td>
                            <td>
                                <input type="password" name="nww2" required /> 
                            </td>
                        </tr>
                        <tr>
                            <td >bevestig met oud ww</td>
                            <td>
                                <input type="password" name="ww" required />
                            </td>
                        </tr>
                    </table>
                    <div>
                        <input type="submit" value="verstuur" />
                        <input type="reset" value ="reset" />
                    </div>
                </form>
            <br id ="breaker">
        </section>
<?php include 'includes/footer.php';