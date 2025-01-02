<?php
class Libunsripenjadwalan {

  function haversineGreatCircleDistance(
    $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
  {
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
      cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    return $angle * $earthRadius;
  }

  function vincentyGreatCircleDistance(
    $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
  {
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $lonDelta = $lonTo - $lonFrom;
    $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

    $angle = atan2(sqrt($a), $b);
    return $angle * $earthRadius;
  }

  function distance($lat1, $lon1, $lat2, $lon2, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } if ($unit == "M") {
      return ($miles * 1.609344 * 1000);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }


  function getday(){
    $datetime = DateTime::createFromFormat('YmdHi', date('YmdHi'));
    $tanggal = $datetime->format('D');
    $hari = 'Unknown';
    if($tanggal == 'Sun'){
      $hari = 'Minggu';
    } else if($tanggal == 'Mon'){
      $hari = 'Senin';
    } else if($tanggal == 'Tue'){
      $hari = 'Selasa';
    } else if($tanggal == 'Wed'){
      $hari = 'Rabu';
    } else if($tanggal == 'Thu'){
      $hari = 'Kamis';
    } else if($tanggal == 'Fri'){
      $hari = 'Jumat';
    } else if($tanggal == 'Sat'){
      $hari = 'Sabtu';
    } else {
      $hari = 'Unknown';
    }

    return $hari;
  }

  function getColorBarang($val){
    $color = '';
    if($val == 'Baik'){
      $color = 'success';
    } else if($val == 'Sedang'){
      $color = 'info';
    } else {
      $color = 'danger';
    }

    return $color;
  }


  function getColorJadwal($jadwal,$ruang){
    $color = '';

    if($ruang == 'Rusak'){
      $color = 'danger';
    } else {
      if($jadwal == 'Terisi'){
        $color = 'warning-1';
      } else if($jadwal == 'Terpakai'){
        $color = 'success';
      } else {
        $color = '';
      }
    }
    return $color;
  }


  function hoursToMinutes($hours) 
  { 
    if(isset($hours)){
      $minutes = 0; 
      if (strpos($hours, ':') !== false) 
      { 
        list($hours, $minutes) = explode(':', $hours); 
      } 
      return ((($hours - 8) * 60 + $minutes) / 10 * 2)+1; 
    } else {
      return 0;
    }
  } 

  function minutesToHours($minutes) 
  { 
    $hours = (int)($minutes / 60); 
    $minutes -= $hours * 60; 
    return sprintf("%d:%02.0f", $hours, $minutes); 
  }  

  function roundUpToAny($n,$x=5) {
    return (round($n)%$x === 0) ? round($n) : round(($n+$x/2)/$x)*$x;
  }

}
?>