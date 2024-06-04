<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


</head>

<body>
    <input type="text" name="busqueda" id="busqueda">
    <section id="poligonoResultado"></section>
</body>

<script src="js/jquery.min.js"></script>
<script>
  

    var miArray = new Array() 
        miArray['diabeticos'] = 'diabetes="si"' 
        miArray['diabeticas'] = 'diabetes="si"' 
        miArray['diabetico'] = 'diabetes="si"'
        miArray['diabetica'] = 'diabetes="si"' 
        miArray['diabetes'] = 'diabetes="si"' 
        miArray['mujeres'] = 'sexo="f"' 
        miArray['mujer'] = 'sexo="f"' 




function delay(callback, ms) {
  var timer = 0;
  return function() {
    var context = this, args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function () {
      callback.apply(context, args);
    }, ms || 0);
  };
}



$('#busqueda').keyup(delay(function (e) {
  realizarBusqueda(this.value);
}, 1000));




function realizarBusqueda(valor) {
    var consulta = '';

    var valorBuscado = valor
    var palabras = valorBuscado.split(' ');

    palabras.forEach(element => {
        if (miArray[element] == undefined) {
            alert('no existe')                
        }else{
            consulta = consulta.concat(miArray[element] + " AND ")
        }

    });
    const resultado = consulta.substring(0, consulta.length - 5);
    alert(resultado)

}

</script>

</html>