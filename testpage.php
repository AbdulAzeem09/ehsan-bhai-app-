<?php
/** Adminer - Compact database management
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2007 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.8.1
*/function
adminer_errors($Ac,$Cc){return!!preg_match('~^(Trying to access array offset on value of type null|Undefined array key)~',$Cc);}error_reporting(6135);set_error_handler('adminer_errors',E_WARNING);$Yc=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($Yc||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Fi=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Fi)$$X=$Fi;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$g;return$g;}function
adminer(){global$b;return$b;}function
version(){global$ia;return$ia;}function
idf_unescape($v){if(!preg_match('~^[`\'"]~',$v))return$v;$ne=substr($v,-1);return
str_replace($ne.$ne,$ne,substr($v,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($qg,$Yc=false){if(function_exists("get_magic_quotes_gpc")&&get_magic_quotes_gpc()){while(list($z,$X)=each($qg)){foreach($X
as$fe=>$W){unset($qg[$z][$fe]);if(is_array($W)){$qg[$z][stripslashes($fe)]=$W;$qg[]=&$qg[$z][stripslashes($fe)];}else$qg[$z][stripslashes($fe)]=($Yc?$W:stripslashes($W));}}}}function
bracket_escape($v,$Ma=false){static$ri=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($v,($Ma?array_flip($ri):$ri));}function
min_version($Wi,$Ae="",$h=null){global$g;if(!$h)$h=$g;$kh=$h->server_info;if($Ae&&preg_match('~([\d.]+)-MariaDB~',$kh,$C)){$kh=$C[1];$Wi=$Ae;}return(version_compare($kh,$Wi)>=0);}function
charset($g){return(min_version("5.5.3",0,$g)?"utf8mb4":"utf8");}function
script($vh,$qi="\n"){return"<script".nonce().">$vh</script>$qi";}function
script_src($Ki){return"<script src='".h($Ki)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($P){return
str_replace("\0","&#0;",htmlspecialchars($P,ENT_QUOTES,'utf-8'));}function
nl_br($P){return
str_replace("\n","<br>",$P);}function
checkbox($D,$Y,$cb,$ke="",$rf="",$gb="",$le=""){$I="<input type='checkbox' name='$D' value='".h($Y)."'".($cb?" checked":"").($le?" aria-labelledby='$le'":"").">".($rf?script("qsl('input').onclick = function () { $rf };",""):"");return($ke!=""||$gb?"<label".($gb?" class='$gb'":"").">$I".h($ke)."</label>":$I);}function
optionlist($xf,$dh=null,$Oi=false){$I="";foreach($xf
as$fe=>$W){$yf=array($fe=>$W);if(is_array($W)){$I.='<optgroup label="'.h($fe).'">';$yf=$W;}foreach($yf
as$z=>$X)$I.='<option'.($Oi||is_string($z)?' value="'.h($z).'"':'').(($Oi||is_string($z)?(string)$z:$X)===$dh?' selected':'').'>'.h($X);if(is_array($W))$I.='</optgroup>';}return$I;}function
html_select($D,$xf,$Y="",$qf=true,$le=""){if($qf)return"<select name='".h($D)."'".($le?" aria-labelledby='$le'":"").">".optionlist($xf,$Y)."</select>".(is_string($qf)?script("qsl('select').onchange = function () { $qf };",""):"");$I="";foreach($xf
as$z=>$X)$I.="<label><input type='radio' name='".h($D)."' value='".h($z)."'".($z==$Y?" checked":"").">".h($X)."</label>";return$I;}function
select_input($Ha,$xf,$Y="",$qf="",$cg=""){$Vh=($xf?"select":"input");return"<$Vh$Ha".($xf?"><option value=''>$cg".optionlist($xf,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$cg'>").($qf?script("qsl('$Vh').onchange = $qf;",""):"");}function
confirm($Ke="",$eh="qsl('input')"){return
script("$eh.onclick = function () { return confirm('".($Ke?js_escape($Ke):'Are you sure?')."'); };","");}function
print_fieldset($u,$se,$Zi=false){echo"<fieldset><legend>","<a href='#fieldset-$u'>$se</a>",script("qsl('a').onclick = partial(toggle, 'f