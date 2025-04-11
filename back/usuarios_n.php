<?php
include('../configuracion/conexionMysqli.php');

$users = [];
$stmt = mysqli_prepare($conexion, "SELECT dato1 FROM `sist_usuarios` WHERE nivel = 3");
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		array_push($users, $row['dato1']);
	}
}
$stmt->close();


$pass = '$2y$10$EyP1MOY39kuw4uREdk7ao.UUzQ10YNIZ95IZLM70MUPo5J6YzEBVG';
$darmode = '0';
$nivel = '3';

$stmt_o = $conexion->prepare("INSERT INTO sist_usuarios (dato1, dato2, usuario, nivel, contrasena, darkMode) VALUES (?, ?, ?, ?, ?, ?)");


$count = 0;

$stmt = mysqli_prepare($conexion, "SELECT id_consejo FROM `local_comunidades`");
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$dato1 = $row['id_consejo'];

		if (!in_array($row['id_consejo'], $users)) {
			$stmt_o->bind_param("ssssss", $dato1, $dato1, $dato1, $nivel, $pass, $darmode);
			$stmt_o->execute();
		}
	}
}
$stmt->close();

echo $count;






/*
Aquí estoy, esperando que cambie el mundo
Todos tan nerviosos hoy
Que se calmen los ánimos un segundo
Todos temblorosos hoy
Pero no hay un refugio adonde correr
Ni una voz transparente en la que creer
Y para colmo, aguantar la publicidad
Del tipo que se ríe mientras comen flan
Conflictos, problemas, disputas, peleas
Historias que nacen en crisis y guerras
Tormentas sin nombre que crecen y fluyen
No son huracanes, pero igual destruyen
Días, testigos de la hipocresía
De líderes falsos que se creen mesías
Mariposas que olvidan que fueron gusanos
Esto es más turbio que Pollos Hermanos
Está picante afuera (eh)
Está caliente afuera (sí)
Está tan duro afuera que hasta el más indiferente
Puede arder en esa hoguera
Dicen que mi paranoia afecta a mi salud
Y que nada es real hasta que sale en YouTube
Y es que todo es tan endeble y tan fugaz
Qué poco aprendemos de los tiempos de paz
Aquí estoy, esperando que cambie el mundo
Todos tan nerviosos hoy
Que se calmen los ánimos un segundo
Todos temblorosos hoy
Pero no hay un refugio adonde correr
Ni una voz transparente en la que creer
Y para colmo, aguantar la publicidad
Del tipo que se ríe mientras comen flan
Insultos, sirenas, alarmas que suenan
Todo se discute, nada se argumenta
Gente que puso un imán en su brújula
Gente que grita escribiendo en mayúscula
Irremplazables seres esenciales
Insustituibles, indispensables
Creyéndose reyes de un frágil imperio
De imprescindibles está lleno el cementerio
Está picante afuera (eh)
Está caliente afuera (sí)
Está tan cruel afuera y hay tanta tensión
Como en la más brutal de las fronteras
Recuerdo cuando no sabía que era feliz
Aunque la felicidad no deja cicatriz
No hay escala ni regla que mida el dolor
Solo el cerdo sabe cuánto vale el jamón
Ideales frágiles en días temblorosos
Con destinos inciertos y temerosos
Personajes blandos que se muestran tan valientes
Con principios tambaleantes, tan campantes
Paradigmas inestables de figuras inseguras
Que se juntan en un clan, pero no hay plan
La vida resultó tan parecida
Pero un poco más amarga que ese flan
Flan
Flan
Aquí estoy, esperando que cambie el mundo
Todos tan nerviosos hoy
Que se calmen los ánimos un segundo
Todos temblorosos hoy
Pero no hay un refugio adonde correr
Ni una voz transparente en la que creer
Y para colmo aguantar la publicidad
Del tipo que se ríe, del tipo que se ríe
Del tipo que se ríe mientras comen flan
*/