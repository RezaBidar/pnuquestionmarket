<?php /* In The Name Of Allah */

/** Software Hijri_Shamsi , Solar(Jalali) Date and Time
Copyright(C)2011, Reza Gholampanahi , http://jdf.scr.ir
version 2.55 :: 1391/08/24 = 1433/12/18 = 2012/11/15 */

/*	F	*/
function jdate($format,$timestamp='',$none='',$time_zone='Asia/Tehran',$tr_num='fa'){

 $T_sec=0;/* <= رفع خطاي زمان سرور ، با اعداد '+' و '-' بر حسب ثانيه */

 if($time_zone!='local')date_default_timezone_set(($time_zone=='')?'Asia/Tehran':$time_zone);
 $ts=$T_sec+(($timestamp=='' or $timestamp=='now')?time():tr_num($timestamp));
 $date=explode('_',date('H_i_j_n_O_P_s_w_Y',$ts));
 list($j_y,$j_m,$j_d)=gregorian_to_jalali($date[8],$date[3],$date[2]);
 $doy=($j_m<7)?(($j_m-1)*31)+$j_d-1:(($j_m-7)*30)+$j_d+185;
 $kab=($j_y%33%4-1==(int)($j_y%33*.05))?1:0;
 $sl=strlen($format);
 $out='';
 for($i=0; $i<$sl; $i++){
  $sub=substr($format,$i,1);
  if($sub=='\\'){
	$out.=substr($format,++$i,1);
	continue;
  }
  switch($sub){

	case'E':case'R':case'x':case'X':
	$out.='http://jdf.scr.ir';
	break;

	case'B':case'e':case'g':
	case'G':case'h':case'I':
	case'T':case'u':case'Z':
	$out.=date($sub,$ts);
	break;

	case'a':
	$out.=($date[0]<12)?'ق.ظ':'ب.ظ';
	break;

	case'A':
	$out.=($date[0]<12)?'قبل از ظهر':'بعد از ظهر';
	break;

	case'b':
	$out.=(int)($j_m/3.1)+1;
	break;

	case'c':
	$out.=$j_y.'/'.$j_m.'/'.$j_d.' ،'.$date[0].':'.$date[1].':'.$date[6].' '.$date[5];
	break;

	case'C':
	$out.=(int)(($j_y+99)/100);
	break;

	case'd':
	$out.=($j_d<10)?'0'.$j_d:$j_d;
	break;

	case'D':
	$out.=jdate_words(array('kh'=>$date[7]),' ');
	break;

	case'f':
	$out.=jdate_words(array('ff'=>$j_m),' ');
	break;

	case'F':
	$out.=jdate_words(array('mm'=>$j_m),' ');
	break;

	case'H':
	$out.=$date[0];
	break;

	case'i':
	$out.=$date[1];
	break;

	case'j':
	$out.=$j_d;
	break;

	case'J':
	$out.=jdate_words(array('rr'=>$j_d),' ');
	break;

	case'k';
	$out.=tr_num(100-(int)($doy/($kab+365)*1000)/10,$tr_num);
	break;

	case'K':
	$out.=tr_num((int)($doy/($kab+365)*1000)/10,$tr_num);
	break;

	case'l':
	$out.=jdate_words(array('rh'=>$date[7]),' ');
	break;

	case'L':
	$out.=$kab;
	break;

	case'm':
	$out.=($j_m>9)?$j_m:'0'.$j_m;
	break;

	case'M':
	$out.=jdate_words(array('km'=>$j_m),' ');
	break;

	case'n':
	$out.=$j_m;
	break;

	case'N':
	$out.=$date[7]+1;
	break;

	case'o':
	$jdw=($date[7]==6)?0:$date[7]+1;
	$dny=364+$kab-$doy;
	$out.=($jdw>($doy+3) and $doy<3)?$j_y-1:(((3-$dny)>$jdw and $dny<3)?$j_y+1:$j_y);
	break;

	case'O':
	$out.=$date[4];
	break;

	case'p':
	$out.=jdate_words(array('mb'=>$j_m),' ');
	break;

	case'P':
	$out.=$date[5];
	break;

	case'q':
	$out.=jdate_words(array('sh'=>$j_y),' ');
	break;

	case'Q':
	$out.=$kab+364-$doy;
	break;

	case'r':
	$key=jdate_words(array('rh'=>$date[7],'mm'=>$j_m));
	$out.=$date[0].':'.$date[1].':'.$date[6].' '.$date[4]
	.' '.$key['rh'].'، '.$j_d.' '.$key['mm'].' '.$j_y;
	break;

	case's':
	$out.=$date[6];
	break;

	case'S':
	$out.='ام';
	break;

	case't':
	$out.=($j_m!=12)?(31-(int)($j_m/6.5)):($kab+29);
	break;

	case'U':
	$out.=$ts;
	break;

	case'v':
	 $out.=jdate_words(array('ss'=>substr($j_y,2,2)),' ');
	break;

	case'V':
	$out.=jdate_words(array('ss'=>$j_y),' ');
	break;

	case'w':
	$out.=($date[7]==6)?0:$date[7]+1;
	break;

	case'W':
	$avs=(($date[7]==6)?0:$date[7]+1)-($doy%7);
	if($avs<0)$avs+=7;
	$num=(int)(($doy+$avs)/7);
	if($avs<4){
	 $num++;
	}elseif($num<1){
	 $num=($avs==4 or $avs==(($j_y%33%4-2==(int)($j_y%33*.05))?5:4))?53:52;
	}
	$aks=$avs+$kab;
	if($aks==7)$aks=0;
	$out.=(($kab+363-$doy)<$aks and $aks<3)?'01':(($num<10)?'0'.$num:$num);
	break;

	case'y':
	$out.=substr($j_y,2,2);
	break;

	case'Y':
	$out.=$j_y;
	break;

	case'z':
	$out.=$doy;
	break;

	default:$out.=$sub;
  }
 }
 return($tr_num!='en')?tr_num($out,'fa','.'):$out;
}

/*	F	*/
function jstrftime($format,$timestamp='',$none='',$time_zone='Asia/Tehran',$tr_num='fa'){

 $T_sec=0;/* <= رفع خطاي زمان سرور ، با اعداد '+' و '-' بر حسب ثانيه */

 if($time_zone!='local')date_default_timezone_set(($time_zone=='')?'Asia/Tehran':$time_zone);
 $ts=$T_sec+(($timestamp=='' or $timestamp=='now')?time():tr_num($timestamp));
 $date=explode('_',date('h_H_i_j_n_s_w_Y',$ts));
 list($j_y,$j_m,$j_d)=gregorian_to_jalali($date[7],$date[4],$date[3]);
 $doy=($j_m<7)?(($j_m-1)*31)+$j_d-1:(($j_m-7)*30)+$j_d+185;
 $kab=($j_y%33%4-1==(int)($j_y%33*.05))?1:0;
 $sl=strlen($format);
 $out='';
 for($i=0; $i<$sl; $i++){
  $sub=substr($format,$i,1);
  if($sub=='%'){
	$sub=substr($format,++$i,1);
  }else{
	$out.=$sub;
	continue;
  }
  switch($sub){

	/* Day */
	case'a':
	$out.=jdate_words(array('kh'=>$date[6]),' ');
	break;

	case'A':
	$out.=jdate_words(array('rh'=>$date[6]),' ');
	break;

	case'd':
	$out.=($j_d<10)?'0'.$j_d:$j_d;
	break;

	case'e':
	$out.=($j_d<10)?' '.$j_d:$j_d;
	break;

	case'j':
	$out.=str_pad($doy+1,3,0,STR_PAD_LEFT);
	break;

	case'u':
	$out.=$date[6]+1;
	break;

	case'w':
	$out.=($date[6]==6)?0:$date[6]+1;
	break;

	/* Week */
	case'U':
	$avs=(($date[6]<5)?$date[6]+2:$date[6]-5)-($doy%7);
	if($avs<0)$avs+=7;
	$num=(int)(($doy+$avs)/7)+1;
	if($avs>3 or $avs==1)$num--;
	$out.=($num<10)?'0'.$num:$num;
	break;

	case'V':
	$avs=(($date[6]==6)?0:$date[6]+1)-($doy%7);
	if($avs<0)$avs+=7;
	$num=(int)(($doy+$avs)/7);
	if($avs<4){
	 $num++;
	}elseif($num<1){
	 $num=($avs==4 or $avs==(($j_y%33%4-2==(int)($j_y%33*.05))?5:4))?53:52;
	}
	$aks=$avs+$kab;
	if($aks==7)$aks=0;
	$out.=(($kab+363-$doy)<$aks and $aks<3)?'01':(($num<10)?'0'.$num:$num);
	break;

	case'W':
	$avs=(($date[6]==6)?0:$date[6]+1)-($doy%7);
	if($avs<0)$avs+=7;
	$num=(int)(($doy+$avs)/7)+1;
	if($avs>3)$num--;
	$out.=($num<10)?'0'.$num:$num;
	break;

	/* Month */
	case'b':
	case'h':
	$out.=jdate_words(array('km'=>$j_m),' ');
	break;

	case'B':
	$out.=jdate_words(array('mm'=>$j_m),' ');
	break;

	case'm':
	$out.=($j_m>9)?$j_m:'0'.$j_m;
	break;

	/* Year */
	case'C':
	$out.=substr($j_y,0,2);
	break;

	case'g':
	$jdw=($date[6]==6)?0:$date[6]+1;
	$dny=364+$kab-$doy;
	$out.=substr(($jdw>($doy+3) and $doy<3)?$j_y-1:(((3-$dny)>$jdw and $dny<3)?$j_y+1:$j_y),2,2);
	break;	

	case'G':
	$jdw=($date[6]==6)?0:$date[6]+1;
	$dny=364+$kab-$doy;
	$out.=($jdw>($doy+3) and $doy<3)?$j_y-1:(((3-$dny)>$jdw and $dny<3)?$j_y+1:$j_y);
	break;

	case'y':
	$out.=substr($j_y,2,2);
	break;

	case'Y':
	$out.=$j_y;
	break;

	/* Time */
	case'H':
	$out.=$date[1];
	break;

	case'I':
	$out.=$date[0];
	break;

	case'l':
	$out.=($date[0]>9)?$date[0]:' '.(int)$date[0];
	break;

	case'M':
	$out.=$date[2];
	break;

	case'p':
	$out.=($date[1]<12)?'قبل از ظهر':'بعد از ظهر';
	break;

	case'P':
	$out.=($date[1]<12)?'ق.ظ':'ب.ظ';
	break;

	case'r':
	$out.=$date[0].':'.$date[2].':'.$date[5].' '.(($date[1]<12)?'قبل از ظهر':'بعد از ظهر');
	break;

	case'R':
	$out.=$date[1].':'.$date[2];
	break;

	case'S':
	$out.=$date[5];
	break;

	case'T':
	$out.=$date[1].':'.$date[2].':'.$date[5];
	break;

	case'X':
	$out.=$date[0].':'.$date[2].':'.$date[5];
	break;

	case'z':
	$out.=date('O',$ts);
	break;

	case'Z':
	$out.=date('T',$ts);
	break;

	/* Time and Date Stamps */
	case'c':
	$key=jdate_words(array('rh'=>$date[6],'mm'=>$j_m));
	$out.=$date[1].':'.$date[2].':'.$date[5].' '.date('P',$ts)
	.' '.$key['rh'].'، '.$j_d.' '.$key['mm'].' '.$j_y;
	break;

	case'D':
	$out.=substr($j_y,2,2).'/'.(($j_m>9)?$j_m:'0'.$j_m).'/'.(($j_d<10)?'0'.$j_d:$j_d);
	break;

	case'F':
	$out.=$j_y.'-'.(($j_m>9)?$j_m:'0'.$j_m).'-'.(($j_d<10)?'0'.$j_d:$j_d);
	break;

	case's':
	$out.=$ts;
	break;

	case'x':
	$out.=substr($j_y,2,2).'/'.(($j_m>9)?$j_m:'0'.$j_m).'/'.(($j_d<10)?'0'.$j_d:$j_d);
	break;

	/* Miscellaneous */
	case'n':
	$out.="\n";
	break;

	case't':
	$out.="\t";
	break;

	case'%':
	$out.='%';
	break;

	default:$out.=$sub;
  }
 }
 return($tr_num!='en')?tr_num($out,'fa','.'):$out;
}

/*	F	*/
function jmktime($h='',$m='',$s='',$jm='',$jd='',$jy='',$is_dst=-1){
 $h=tr_num($h); $m=tr_num($m); $s=tr_num($s); $jm=tr_num($jm); $jd=tr_num($jd); $jy=tr_num($jy);
 if($h=='' and $m=='' and $s=='' and $jm=='' and $jd=='' and $jy==''){
	return mktime();
 }else{
	list($year,$month,$day)=jalali_to_gregorian($jy,$jm,$jd);
	return mktime($h,$m,$s,$month,$day,$year,$is_dst);
 }
}

/*	F	*/
function jgetdate($timestamp='',$none='',$tz='Asia/Tehran',$tn='en'){
 $ts=($timestamp=='')?time():tr_num($timestamp);
 $jdate=explode('_',jdate('F_G_i_j_l_n_s_w_Y_z',$ts,'',$tz,$tn));
 return array(
	'seconds'=>tr_num((int)tr_num($jdate[6]),$tn),
	'minutes'=>tr_num((int)tr_num($jdate[2]),$tn),
	'hours'=>$jdate[1],
	'mday'=>$jdate[3],
	'wday'=>$jdate[7],
	'mon'=>$jdate[5],
	'year'=>$jdate[8],
	'yday'=>$jdate[9],
	'weekday'=>$jdate[4],
	'month'=>$jdate[0],
	0=>tr_num($ts,$tn)
 );
}

/*	F	*/
function jcheckdate($jm,$jd,$jy){
 $jm=tr_num($jm); $jd=tr_num($jd); $jy=tr_num($jy);
 $l_d=($jm==12)?(($jy%33%4-1==(int)($jy%33*.05))?30:29):31-(int)($jm/6.5);
 return($jm>0 and $jd>0 and $jy>0 and $jm<13 and $jd<=$l_d)?true:false;
}

/*	F	*/
function tr_num($str,$mod='en',$mf='٫'){
 $num_a=array('0','1','2','3','4','5','6','7','8','9','.');
 $key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹',$mf);
 return($mod=='fa')?str_replace($num_a,$key_a,$str):str_replace($key_a,$num_a,$str);
}

/*	F	*/
function jdate_words($array,$mod=''){
 foreach($array as $type=>$num){
  $num=(int)tr_num($num);
  switch($type){

	case'ss':
	$sl=strlen($num);
	$xy3=substr($num,2-$sl,1);
	$h3=$h34=$h4='';
	if($xy3==1){
	 $p34='';
	 $k34=array('ده','یازده','دوازده','سیزده','چهارده','پانزده','شانزده','هفده','هجده','نوزده');
	 $h34=$k34[substr($num,2-$sl,2)-10];
	}else{
	 $xy4=substr($num,3-$sl,1);
	 $p34=($xy3==0 or $xy4==0)?'':' و ';
	 $k3=array('','','بیست','سی','چهل','پنجاه','شصت','هفتاد','هشتاد','نود');
	 $h3=$k3[$xy3];
	 $k4=array('','یک','دو','سه','چهار','پنج','شش','هفت','هشت','نه');
	 $h4=$k4[$xy4];
	}
	$array[$type]=(($num>99)?str_ireplace(array('12','13','14','19','20')
	,array('هزار و دویست','هزار و سیصد','هزار و چهارصد','هزار و نهصد','دوهزار')
	,substr($num,0,2)).((substr($num,2,2)=='00')?'':' و '):'').$h3.$p34.$h34.$h4;
	break;

	case'mm':
	$key=array
	('فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند');
	$array[$type]=$key[$num-1];
	break;

	case'rr':
	$key=array('یک','دو','سه','چهار','پنج','شش','هفت','هشت','نه','ده','یازده','دوازده','سیزده',
	'چهارده','پانزده','شانزده','هفده','هجده','نوزده','بیست','بیست و یک','بیست و دو','بیست و سه',
	'بیست و چهار','بیست و پنج','بیست و شش','بیست و هفت','بیست و هشت','بیست و نه','سی','سی و یک');
	$array[$type]=$key[$num-1];
	break;

	case'rh':
	$key=array('یکشنبه','دوشنبه','سه شنبه','چهارشنبه','پنجشنبه','جمعه','شنبه');
	$array[$type]=$key[$num];
	break;

	case'sh':
	$key=array('مار','اسب','گوسفند','میمون','مرغ','سگ','خوک','موش','گاو','پلنگ','خرگوش','نهنگ');
	$array[$type]=$key[$num%12];
	break;

	case'mb':
	$key=array('حمل','ثور','جوزا','سرطان','اسد','سنبله','میزان','عقرب','قوس','جدی','دلو','حوت');
	$array[$type]=$key[$num-1];
	break;

	case'ff':
	$key=array('بهار','تابستان','پاییز','زمستان');
	$array[$type]=$key[(int)($num/3.1)];
	break;

	case'km':
	$key=array('فر','ار','خر','تی‍','مر','شه‍','مه‍','آب‍','آذ','دی','به‍','اس‍');
	$array[$type]=$key[$num-1];
	break;

	case'kh':
	$key=array('ی','د','س','چ','پ','ج','ش');
	$array[$type]=$key[$num];
	break;

	default:$array[$type]=$num;
  }
 }
 return($mod=='')?$array:implode($mod,$array);
}

/** Convertor from and to Gregorian and Jalali (Hijri_Shamsi,Solar) Functions
Copyright(C)2011, Reza Gholampanahi [ http://jdf.scr.ir/jdf ] version 2.50 */

/*	F	*/
function gregorian_to_jalali($g_y,$g_m,$g_d,$mod=''){
	$g_y=tr_num($g_y); $g_m=tr_num($g_m); $g_d=tr_num($g_d);/* <= :اين سطر ، جزء تابع اصلي نيست */
 $d_4=$g_y%4;
 $g_a=array(0,0,31,59,90,120,151,181,212,243,273,304,334);
 $doy_g=$g_a[(int)$g_m]+$g_d;
 if($d_4==0 and $g_m>2)$doy_g++;
 $d_33=(int)((($g_y-16)%132)*.0305);
 $a=($d_33==3 or $d_33<($d_4-1) or $d_4==0)?286:287;
 $b=(($d_33==1 or $d_33==2) and ($d_33==$d_4 or $d_4==1))?78:(($d_33==3 and $d_4==0)?80:79);
 if((int)(($g_y-10)/63)==30){$a--;$b++;}
 if($doy_g>$b){
  $jy=$g_y-621; $doy_j=$doy_g-$b;
 }else{
  $jy=$g_y-622; $doy_j=$doy_g+$a;
 }
 if($doy_j<187){
  $jm=(int)(($doy_j-1)/31); $jd=$doy_j-(31*$jm++);
 }else{
  $jm=(int)(($doy_j-187)/30); $jd=$doy_j-186-($jm*30); $jm+=7;
 }
 return($mod=='')?array($jy,$jm,$jd):$jy.$mod.$jm.$mod.$jd;
}

/*	F	*/
function jalali_to_gregorian($j_y,$j_m,$j_d,$mod=''){
	$j_y=tr_num($j_y); $j_m=tr_num($j_m); $j_d=tr_num($j_d);/* <= :اين سطر ، جزء تابع اصلي نيست */
 $d_4=($j_y+1)%4;
 $doy_j=($j_m<7)?(($j_m-1)*31)+$j_d:(($j_m-7)*30)+$j_d+186;
 $d_33=(int)((($j_y-55)%132)*.0305);
 $a=($d_33!=3 and $d_4<=$d_33)?287:286;
 $b=(($d_33==1 or $d_33==2) and ($d_33==$d_4 or $d_4==1))?78:(($d_33==3 and $d_4==0)?80:79);
 if((int)(($j_y-19)/63)==20){$a--;$b++;}
 if($doy_j<=$a){
  $gy=$j_y+621; $gd=$doy_j+$b;
 }else{
  $gy=$j_y+622; $gd=$doy_j-$a;
 }
 foreach(array(0,31,($gy%4==0)?29:28,31,30,31,30,31,31,30,31,30,31) as $gm=>$v){
  if($gd<=$v)break;
  $gd-=$v;
 }
 return($mod=='')?array($gy,$gm,$gd):$gy.$mod.$gm.$mod.$gd;
}

/* [ jdf.php ] version 2.55 ?> Download new version from [ http://jdf.scr.ir ] */
 
//function jalali_date_to_gregorian_datetime($)

//reza bidar costum functions

/**
 * yek tarikhe jalali ba formatii ke too form ha hast migire
 * va yek tarikhe gregorian ba formatii ke beshe to table zakhire kard barmigardoone
 * jalali(YYYY-m-d HH-mm-ss) to gregorian(YYYY-m-d HH-mm-ss)
 * @param string $datetime
 * @param bool $with_time // time included or excluded
 */
function convertMyJalaliToGregorian($datetime , $with_time = TRUE){
    $ex = explode(" ", $datetime) ;
    $date = $ex[0] ;
    $time = $ex[1] ;
    $date = explode("-", $date) ;
    $gregorian =  jalali_to_gregorian(intval($date[0]), intval($date[1]), intval($date[2])) ;
    $answer = $gregorian[0] . "-" . $gregorian[1] . "-" . $gregorian[2] ;
    if($with_time) $answer .= " " . $time ;
    return  $answer ;
}

/**
 * ekhtelafe time dade shode ba now 
 * @param unknown $time
 * @param string $detect_online
 * @return string
 */
function diffTime($time , $detect_online = FALSE){
    $now = time() ;
    $dif = abs($now - $time) ;
    $word = "قبل" ;
    if($now - $time < 0){
        $word =  "آینده" ;
    }
    
    $min = $dif / 60 ;
    if($min < 1)
        if($detect_online)return "آنلاین" ;
        else return tr_num(intval($dif),'fa') . " ثانیه " . $word ;
    $hour = $min / 60 ;
    if($hour < 1)
        return tr_num(intval($min),'fa') . " دقیقه " . $word ;
    $day = $hour / 24 ;
    if($day < 1)
        return tr_num(intval($hour),'fa') . " ساعت " . " و " .  tr_num(intval($min % 60),'fa') . " دقیقه " . $word ;
    $year = $day / 365 ;
    if($year < 1)
        return tr_num(intval($day),'fa') . " روز " .  " و " .  tr_num(intval($hour % 24),'fa') . " ساعت " . $word ;
    return tr_num(intval($year),'fa') . " سال " . " و " .  tr_num(intval($day % 365),'fa') . " روز " . $word ;
}

/**
 * ye araye barmigardoone ke roozaye har maho neshoon mide
 * @param unknown $jy
 * @param unknown $jm
 * @return multitype:NULL
 */
function dayList($jy,$jm){
    $l_d=($jm==12)?(($jy%33%4-1==(int)($jy%33*.05))?30:29):31-(int)($jm/6.5);
    $days = array();
    for($i = 1 ; $i <= $l_d ; $i++) $days[$i] = tr_num($i , 'fa') ;
    return $days ;
}

/**
 * liste mah ha ro barmigardanad
 */
function monthList(){
    $month = array() ;
    $month["1"] = "فروردین" ;
    $month["2"] = "اردیبهشت" ;
    $month["3"] = "خرداد" ;
    $month["4"] = "تیر" ;
    $month["5"] = "مرداد" ;
    $month["6"] = "شهریور" ;
    $month["7"] = "مهر" ;
    $month["8"] = "آبان" ;
    $month["9"] = "آذر" ;
    $month["10"] = "دی" ;
    $month["11"] = "بهمن" ;
    $month["12"] = "اسفند" ;
    
    return $month ;
}

/**
 * liste salHa ra barmigardanad
 */
function yearList($min = 1390 , $max = 1400){
    $year = array() ;
    for($i = $min ; $i <= $max ; $i++) $year[$i] = tr_num($i, 'fa');
    return $year;
} 

/**
 * liste sa@ ha
*/
function hourList(){
    $hour = array() ;
    for($i = 0 ; $i < 24 ; $i++) $hour[$i] = tr_num($i,'fa');
    return $hour;
}

/**
 * liste daghigheha ha
 */
function minuteList(){
    $minute = array() ;
    for($i = 0 ; $i < 60 ; $i+=5) $minute[$i] = tr_num($i,'fa');
    return $minute;
}

/**
 * datepicker ro be ham michasboone va tarikhe shamsi ro barmigardoone
 * @param integer $y
 * @param integer $m
 * @param integer $d
 * @param integer $h
 * @param integer $i
 * @param integer $s
 * @return string
 */
function formDatePickerToJdate($y , $m , $d , $h , $i , $s){
//     if(intval($m) < 10) $m = '0' . $m ;
//     if(intval($d) < 10) $d = '0' . $d ;
    if(intval($h) < 10) $h = '0' . $h ;
    if(intval($i) < 10) $i = '0' . $i ;
    if(intval($s) < 10) $s = '0' . $s ;
    $ans = $y . '-' . $m . '-' . $d . ' ' . $h . ':' . $i . ':' . $s ;
//     echo $ans ;
    return $ans ;
    
}