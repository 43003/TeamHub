<?php 
/****
CHECK HARI INI
****/
	function Displaydobtoday($dtmDate){
		$tarikh = substr($dtmDate, 5, 5); // returns YYYY
		$dtmDate = $tarikh;
		return $dtmDate;
	}
	function Displaydobhari($dtmDate){
		$tarikh = substr($dtmDate, 8, 2); // returns YYYY
		$dtmDate = $tarikh;
		return $dtmDate;
	}
		function Displaydobbulan($dtmDate){
		$tarikh = substr($dtmDate, 5, 2); // returns YYYY
		$dtmDate = $tarikh;
		return $dtmDate;
	}
		function Displaydobtahun($dtmDate){
		$tarikh = substr($dtmDate, 0, 4); // returns YYYY
		$dtmDate = $tarikh;
		return $dtmDate;
	}


     /********************************************** 
	 *** Function to display date as DD/MM/YYYY ***
	 **********************************************/
	function DisplayDate($dtmDate){
		$year = substr($dtmDate, 0, 4); // returns YYYY
		$month = substr($dtmDate, 5, 2); // returns MM
		$day = substr($dtmDate, 8, 2); // returns DD
		if($day == '00' || $day == ''){
			$dtmDate = '';
		}else{			
			$dtmDate = $day."/".$month."/".$year;
		}
		return $dtmDate;
	}

	function DispTime($dtmDate){
		$dtmDate = substr($dtmDate, 11, 8); // returns YYYY
		//$month = substr($dtmDate, 3, 2); // returns MM
		//$day = substr($dtmDate, 0, 2); // returns DD
		if($dtmDate=="00:00:00"){
			return '';
		} else {
			return $dtmDate;
		}
	} 

	function DisplayDateB($dtmDate,$bahasa){
		$year = substr($dtmDate, 0, 4); // returns YYYY
		$month = substr($dtmDate, 5, 2); // returns MM
		$day = substr($dtmDate, 8, 2); // returns DD
		if($day == '00' || $day == ''){
			$dtmDate = '';
		}else{			
			$dtmDate = $day." ".show_monthB($month,$bahasa)." ".$year;
		}
		return $dtmDate;
	}

     /********************************************** 
	 *** Function to display date as DD/MM/YYYY ***
	 **********************************************/
	function DisplayDateShort($dtmDate,$bahasa){
		$year = substr($dtmDate, 0, 4); // returns YYYY
		$month = substr($dtmDate, 5, 2); // returns MM
		$day = substr($dtmDate, 8, 2); // returns DD
		if($day == '00' || $day == ''){
			$dtmDate = '';
		}else{			
			$dtmDate = $day." ".show_month_short($month,$bahasa)." ".$year;
		}
		return $dtmDate;
	}
		
	/********************************************************* 
	 *** Function to convert date to database (YYYY-MM-DD) ***
	 *********************************************************/
	function DBDate($dtmDate){
		if($dtmDate == ''){
			$dtmDate = '';
		}else{
			$year = substr($dtmDate, 6, 4); // returns YYYY
			$month = substr($dtmDate, 3, 2); // returns MM
			$day = substr($dtmDate, 0, 2); // returns DD
			$dtmDate = $year."-".$month."-".$day;
		}
		return $dtmDate;
	}


	function GETTAHUN($dtmDate){
		if($dtmDate == ''){
			$dtmDate = '';
		}else{
			$year = substr($dtmDate, 6, 4); // returns YYYY
			$dtmDate = $year;
		}
		return $dtmDate;
	}

	function GETBULAN($dtmDate){
		if($dtmDate == ''){
			$dtmDate = '';
		}else{
			$month = substr($dtmDate, 3, 2); // returns MM
			$dtmDate = $month;
		}
		return $dtmDate;
	}
	
	function GETDBTAHUN($dtmDate){
		if($dtmDate == ''){
			$dtmDate = '';
		}else{
			$year = substr($dtmDate, 0, 4); // returns YYYY
			$dtmDate = $year;
		}
		return $dtmDate;
	}

	function GETDBBULAN($dtmDate){
		if($dtmDate == ''){
			$dtmDate = '';
		}else{
			$month = substr($dtmDate, 5, 2); // returns MM
			$dtmDate = $month;
		}
		return $dtmDate;
	}

       
        /** function to convert EN to BM  (month)
                                                                 ****/

      function show_month($month)  { // to show month in Bahasa
		if($bahasa=='BM'){	  
            switch($month) {
				case '01' : $m = 'Januari'; break;
				case '02' : $m = 'Februari'; break;
				case '03' : $m = 'Mac'; break; 
				case '04' : $m = 'April'; break; 
				case '05' : $m = 'Mei'; break; 
				case '06' : $m = 'Jun'; break;
				case '07' : $m = 'Julai'; break;
				case '08' : $m = 'Ogos'; break;
				case '09' : $m = 'September'; break;
				case '10' : $m = 'Oktober'; break;
				case '11' : $m = 'November'; break;
				case '12' : $m = 'Disember'; break;
            }  return $m;
		 } else {
            switch($month) {
				case '01' : $m = 'January'; break;
				case '02' : $m = 'February'; break;
				case '03' : $m = 'March'; break; 
				case '04' : $m = 'April'; break; 
				case '05' : $m = 'May'; break; 
				case '06' : $m = 'June'; break;
				case '07' : $m = 'July'; break;
				case '08' : $m = 'August'; break;
				case '09' : $m = 'September'; break;
				case '10' : $m = 'October'; break;
				case '11' : $m = 'November'; break;
				case '12' : $m = 'Disember'; break;
		 }
			return $m;
		}
      }  // end of show month

      function show_monthB($month,$bahasa)  { // to show month in Bahasa
		if($bahasa=='BM'){	  
            switch($month) {
				case '01' : $m = 'Januari'; break;
				case '02' : $m = 'Februari'; break;
				case '03' : $m = 'Mac'; break; 
				case '04' : $m = 'April'; break; 
				case '05' : $m = 'Mei'; break; 
				case '06' : $m = 'Jun'; break;
				case '07' : $m = 'Julai'; break;
				case '08' : $m = 'Ogos'; break;
				case '09' : $m = 'September'; break;
				case '10' : $m = 'Oktober'; break;
				case '11' : $m = 'November'; break;
				case '12' : $m = 'Disember'; break;
            }  return $m;
		 } else {
            switch($month) {
				case '01' : $m = 'January'; break;
				case '02' : $m = 'February'; break;
				case '03' : $m = 'March'; break; 
				case '04' : $m = 'April'; break; 
				case '05' : $m = 'May'; break; 
				case '06' : $m = 'June'; break;
				case '07' : $m = 'July'; break;
				case '08' : $m = 'August'; break;
				case '09' : $m = 'September'; break;
				case '10' : $m = 'October'; break;
				case '11' : $m = 'November'; break;
				case '12' : $m = 'Disember'; break;
		 }
			return $m;
		}
      }  // end of show month

      function show_month_short($month,$bahasa)  { // to show month in Bahasa
		if($bahasa=='BM'){	  
            switch($month) {
				case '01' : $m = 'Jan'; break;
				case '02' : $m = 'Feb'; break;
				case '03' : $m = 'Mac'; break; 
				case '04' : $m = 'Apr'; break; 
				case '05' : $m = 'Mei'; break; 
				case '06' : $m = 'Jun'; break;
				case '07' : $m = 'Jul'; break;
				case '08' : $m = 'Ogos'; break;
				case '09' : $m = 'Sept'; break;
				case '10' : $m = 'Okt'; break;
				case '11' : $m = 'Nov'; break;
				case '12' : $m = 'Dis'; break;
            }  return $m;
		 } else {
            switch($month) {
				case '01' : $m = 'Jan'; break;
				case '02' : $m = 'Feb'; break;
				case '03' : $m = 'Mar'; break; 
				case '04' : $m = 'Apr'; break; 
				case '05' : $m = 'May'; break; 
				case '06' : $m = 'June'; break;
				case '07' : $m = 'July'; break;
				case '08' : $m = 'Aug'; break;
				case '09' : $m = 'Sep'; break;
				case '10' : $m = 'Oct'; break;
				case '11' : $m = 'Nov'; break;
				case '12' : $m = 'Dis'; break;
		 	} return $m;
		}
      }  // end of show month

function fnc_date_calc($this_date,$num_days){
   $my_time = strtotime ($this_date); //converts date string to UNIX timestamp
   $timestamp = $my_time + ($num_days * 86400); //calculates # of days passed ($num_days) * # seconds in a day (86400)
   $return_date = date("Y-m-d",$timestamp);  //puts the UNIX timestamp back into string format

   return $return_date;//exit function and return string
}//end of function

	/********************************************** 
	 *** Function to display date as DD/MM/YYYY ***
	 **********************************************/
	function get_datediff($dtmDate1,$dtmDate2){
		$year1 = substr($dtmDate1, 0, 4); // returns YYYY
		$month1 = substr($dtmDate1, 5, 2); // returns MM
		$day1 = substr($dtmDate1, 8, 2); // returns DD

		$year2 = substr($dtmDate2, 0, 4); // returns YYYY
		$month2 = substr($dtmDate2, 5, 2); // returns MM
		$day2 = substr($dtmDate2, 8, 2); // returns DD

		$d1=mktime(0,0,0,$month1,$day1,$year1);
		$d2=mktime(0,0,0,$month2,$day2,$year2);
		
		$ddiff = floor(($d2-$d1)/86400);


		return $ddiff+1;
	}

	function SelDateDisp($dtmDate){
		$year = substr($dtmDate, 0, 4); // returns YYYY
		$month = substr($dtmDate, 5, 2); // returns MM
		$day = substr($dtmDate, 8, 2); // returns DD
		if($day == '00' || $day == ''){
			$dtmDate = '';
		}else{			
			$dtmDate = $day." ".viewdate($month)." ".$year;
		}
		return $dtmDate;
	}

function viewdate($month)  { // to show month in Bahasa
//		if($bahasa=='BM'){	  
            switch($month) {
				case '01' : $m = 'Januari'; break;
				case '02' : $m = 'Februari'; break;
				case '03' : $m = 'Mac'; break; 
				case '04' : $m = 'April'; break; 
				case '05' : $m = 'Mei'; break; 
				case '06' : $m = 'Jun'; break;
				case '07' : $m = 'Julai'; break;
				case '08' : $m = 'Ogos'; break;
				case '09' : $m = 'September'; break;
				case '10' : $m = 'Oktober'; break;
				case '11' : $m = 'November'; break;
				case '12' : $m = 'Disember'; break;
            }  return $m;
/*		 } else {
            switch($month) {
				case '01' : $m = 'January'; break;
				case '02' : $m = 'February'; break;
				case '03' : $m = 'March'; break; 
				case '04' : $m = 'April'; break; 
				case '05' : $m = 'May'; break; 
				case '06' : $m = 'June'; break;
				case '07' : $m = 'July'; break;
				case '08' : $m = 'August'; break;
				case '09' : $m = 'September'; break;
				case '10' : $m = 'October'; break;
				case '11' : $m = 'November'; break;
				case '12' : $m = 'Disember'; break;
		 }
			return $m;
		}
*/
      }  // end of show month
	  
function get_date_diff($date1, $date2) { 
	$holidays = 0; $hol=0;
	if(!empty($date1) && !empty($date2)){
		for ($day = $date2; $day < $date1; $day += 24 * 3600) { 
			$day_of_week = date('N', $day); 
			if($day_of_week > 5) { 
				$holidays++; 
			} 
		} 
		$hol = $holidays * 24 * 3600;
		//print $holidays."/".$hol."/".$date1."/".$date2;
		return number_format(($date1 - $date2 - $hol)/(24*3600),0); 
	} else {
		return 0;
	}
} 
?>