<?php$PageTitle = "Ny bokning";include ("../config-connect.php");include ("../top.php");$gruppbokn = "FALSE";$fornamn = "";$efternamn = "";$adress = "";$postnr = "";$postort = "";$telefon = "";$email = "";$avbskyddpris = 150;$anmavgpris = 300;if (isset($_GET["bokningid"])) {$sql = "SELECT * FROM Bokningar WHERE bokningid=" . intval($_GET["bokningid"]);$result = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));       if (sqlsrv_num_rows($result) > 0) {        $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC );$resaid = $row["resaid"];$gruppbokn = $row["gruppbokn"];$boendealt = $row["boendealt"];$boendealtkod = $row["boendealtkod"];$antalresande = $row["antalresande"];$avbskyddpris = $row["avbskyddpris"];$anmavgpris = $row["anmavgpris"];$betalningsdatum2 = $row["betalningsdatum2"]->format('Y-m-d');$betalningsdatum1 = $row["betalningsdatum1"]->format('Y-m-d');$persperrum = $row["persperrum"];$anmavg = $row["anmavg"];$resenar1 = $row["resenar1"];$resenar2 = $row["resenar2"];$resenar3 = $row["resenar3"];$resenar4 = $row["resenar4"];$resenar5 = $row["resenar5"];$resenar6 = $row["resenar6"];}$resenarid = array();$fornamn = array();$efternamn = array();$adress = array();$postnr = array();$postort = array();$telefon = array();$email = array();$onskemal = array();$prisjustering = array();$bekraftelse =  array();$avresa = array();$avresatid = array();$sql = "SELECT * FROM Resenarer WHERE bokningid=" . intval($_GET["bokningid"]);$result = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));       if (sqlsrv_num_rows($result) > 0) {        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC )) {array_push($resenarid, $row["resenarid"]);array_push($fornamn, $row["fornamn"]);array_push($efternamn, $row["efternamn"]);array_push($adress, $row["adress"]);array_push($postnr, $row["postnr"]);array_push($postort, $row["postort"]);array_push($telefon, $row["telefon"]);array_push($email, $row["email"]);array_push($onskemal, $row["onskemal"]);array_push($prisjustering, $row["prisjustering"]);array_push($bekraftelse, $row["bekraftelse"]);array_push($avresa, $row["avresa"]);array_push($avresatid, $row["avresatid"]->format('H:i'));}}}?>	<script language="javascript">  function goResa() {    id = document.getElementById('resaid').value;    window.location.assign("boka-ny.php?resaid=" + id);    }      function goAntal() {    id = document.getElementById('antal').value;    window.location.assign("boka-ny.php?resaid=<?php echo $_GET["resaid"]; ?>&antal=" + id);    }	</script><form action="printbokning.php" method="post" name="form"><table align="center">  <tr>    <td colspan=4 align="center"><h2>Ny bokning</h2></td></tr>    <tr><td colspan=4 align="center">    <a href="boka-manuell.php?anmavg=1"><input style="font-size:16px" type="button" value="Skapa manuell resebekräftelse med anmälningsavgift"></a>    <br><a href="boka-manuell.php?anmavg=0"><input style="font-size:16px" type="button" value="Skapa manuell resebekräftelse utan anmälningsavgift"></a>    <br><br><big>Normal systembokning:</big></td>      </tr>  <tr>    <td align="center" colspan=4><big><big>Välj resa</big></big>    <?php    if (!isset($_GET["resaid"])) {      echo "<select style='font-size:22px' name='resaid' id='resaid' onchange='goResa();'>";      echo "<option value='NONE' selected>--Välj resa först--</option>";      $sql = "SELECT resaid, resa, date FROM Resor WHERE aktiv=1 ORDER BY date ASC";      $result = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));                    if (sqlsrv_num_rows($result) > 0) {            // output data of each row          while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC )) {            echo "<option value='" . $row['resaid'] . "'>" . $row['resa'] . " " . $row["date"]->format('j/n') . "</option>";            }            }       echo "</select></td></tr></table></form></body></html>";      exit;     } else {      echo "<select style='font-size:22px' name='resaid' id='resaid' disabled>";      echo "<option value='NONE'>--Välj resa först--</option>";      $sql = "SELECT * FROM Resor WHERE aktiv=1 ORDER BY date ASC";      $result = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));                    if (sqlsrv_num_rows($result) > 0) {            // output data of each row          while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC )) {            if (intval($row['resaid'])==intval($_GET['resaid'])) {              $pris1=$row['pris1'];              $pris2=$row['pris2'];              $pris3=$row['pris3'];              $pris4=$row['pris4'];              $pris5=$row['pris5'];              $boendealt1=$row['boendealt1'];              $boendealt2=$row['boendealt2'];              $boendealt3=$row['boendealt3'];              $boendealt4=$row['boendealt4'];              $boendealt5=$row['boendealt5'];              $persperrum1=$row['persperrum1'];              $persperrum2=$row['persperrum2'];              $persperrum3=$row['persperrum3'];              $persperrum4=$row['persperrum4'];              $persperrum5=$row['persperrum5'];              $kategori=$row['kategori'];              $date=$row['date']->format('Y-m-d');              $resanamn=$row['resa'];              echo "<option value='" . $row['resaid'] . "' selected>" . $row['resa'] . " " . $row["date"]->format('j/n') . "</option>";            } else {              echo "<option value='" . $row['resaid'] . "'>" . $row['resa'] . " " . $row["date"]->format('j/n') . "</option>";            }}            }          echo "</select><input type='hidden' name='resaid' value='" . $_GET['resaid'] . "'>";       }              if (!isset($_GET["antal"]) OR ($_GET["antal"] > 6)) {      echo "</td></tr><tr><td align='center' colspan=4>Välj antal resande ";      echo "<select style='font-size:18px' name='antal' id='antal' onchange='goAntal();'>";      echo "<option value='NONE' selected>--Välj antal resande--</option>";      echo "<option value='1'>1</option>";      echo "<option value='2'>2</option>";      echo "<option value='3'>3</option>";      echo "<option value='4'>4</option>";      echo "<option value='5'>5</option>";      echo "<option value='6'>6</option>";      echo "</select></td></tr></table></form></body></html>";      exit;     } else {      echo "</td></tr><tr><td align='center' colspan=4>Välj antal resande ";      echo "<select style='font-size:18px' name='antal' id='antal' disabled>";      echo "<option value='NONE'>--Välj antal resande--</option>";                    for ($i=1;$i<7;$i++) {            if ($_GET["antal"] == $i) {              echo "<option value='" . $i . "' selected>" . $i . "</option>";            } else {              echo "<option value='" . $i . "'>" . $i . "</option>";            }                        }             echo "</select><input type='hidden' name='antal' value='" . $_GET['antal'] . "'>";       }$lastpayday = date("Y-m-d", strtotime("-1 month", strtotime($date)));    $anmavg_checked = "checked";    if (strtotime($date) < strtotime('+6 week')) {    $lastpayday = "";    $anmavg_checked = "";}if (isset($_GET["bokningid"])) {    echo "</td></tr><tr><td align='center' colspan=4><h2>Ändrar bokningsnr: ";    if ($gruppbokn=="TRUE")       echo "20";    else      echo "10";    echo intval($_GET["bokningid"]) . "</h2>";}?>  </td>  </tr>  <tr>  <td colspan=4>&nbsp;</td>  </tr>  <tr>  <td colspan=4>  <input type="radio" name="gruppbokn" value="TRUE" <?php if ($gruppbokn=="TRUE") echo "checked='checked'";?>> Gruppresa  <br><input type="radio" name="gruppbokn" value="FALSE" <?php if ($gruppbokn!="TRUE") echo "checked='checked'";?>> Individuell</td>    <input type="hidden" name="resadatum" value="<?php echo $date; ?>">  <input type="hidden" name="resanamn" value="<?php echo $resanamn; ?>">    <?php  if (isset($_GET["bokningid"]))    echo "<input type='hidden' name='bokningid' value='" . intval($_GET["bokningid"]) . "'>";  ?>  <tr><td colspan=4><br>  Fyll i de uppgifter som finns om varje resenär nedan.<br>Den <u>första</u> resenären per bekräftelse behöver adress.  <br><br>  Avresetid och plats kopieras från resenär 1 om det lämnas tomt.<br>Fyll i på resenär 1 och därefter endast avvikelser.  <?phpecho "<table><tr>";    for ($i=0;$i<$_GET["antal"];$i++) {      echo "<td colspan=2 style='padding-right:50px;padding-top:30px;'><h3 style='padding:0px;margin:0px'>Resenär " . ($i+1) . "</h3>på bekräftelse <select name='bekraftelse[]'>";      echo "<option value='1' ";      if (!isset($_GET["bokningid"]) OR $bekraftelse[$i] == 1)        echo "selected";      echo ">1</option>";      echo "<option value='2' ";      if ($bekraftelse[$i] == 2)        echo "selected";      echo ">2</option>";      echo "<option value='3' ";      if ($bekraftelse[$i] == 3)        echo "selected";            echo ">3</option>";      echo "<option value='4' ";      if ($bekraftelse[$i] == 4)        echo "selected";            echo ">4</option>";      echo "<option value='5' ";      if ($bekraftelse[$i] == 5)        echo "selected";            echo ">5</option>";      echo "<option value='6' ";      if ($bekraftelse[$i] == 6)        echo "selected";            echo " >6</option>";      echo "</select>";      echo "<br><br>";      echo "<input type='hidden' value='" . $resenarid[$i] . "' maxlength=50 name='resenarid[]' size=15>";       echo "<input type='text' value='" . $fornamn[$i] . "' placeholder='Förnamn' maxlength=50 name='fornamn[]' size=15>";       echo "<input type='text' value='" . $efternamn[$i] . "' placeholder='Efternamn' maxlength=50 name='efternamn[]' size=25>";      echo "<br>";      echo "<input type='text' value='" . $adress[$i] . "' placeholder='Gatuadress' maxlength=40 name='adress[]' size=45>";      echo "<br>";      echo "<input type='text' value='" . $postnr[$i] . "' placeholder='Postnr' maxlength=6 name='postnr[]' size=4>";      echo "<input type='text' value='" . $postort[$i] . "' placeholder='Postadress' maxlength=50 name='postort[]' size=36>";      echo "<br><br>";      echo "<input type='text' value='" . $telefon[$i] . "' placeholder='Telefon' maxlength=50 name='telefon[]' size=45><br>";      echo "<input type='text' value='" . $email[$i] . "' placeholder='e-Mail' maxlength=50 name='email[]' size=45>";      echo "<br><br>";      echo "<input type='text' value='" . $prisjustering[$i] . "' placeholder='Prisjustering (-500 minskar/500 ökar) för rabatter och dyl.' maxlength=50 name='prisjustering[]' size=45>";      echo "<br><br>";      echo "<textarea rows=3 cols=47 placeholder='Önskemål' maxlength=280 name='onskemal[]'>" . $onskemal[$i] . "</textarea>";      echo "<br><br>";      echo "<input type='text' value='" . $avresa[$i] . "' placeholder='Avreseplats";      if ($i == 0 )        echo " (används som standard)";      else        echo " (fylls i om avvikande)";               echo "' maxlength=50 id='avresa' name='avresa[]' size=30> kl<input type='time' value='" . $avresatid[$i] . "' id='avresatid' name='avresatid[]' size=1>";      echo "</td>";      if ( $i % 2 != 0 )         echo "</tr><tr>";    }    ?>      </td><tr><td colspan=4>&nbsp;</td></tr><tr><td colspan=4>    <table>    <tr><td>    <?php    if (!isset($_GET["bokningid"])) {        if ($boendealt2 != "") {      echo "<tr><td><input type='radio' name='boendealtkod' value='2'";      if ($_GET["antal"]>1)        echo "checked='checked'";      echo " />" . $boendealt2 . "</td><td>" . $pris2 . "kr.";      echo " (" . (ceil(intval($_GET["antal"])/$persperrum2)) . " rum kommer bokas)";      echo "<input type='hidden' name='boendealt2' value='" . $boendealt2 . "'>";      echo "<input type='hidden' name='persperrum2' value='" . $persperrum2 . "'>";      echo "<input type='hidden' name='pris2' value='" . $pris2 . "'></td></tr>";      }            if ($boendealt1 != "") {      echo "<tr><td><input type='radio' name='boendealtkod' value='1'";      if ($_GET["antal"]<=1)        echo "checked='checked'";      echo " />" . $boendealt1 . "</td><td>" . $pris1 . "kr.";      echo " (" . (ceil(intval($_GET["antal"])/$persperrum1)) . " rum kommer bokas)";      echo "<input type='hidden' name='boendealt1' value='" . $boendealt1 . "'>";            echo "<input type='hidden' name='persperrum1' value='" . $persperrum1 . "'>";      echo "<input type='hidden' name='pris1' value='" . $pris1 . "'></td></tr>";      }            if ($boendealt3 != "") {      echo "<tr><td><input type='radio' name='boendealtkod' value='3'";      echo " />" . $boendealt3 . "</td><td>" . $pris3 . "kr.";      echo " (" . (ceil(intval($_GET["antal"])/$persperrum3)) . " rum kommer bokas)";      echo "<input type='hidden' name='boendealt3' value='" . $boendealt3 . "'>";            echo "<input type='hidden' name='persperrum3' value='" . $persperrum3 . "'>";      echo "<input type='hidden' name='pris3' value='" . $pris3 . "'></td></tr>";      }            if ($boendealt4 != "") {      echo "<tr><td><input type='radio' name='boendealtkod' value='4'";      echo " />" . $boendealt4 . "</td><td>" . $pris4 . "kr.";      echo " (" . (ceil(intval($_GET["antal"])/$persperrum4)) . " rum kommer bokas)";      echo "<input type='hidden' name='boendealt4' value='" . $boendealt4 . "'>";      echo "<input type='hidden' name='persperrum4' value='" . $persperrum4 . "'>";      echo "<input type='hidden' name='pris4' value='" . $pris4 . "'></td></tr>";      }            if ($boendealt5 != "") {      echo "<tr><td><input type='radio' name='boendealtkod' value='5'";      echo " />" . $boendealt5 . "</td><td>" . $pris5 . "kr.";      echo " (" . (ceil(intval($_GET["antal"])/$persperrum5)) . " rum kommer bokas)";      echo "<input type='hidden' name='boendealt5' value='" . $boendealt5 . "'>";      echo "<input type='hidden' name='persperrum5' value='" . $persperrum5 . "'>";      echo "<input type='hidden' name='pris5' value='" . $pris5 . "'></td></tr>";      }              } else {               if ($boendealt2 != "") {      echo "<tr><td><input type='radio' name='boendealtkod' value='2'";        if ($boendealtkod == 2)           echo "checked='checked'";      echo " />" . $boendealt2 . "</td><td>" . $pris2 . "kr.";      echo " (" . (ceil(intval($_GET["antal"])/$persperrum2)) . " rum kommer bokas)";      echo "<input type='hidden' name='boendealt2' value='" . $boendealt2 . "'>";      echo "<input type='hidden' name='persperrum2' value='" . $persperrum2 . "'>";      echo "<input type='hidden' name='pris2' value='" . $pris2 . "'></td></tr>";      }            if ($boendealt1 != "") {      echo "<tr><td><input type='radio' name='boendealtkod' value='1'";        if ($boendealtkod == 1)           echo "checked='checked'";      echo " />" . $boendealt1 . "</td><td>" . $pris1 . "kr.";      echo " (" . (ceil(intval($_GET["antal"])/$persperrum1)) . " rum kommer bokas)";      echo "<input type='hidden' name='boendealt1' value='" . $boendealt1 . "'>";      echo "<input type='hidden' name='persperrum1' value='" . $persperrum1 . "'>";      echo "<input type='hidden' name='pris1' value='" . $pris1 . "'></td></tr>";      }            if ($boendealt3 != "") {      echo "<tr><td><input type='radio' name='boendealtkod' value='3'";        if ($boendealtkod == 3)           echo "checked='checked'";      echo " />" . $boendealt3 . "</td><td>" . $pris3 . "kr.";      echo " (" . (ceil(intval($_GET["antal"])/$persperrum3)) . " rum kommer bokas)";      echo "<input type='hidden' name='boendealt3' value='" . $boendealt3 . "'>";      echo "<input type='hidden' name='persperrum3' value='" . $persperrum3 . "'>";      echo "<input type='hidden' name='pris3' value='" . $pris3 . "'></td></tr>";      }            if ($boendealt4 != "") {      echo "<tr><td><input type='radio' name='boendealtkod' value='4'";        if ($boendealtkod == 4)           echo "checked='checked'";      echo " />" . $boendealt4 . "</td><td>" . $pris4 . "kr.";      echo " (" . (ceil(intval($_GET["antal"])/$persperrum4)) . " rum kommer bokas)";      echo "<input type='hidden' name='boendealt4' value='" . $boendealt4 . "'>";      echo "<input type='hidden' name='persperrum4' value='" . $persperrum4 . "'>";      echo "<tr><td><input type='hidden' name='pris4' value='" . $pris4 . "'></td></tr>";      }            if ($boendealt5 != "") {      echo "<tr><td><input type='radio' name='boendealtkod' value='5'";        if ($boendealtkod == 5)           echo "checked='checked'";      echo " />" . $boendealt5 . "</td><td>" . $pris5 . "kr.";      echo " (" . (ceil(intval($_GET["antal"])/$persperrum5)) . " rum kommer bokas)";      echo "<input type='hidden' name='boendealt5' value='" . $boendealt5 . "'>";      echo "<input type='hidden' name='persperrum5' value='" . $persperrum5 . "'>";      echo "<input type='hidden' name='pris5' value='" . $pris5 . "'></td></tr>";      }      }             ?>    </td></tr></table>   </td>   </tr>   <tr>    <td colspan=4>&nbsp;</td>   </tr>    <tr>   <td colspan=4>   Avbeställningsskydd <input type="text" value="<?php echo $avbskyddpris; ?>" maxlength=5 id="avbskyddpris" name="avbskyddpris" size=2>kr   </td>   </tr><tr>   <td colspan=4>   Anmälningsavgift <input type="text" value="<?php echo $anmavgpris; ?>" maxlength=5 id="anmavgpris" name="anmavgpris" size=2>kr   </td>   </tr>   <tr>    <td colspan=4>&nbsp;</td>   </tr>   <tr>    <td colspan=4>    <?php    if (isset($_GET["bokningid"]))    $lastpayday = $betalningsdatum2;    ?>   Sista betalningsdatum <input type="date" value="<?php echo $lastpayday; ?>" id="betalningsdatum2" name="betalningsdatum2">    </td>   </tr>   <tr>    <td colspan=4>    <?php    if (isset($_GET["bokningid"])) {      if ($anmavg==0)      $anmavg_checked = "";      elseif ($anmavg==1)      $anmavg_checked = "checked";      }    ?>   Använd anmälningsavgift <input type="checkbox" name="anmavg" value="TRUE" <?php echo $anmavg_checked; ?>>   </td>   </tr>   <tr>    <td colspan=4>    &nbsp;    </td>   </tr>   <tr>    <td colspan=4>    <input type="hidden" name="count" value="0">    <input type="submit" name="save" value="Spara och utskriftsformat" style="font-size:18px">    </td>   </tr></table></form></body></html><?phpsqlsrv_close();?>