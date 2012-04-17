<?php 
function no_to_words($no)
{   
	$words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred &','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
    if($no == 0)
        return '';
    else {  
		$novalue='';$highno=$no;$remainno=0;$value=100;$value1=1000;        
		while($no>=100)    {
			if(($value <= $no) &&($no  < $value1))    {
				$novalue=$words["$value"];
				$highno = (int)($no/$value);
				$remainno = $no % $value;
				break;
			}
			$value= $value1;
			$value1 = $value * 100;
		}        
	  	if(array_key_exists("$highno",$words))
			return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
	 	else{ 
			$unit=$highno%10;
			$ten =(int)($highno/10)*10;             
			return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
	   	}
    }
}
