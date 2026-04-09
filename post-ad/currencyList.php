<div class="form-group">
    <label>Currency</label><span class="red">*</span>
    <select class="form-control" name="defaltcurrency"> 
      <option value="USD"  <?php if($row["defaltcurrency"]=='USD' ){ echo 'selected';} ?>>United States Dollars</option>
      <option value="EUR" <?php if($row["defaltcurrency"]=='EUR' ){ echo 'selected';} ?>>Euro</option>
      <option value="GBP" <?php if($row["defaltcurrency"]=='GBP' ){ echo 'selected';} ?>>United Kingdom Pounds</option>
      <option value="DZD" <?php if($row["defaltcurrency"]=='DZD' ){ echo 'selected';} ?>>Algeria Dinars</option>
      <option value="ARP" <?php if($row["defaltcurrency"]=='ARP' ){ echo 'selected';} ?>>Argentina Pesos</option>
      <option value="AUD" <?php if($row["defaltcurrency"]=='AUD' ){ echo 'selected';} ?>>Australia Dollars</option>
      <option value="ATS" <?php if($row["defaltcurrency"]=='ATS' ){ echo 'selected';} ?>>Austria Schillings</option>
      <option value="BSD" <?php if($row["defaltcurrency"]=='BSD' ){ echo 'selected';} ?>>Bahamas Dollars</option>
      <option value="BBD" <?php if($row["defaltcurrency"]=='BBD' ){ echo 'selected';} ?>>Barbados Dollars</option>
      <option value="BEF" <?php if($row["defaltcurrency"]=='BEF' ){ echo 'selected';} ?>>Belgium Francs</option>
      <option value="BMD" <?php if($row["defaltcurrency"]=='BMD' ){ echo 'selected';} ?>>Bermuda Dollars</option>
      <option value="BRR" <?php if($row["defaltcurrency"]=='BRR' ){ echo 'selected';} ?>>Brazil Real</option>
      <option value="BGL" <?php if($row["defaltcurrency"]=='BGL' ){ echo 'selected';} ?>>Bulgaria Lev</option>
      <option value="CAD" <?php if($row["defaltcurrency"]=='CAD' ){ echo 'selected';} ?>>Canada Dollars</option>
      <option value="CLP" <?php if($row["defaltcurrency"]=='CLP' ){ echo 'selected';} ?>>Chile Pesos</option>
      <option value="CNY" <?php if($row["defaltcurrency"]=='CNY' ){ echo 'selected';} ?>>China Yuan Renmimbi</option>
      <option value="CYP" <?php if($row["defaltcurrency"]=='CYP' ){ echo 'selected';} ?>>Cyprus Pounds</option>
      <option value="CSK" <?php if($row["defaltcurrency"]=='CSK' ){ echo 'selected';} ?>>Czech Republic Koruna</option>
      <option value="DKK" <?php if($row["defaltcurrency"]=='DKK' ){ echo 'selected';} ?>>Denmark Kroner</option>
      <option value="NLG" <?php if($row["defaltcurrency"]=='NLG' ){ echo 'selected';} ?>>Dutch Guilders</option>
      <option value="XCD" <?php if($row["defaltcurrency"]=='XCD' ){ echo 'selected';} ?>>Eastern Caribbean Dollars</option>
      <option value="EGP" <?php if($row["defaltcurrency"]=='EGP' ){ echo 'selected';} ?>>Egypt Pounds</option>
      <option value="FJD" <?php if($row["defaltcurrency"]=='FJD' ){ echo 'selected';} ?>>Fiji Dollars</option>
      <option value="FIM" <?php if($row["defaltcurrency"]=='FIM' ){ echo 'selected';} ?>>Finland Markka</option>
      <option value="FRF" <?php if($row["defaltcurrency"]=='FRF' ){ echo 'selected';} ?>>France Francs</option>
      <option value="DEM" <?php if($row["defaltcurrency"]=='DEM' ){ echo 'selected';} ?>>Germany Deutsche Marks</option>
      <option value="XAU" <?php if($row["defaltcurrency"]=='XAU' ){ echo 'selected';} ?>>Gold Ounces</option>
      <option value="GRD" <?php if($row["defaltcurrency"]=='GRD' ){ echo 'selected';} ?>>Greece Drachmas</option>
      <option value="HKD" <?php if($row["defaltcurrency"]=='HKD' ){ echo 'selected';} ?>>Hong Kong Dollars</option>
      <option value="HUF" <?php if($row["defaltcurrency"]=='HUF' ){ echo 'selected';} ?>>Hungary Forint</option>
      <option value="ISK" <?php if($row["defaltcurrency"]=='ISK' ){ echo 'selected';} ?>>Iceland Krona</option>
      <option value="INR" <?php if($row["defaltcurrency"]=='INR' ){ echo 'selected';} ?>>India Rupees</option>
      <option value="IDR" <?php if($row["defaltcurrency"]=='IDR' ){ echo 'selected';} ?>>Indonesia Rupiah</option>
      <option value="IEP" <?php if($row["defaltcurrency"]=='IEP' ){ echo 'selected';} ?>>Ireland Punt</option>
      <option value="ILS" <?php if($row["defaltcurrency"]=='ILS' ){ echo 'selected';} ?>>Israel New Shekels</option>
      <option value="ITL" <?php if($row["defaltcurrency"]=='ITL' ){ echo 'selected';} ?>>Italy Lira</option>
      <option value="JMD" <?php if($row["defaltcurrency"]=='JMD' ){ echo 'selected';} ?>>Jamaica Dollars</option>
      <option value="JPY" <?php if($row["defaltcurrency"]=='JPY' ){ echo 'selected';} ?>>Japan Yen</option>
      <option value="JOD" <?php if($row["defaltcurrency"]=='JOD' ){ echo 'selected';} ?>>Jordan Dinar</option>
      <option value="KRW" <?php if($row["defaltcurrency"]=='KRW' ){ echo 'selected';} ?>>Korea (South) Won</option>
      <option value="LBP" <?php if($row["defaltcurrency"]=='LBP' ){ echo 'selected';} ?>>Lebanon Pounds</option>
      <option value="LUF" <?php if($row["defaltcurrency"]=='LUF' ){ echo 'selected';} ?>>Luxembourg Francs</option>
      <option value="MYR" <?php if($row["defaltcurrency"]=='MYR' ){ echo 'selected';} ?>>Malaysia Ringgit</option>
      <option value="MXP" <?php if($row["defaltcurrency"]=='MXP' ){ echo 'selected';} ?>>Mexico Pesos</option>
      <option value="NLG" <?php if($row["defaltcurrency"]=='NLG' ){ echo 'selected';} ?>>Netherlands Guilders</option>
      <option value="NZD" <?php if($row["defaltcurrency"]=='NZD' ){ echo 'selected';} ?>>New Zealand Dollars</option>
      <option value="NOK" <?php if($row["defaltcurrency"]=='NOK' ){ echo 'selected';} ?>>Norway Kroner</option>
      <option value="PKR" <?php if($row["defaltcurrency"]=='PKR' ){ echo 'selected';} ?>>Pakistan Rupees</option>
      <option value="XPD" <?php if($row["defaltcurrency"]=='XPD' ){ echo 'selected';} ?>>Palladium Ounces</option>
      <option value="PHP" <?php if($row["defaltcurrency"]=='PHP' ){ echo 'selected';} ?>>Philippines Pesos</option>
      <option value="XPT" <?php if($row["defaltcurrency"]=='XPT' ){ echo 'selected';} ?>>Platinum Ounces</option>
      <option value="PLZ" <?php if($row["defaltcurrency"]=='PLZ' ){ echo 'selected';} ?>>Poland Zloty</option>
      <option value="PTE" <?php if($row["defaltcurrency"]=='PTE' ){ echo 'selected';} ?>>Portugal Escudo</option>
      <option value="ROL" <?php if($row["defaltcurrency"]=='ROL' ){ echo 'selected';} ?>>Romania Leu</option>
      <option value="RUR" <?php if($row["defaltcurrency"]=='RUR' ){ echo 'selected';} ?>>Russia Rubles</option>
      <option value="SAR" <?php if($row["defaltcurrency"]=='SAR' ){ echo 'selected';} ?>>Saudi Arabia Riyal</option>
      <option value="XAG" <?php if($row["defaltcurrency"]=='XAG' ){ echo 'selected';} ?>>Silver Ounces</option>
      <option value="SGD" <?php if($row["defaltcurrency"]=='SGD' ){ echo 'selected';} ?>>Singapore Dollars</option>
      <option value="SKK" <?php if($row["defaltcurrency"]=='SKK' ){ echo 'selected';} ?>>Slovakia Koruna</option>
      <option value="ZAR" <?php if($row["defaltcurrency"]=='ZAR' ){ echo 'selected';} ?>>South Africa Rand</option>
      <option value="KRW" <?php if($row["defaltcurrency"]=='KRW' ){ echo 'selected';} ?>>South Korea Won</option>
      <option value="ESP" <?php if($row["defaltcurrency"]=='ESP' ){ echo 'selected';} ?>>Spain Pesetas</option>
      <option value="XDR" <?php if($row["defaltcurrency"]=='XDR' ){ echo 'selected';} ?>>Special Drawing Right (IMF)</option>
      <option value="SDD" <?php if($row["defaltcurrency"]=='SDD' ){ echo 'selected';} ?>>Sudan Dinar</option>
      <option value="SEK" <?php if($row["defaltcurrency"]=='SEK' ){ echo 'selected';} ?>>Sweden Krona</option>
      <option value="CHF" <?php if($row["defaltcurrency"]=='CHF' ){ echo 'selected';} ?>>Switzerland Francs</option>
      <option value="TWD" <?php if($row["defaltcurrency"]=='TWD' ){ echo 'selected';} ?>>Taiwan Dollars</option>
      <option value="THB" <?php if($row["defaltcurrency"]=='THB' ){ echo 'selected';} ?>>Thailand Baht</option>
      <option value="TTD" <?php if($row["defaltcurrency"]=='TTD' ){ echo 'selected';} ?>>Trinidad and Tobago Dollars</option>
      <option value="TRL" <?php if($row["defaltcurrency"]=='TRL' ){ echo 'selected';} ?>>Turkey Lira</option>
      <option value="VEB" <?php if($row["defaltcurrency"]=='VEB' ){ echo 'selected';} ?>>Venezuela Bolivar</option>
      <option value="ZMK" <?php if($row["defaltcurrency"]=='ZMK' ){ echo 'selected';} ?>>Zambia Kwacha</option>
      <option value="XCD" <?php if($row["defaltcurrency"]=='XCD' ){ echo 'selected';} ?>>Eastern Caribbean Dollars</option>
      <option value="XDR" <?php if($row["defaltcurrency"]=='XDR' ){ echo 'selected';} ?>>Special Drawing Right (IMF)</option>
      <option value="XAG" <?php if($row["defaltcurrency"]=='XAG' ){ echo 'selected';} ?>>Silver Ounces</option>
      <option value="XAU" <?php if($row["defaltcurrency"]=='XAU' ){ echo 'selected';} ?>>Gold Ounces</option>
      <option value="XPD" <?php if($row["defaltcurrency"]=='XPD' ){ echo 'selected';} ?>>Palladium Ounces</option>
      <option value="XPT" <?php if($row["defaltcurrency"]=='XPT' ){ echo 'selected';} ?>>Platinum Ounces</option>
    </select>

  </div>
