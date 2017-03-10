<?php 
include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
            <fieldset>
                <legend>
                    slechts voor medewerkers van de school voor ict
                </legend>
                <form  method="post" autocomplete="off">
                    <h1>Inloggen</h1>
                    <table>    
                        <tr>
                            <td>Gebuikersnaam:</td>
                            <td>
                                <input type="text" autocomplete="off" placeholder="vul uw gebuikersnaam in" name="gn" value='<?= isset($gn)?$gn:"";?>' required="required" />
                            </td>
                        </tr>
                        <tr >
                           <td>Wachtwoord:</td>
                           <td>
                                <input type="password" autocomplete="off" name="ww" placeholder="vul uw wachtwoord in" required="required" />
                           </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="inloggen"><input type="reset" value="reset" />
                            </td>
                        </tr>
                    </table>
                </form>
           </fieldset>
        </section>
<?php include 'includes/footer.php';