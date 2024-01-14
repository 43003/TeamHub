<?php
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

	/********************************************** 
	 *** Function to display date as DD/MM/YYYY ***
	 **********************************************/
	function DisplayMasa($dtmDate){
		$masa = substr($dtmDate, 11, 8); // returns YYYY
		return $masa;
	}

	/********************************************** 
	 *** Function to display date as DD/MM/YYYY ***
	 **********************************************/
	function DisplayTime($dtmDate){
		$masa = substr($dtmDate, 11, 8); // returns YYYY
		return $masa;
	}
	function DispTime($dtmDate){
		$masa = substr($dtmDate, 11, 8); // returns YYYY
		return $masa;
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
	
	function DisplayDateF($dtmDate){
		$year = substr($dtmDate, 0, 4); // returns YYYY
		$month = substr($dtmDate, 5, 2); // returns MM
		$day = substr($dtmDate, 8, 2); // returns DD
		if($day == '00' || $day == ''){
			$dtmDate = '';
		}else{			
			$dtmDate = $day." ". month($month)." ".$year;
		}
		return $dtmDate;
	}

	function DisplayDateE($dtmDate, $bahasa){
		$year = substr($dtmDate, 0, 4); // returns YYYY
		$month = substr($dtmDate, 5, 2); // returns MM
		$day = substr($dtmDate, 8, 2); // returns DD
		if($day == '00' || $day == ''){
			$dtmDate = '';
		}else{			
			$dtmDate = $day." ". viewmonth($month, $bahasa)." ".$year;
		}
		return $dtmDate;
	}

	/**
	 * Returns the number of week in a month for the specified date.
	 *
	 * @param string $date
	 * @return int
	 */
	function weekOfMonth($date) {
	    // estract date parts
	    list($y, $m, $d) = explode('-', date('Y-m-d', strtotime($date)));
	    
	    // current week, min 1
	    $w = 1;
	    
	    // for each day since the start of the month
	    for ($i = 1; $i < $d; ++$i) {
	        // if that day was a sunday and is not the first day of month
	        if ($i > 1 && date('w', strtotime("$y-$m-$i")) == 0) {
	            // increment current week
	            ++$w;
	        }
	    }
	    
	    // now return
	    return $w;
	}

	function month($mth){
		if($mth=='01'){ $month_d = "JANUARI"; }
		else if($mth=='02'){ $month_d = "FEBRUARI"; }
		else if($mth=='03'){ $month_d = "MAC"; }
		else if($mth=='04'){ $month_d = "APRIL"; }
		else if($mth=='05'){ $month_d = "MEI"; }
		else if($mth=='06'){ $month_d = "JUN"; }
		else if($mth=='07'){ $month_d = "JULAI"; }
		else if($mth=='08'){ $month_d = "OGOS"; }
		else if($mth=='09'){ $month_d = "SEPTEMBER"; }
		else if($mth=='10'){ $month_d = "OKTOBER"; }
		else if($mth=='11'){ $month_d = "NOVEMBER"; }
		else if($mth=='12'){ $month_d = "DISEMBER"; }
		
		return $month_d;
	}

	function get_hari($days){
		if($days=='Sun'){ $nama_hari = "Ahad"; }
		else if($days=='Mon'){ $nama_hari = "Isnin"; }
		else if($days=='Tue'){ $nama_hari = "Selasa"; }
		else if($days=='Wed'){ $nama_hari = "Rabu"; }
		else if($days=='Thur'){ $nama_hari = "Khamis"; }
		else if($days=='Fri'){ $nama_hari = "Jumaat"; }
		else if($days=='Sat'){ $nama_hari = "Sabtu"; }
		return $nama_hari;
	}



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

	function get_yeardiff($dtmDate1,$dtmDate2){
		$year1 = substr($dtmDate1, 0, 4); // returns YYYY
		$month1 = substr($dtmDate1, 5, 2); // returns MM
		$day1 = substr($dtmDate1, 8, 2); // returns DD

		$year2 = substr($dtmDate2, 0, 4); // returns YYYY
		$month2 = substr($dtmDate2, 5, 2); // returns MM
		$day2 = substr($dtmDate2, 8, 2); // returns DD

		$d1=mktime(0,0,0,$month1,$day1,$year1);
		$d2=mktime(0,0,0,$month2,$day2,$year2);
		
		$ddiff = floor((($d2-$d1)/86400)/365);


		return $ddiff;
	}
	
	function get_ages($birthDate){
		//date in mm/dd/yyyy format; or it can be in other formats as well
		$birthDate = DisplayDate($birthDate); //"12/17/1983";
		//explode the date to get month, day and year
		$birthDate = explode("/", $birthDate);
		//get age from date or birthdate
		$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")?((date("Y")-$birthDate[2])-1):(date("Y") - $birthDate[2]));
		//echo "Age is:" . $age;
		return $age;
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

	function viewmonth($month, $bahasa)  {
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

?>