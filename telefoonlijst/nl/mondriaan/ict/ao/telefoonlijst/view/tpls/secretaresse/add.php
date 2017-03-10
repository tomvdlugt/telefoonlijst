<?php 
include 'includes/header.php';
include 'includes/menu.php';?>
        <section id='content'>
            <form  method="post" enctype="multipart/form-data" id="gebruiker_form"> 
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                <table>
                    <caption>toevoegen van een nieuwe medewerker</caption>
                    <tr>
                        <td>Gebuikersnaam:</td>
                        <td>
                            <input type="text" placeholder="kies verplicht een gebuikersnaam" name="gn" required="required" value="<?= !empty($form_data['gn'])?$form_data['gn']:'';?>">
                        </td>
                    </tr>
                    <tr >
                        <td>Wachtwoord:</td>
                        <td>
                            <input type="text" name="ww" placeholder='kies eventueel een ww default "qwerty"' value="<?= !empty($form_data['ww'])?$form_data['ww']:'';?>" >
                        </td>
                    </tr>
                    <tr>
                        <td>Voorletter</td>
                        <td>
                            <input type="text" name="vl" placeholder="vul verplicht de voorletter in" required="required" value="<?= !empty($form_data['vl'])?$form_data['vl']:'';?>" >
                        </td>
                    </tr>
                    <tr>
                        <td>tussenvoegsel:</td>
                        <td><input type="text" name="tv" placeholder="vul eventueel tussenvoegsels in" value="<?= !empty($form_data['tv'])?$form_data['tv']:'';?>" >
                        </td>
                    </tr>
                    <tr>
                        <td>Achternaam:</td>
                        <td><input type="text" name="an" placeholder="vul verplicht de achternaam in" required="required" value="<?= !empty($form_data['an'])?$form_data['an']:'';?>"> 
                        </td>
                    </tr>
                    <tr>
                        <td>afdeling:</td>
                        <td>
                            <select name='afd' required>
                                <option value="">kies</option>
                                <?php foreach ($afdelingen as $afdeling):?>
                                <option value="<?=$afdeling->getId();?>"  <?=(isset($form_data['afd'])&&$form_data['afd']==$afdeling->getId())?'selected="selected"':'';?> ><?=$afdeling->getAfkorting();?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>email:</td>
                        <td>
                            <input type="email" name="email" placeholder="geef verplicht een email op" required="required" value="<?= !empty($form_data['email'])?$form_data['email']:'';?>">
                        </td>
                    </tr>
                    <tr>
                        <td>foto (optioneel):</td>
                        <td>
                            <input type="file" name="foto"  accept='image/*' />
                        </td>
                    </tr>
                    <tr>
                        <td>intern:</td>
                        <td>
                            <input type="text" name="int" placeholder="vul eventueel een intern nummer in" value="<?= !empty($form_data['int'])?$form_data['int']:'';?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>extern:</td>
                        <td>
                            <input type="text" name="ext" placeholder="vul eventueel een extern nummer in" value="<?= !empty($form_data['ext'])?$form_data['ext']:'';?>" />
                        </td>
                    </tr>
                </table>
                <div>
                    <input type="submit" value="voeg toe">
                    <input type="reset" value="reset"> 
                </div>        
            </form> 
            <br id ="breaker">
        </section>
<?php include 'includes/footer.php';

