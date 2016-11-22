<?php$PageTitle = "Kundregister";include ("../config-connect.php");include ("../top.php");?><table>	   <tr>	   	   <td align='center' colspan=3><h2>Kundregister</h2></td>	   </tr>	   <tr>		   <td colspan=3>		   <h3>Utskickslistor för fysiska adresser:</h3>		   <small><small>Ctrl + klick för att välja flera val</small></small><br><br>		   		   <form action="utskickslista.php" method="post" name="form"><big>		   <?php		   		   echo "Lista från kategorier:<br><select multiple id='kategori' name='kategori[]' style='font-size:12px;' size=7><option value='0ALLA0' selected>alla kategorier</option>";		   		   $sql = "SELECT kategori FROM Kategorier WHERE aktiv=1 ORDER BY kategori ASC";        $result = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));                if (sqlsrv_num_rows($result) > 0) {                while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC )) {                  echo "<option value='" . $row['kategori'] . "'>" . $row['kategori'] . "</option>";        }                }		   echo "</select><br>senaste ";		   echo "<select id='years' name='years' style='font-size:18px;'><option value='1'>1</option>";		   echo "<option value='2'>2</option>";		   echo "<option value='3' selected>3</option>";		   echo "<option value='4'>4</option>";		   echo "<option value='5'>5</option>";		   echo "<option value='6'>6</option>";		   echo "<option value='7'>7</option>";		   echo "<option value='8'>8</option>";		   echo "<option value='9'>9</option>";		   echo "<option value='10'>10</option>";		   		   echo "</select> åren.<br>";		   echo "<select id='program' name='program' style='font-size:18px;'><option value='JA' selected style='font-size:18px;'>Inkludera</option><option value='NEJ'>Exkludera</option></select> programbeställningar. ";		   		   echo "<br>Format: <select id='format' name='format' style='font-size:18px;'><option value='tabell' selected>Tabell (för dubletthantering)</option>";		   echo "<option value='staples24'>Staples etiketter 24 (70x37)</option>";		   echo "</select>. ";		   echo "<br>Dublettkontroll: <select id='levenstein' name='levenstein' style='font-size:18px;'><option value='2'>Normal</option>";		   echo "<option value='0' selected>Hård</option>";		   echo "<option value='4'>Mjuk</option>";		   echo "</select>.<br><small><small>Normal: 2-tecken fel i namn+adress = dublett. Hård: absolut match namn+adress = dublett. Mjuk: 4-tecken fel i namn+adress = dublett";       echo "<br><input type='submit' value='Skapa lista' style='font-size:18px;'>";		   		   		 ?>		 </big></form>		 </td>	   </tr>	   <tr><td>&nbsp;</td></tr>	   <tr>	   <td colspan=3>		   <form action="utskickslista-resa.php" method="post" name="form"><big>		   <?php		   echo "Lista från resor:<br><select multiple size=7 id='resa' name='resa[]' style='font-size:12px;'>";		   $datelimit = date('Y-m-d', strtotime("-3 year", time()));		   $sql = "SELECT resaid, resa, date FROM Resor WHERE date > CONVERT(date, '" . $datelimit . "', 126) ORDER BY date DESC";        $result = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));                if (sqlsrv_num_rows($result) > 0) {                while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC )) {                  echo "<option value='" . $row['resaid'] . "'>" . $row['resa'] . " " . $row['date']->format('j/n-y') . "</option>";        }                }		   echo "</select>. ";       echo "<br>Format: <select id='format' name='format' style='font-size:18px;'><option value='tabell' selected>Tabell (för dubletthantering)</option>";		   echo "<option value='staples24'>Staples etiketter 24 (70x37)</option>";		   echo "</select>";		   echo "<br>Dublettkontroll: <select id='levenstein' name='levenstein' style='font-size:18px;'><option value='2'>Normal</option>";		   echo "<option value='0' selected>Hård</option>";		   echo "<option value='4'>Mjuk</option>";		   echo "</select>.<br><small><small>Normal: 2-tecken fel i namn+adress = dublett. Hård: absolut match namn+adress = dublett. Mjuk: 4-tecken fel i namn+adress = dublett";       echo "<br><input type='submit' value='Skapa lista' style='font-size:18px;'>";		   		   		 ?>		 </big></form>		 </td>		 </tr>		 <tr><td>&nbsp;</td></tr>	   <tr>	   <td colspan=3>	   <h3>Utskickslistor för e-mail:</h3>	   <small><small>Ctrl + klick för att välja flera val</small></small><br><br>		   <form action="emaillista.php" method="post" name="form"><big>		   <?php		   echo "<input type='submit' value='Skapa lista' style='font-size:18px;'>";		   echo " för <select multiple id='kategori' name='kategori[]' style='font-size:12px;' size=5><option value='0ALLA0' selected>alla kategorier</option>";		   		   $sql = "SELECT kategori FROM Kategorier WHERE aktiv=1 ORDER BY kategori ASC";        $result = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));                if (sqlsrv_num_rows($result) > 0) {                while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC )) {                  echo "<option value='" . $row['kategori'] . "'>" . $row['kategori'] . "</option>";        }                }		   echo "</select>.";		   		   		 ?>		 </big></form>	   </td>	   </tr>	   <tr><td>&nbsp;</td></tr>	   <tr>	   <td colspan=3>	   		   <form action="emaillista-resa.php" method="post" name="form"><big>		   <?php		   echo "<input type='submit' value='Skapa lista' style='font-size:18px;'>";		   echo " från resa <select multiple size=5 id='resa' name='resa[]' style='font-size:12px;'>";		   $datelimit = date('Y-m-d', strtotime("-3 year", time()));		   $sql = "SELECT resaid, resa, date FROM Resor WHERE date > CONVERT(date, '" . $datelimit . "', 126) ORDER BY date DESC";        $result = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));                if (sqlsrv_num_rows($result) > 0) {                while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC )) {                  echo "<option value='" . $row['resaid'] . "'>" . $row['resa'] . " " . $row['date']->format('j/n-y') . "</option>";        }                }		   echo "</select>. ";		   		   		 ?>		 </big></form>	   </td>	   </tr>	   <tr>	   <td colspan=3><br><big>	   Blockera utskick till e-mail: <form action="email-addblocked.php" method="post">  			<input type="text" name="email">  			<input type="submit" value="Blockera">			</form></big>	   </td>	   </tr></table></body></html><?php   	  sqlsrv_close;?> 