<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Conversor de coordenadas</title>
<script src="js/UtmWgs.js"></script>


<script>


////////////////////////////////////// noClick de UTM a geograficas /////////////////////////
	function cmdUTM2Lat_click(este, norte){

       latlon = new Array(2);
        var x, y, zone, southhemi;

        x = parseFloat (este);
        y = parseFloat (norte);
      
        zone = 19;
        southhemi = false;

        UTMXYToLatLon (x, y, zone, southhemi, latlon);

        var longLat = RadToDeg (latlon[1]) +  ', ' + RadToDeg (latlon[0]);

        return longLat;
	}







////////////////////////////////////// noClick de UTM a geograficas /////////////////////////

</script>

</head>

<?php 

$coorde = '<script>document.write(cmdUTM2Lat_click(655428.1092, 627093.0458))</script>';
echo $coorde;

?>

</html>




















