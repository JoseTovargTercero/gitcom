
    
	<script>
	var miArray = new Array()

		
    /*===================================================
                     Consulta a las casas        
    ===================================================*/
		miArray['viviendas'] = ['id!=""', 'casas']
		miArray['viviendas inhabitadas'] = ['agua_potable=""', 'casas']
		miArray['viviendas habitadas'] = ['agua_potable!=""', 'casas']

		miArray['casas'] = ['tipo="Casa"', 'casas']
		miArray['ranchos'] = ['tipo="Rancho"', 'casas']
		miArray['piezas'] = ['tipo="Edificio"', 'casas']
		miArray['edificios'] = ['tipo="Edificio"', 'casas']
		//Tipos de casas

		miArray['propias'] = ['condicion_vivienda="Propia"', 'casas']
		miArray['viviendas propias'] = ['condicion_vivienda="Propia"', 'casas']
		miArray['casas propias'] = ['condicion_vivienda="Propia"', 'casas']
		miArray['alquilados'] = ['condicion_vivienda="Alquilada"', 'casas']
		miArray['viviendas alquiladas'] = ['condicion_vivienda="Alquilada"', 'casas']
		miArray['casas alquiladas'] = ['condicion_vivienda="Alquilada"', 'casas']
		miArray['casas prestada'] = ['condicion_vivienda="Prestada"', 'casas']
		miArray['viviendas prestada'] = ['condicion_vivienda="Prestada"', 'casas']
		miArray['recidencias'] = ['condicion_vivienda="residencias"', 'casas']
		miArray['invadidas'] = ['condicion_vivienda="Invadida"', 'casas']
		miArray['viviendas invadidas'] = ['condicion_vivienda="Invadida"', 'casas']
		miArray['casas invadidas'] = ['condicion_vivienda="Invadida"', 'casas']
		miArray['arrimados'] = ['condicion_vivienda="Arrimados"', 'casas']
		miArray['arrimadas'] = ['condicion_vivienda="Arrimados"', 'casas']
		miArray['arrimada'] = ['condicion_vivienda="Arrimados"', 'casas']
		miArray['personas arrimadas'] = ['condicion_vivienda="Arrimados"', 'casas']
		miArray['familias arrimadas'] = ['condicion_vivienda="Arrimados"', 'casas']
		//Condicion de propiedad
		
		miArray['habitada'] = ['habitat="habitada"', 'casas']
		miArray['habitadas'] = ['habitat="habitada"', 'casas']
		miArray['viviendas habitadas'] = ['habitat="habitada"', 'casas']
		miArray['casas habitadas'] = ['habitat="habitada"', 'casas']
		miArray['inhabitadas'] = ['habitat="no_habitada"', 'casas']
		miArray['inhabitada'] = ['habitat="no_habitada"', 'casas']
		miArray['viviendas inhabitada'] = ['habitat="no_habitada"', 'casas']
		miArray['casas inhabitada'] = ['habitat="no_habitada"', 'casas']
		//Estado de la propiedad

		miArray['riesgo de inundacion'] = ['zonaRiesgo="inundacion"', 'casas']
		miArray['riesgo inundacion'] = ['zonaRiesgo="inundacion"', 'casas']
		miArray['inundacion'] = ['zonaRiesgo="inundacion"', 'casas']
		miArray['riesgo de derrumbe'] = ['zonaRiesgo="derrumbe"', 'casas']
		miArray['riesgo derrumbe'] = ['zonaRiesgo="derrumbe"', 'casas']
		miArray['derrumbe'] = ['zonaRiesgo="derrumbe"', 'casas']
		miArray['riesgo de incendio'] = ['zonaRiesgo="incendio"', 'casas']
		miArray['riesgo incendio'] = ['zonaRiesgo="incendio"', 'casas']
		miArray['incendio'] = ['zonaRiesgo="incendio"', 'casas']
		//Zonas de Riesgo

		miArray['terreno nacional'] = ['tenencia_tierra="Nacional (INTI)"', 'casas']
		miArray['terrenos nacionales'] = ['tenencia_tierra="Nacional (INTI)"', 'casas']
		miArray['terreno inti'] = ['tenencia_tierra="Nacional (INTI)"', 'casas']
		miArray['terrenos inti'] = ['tenencia_tierra="Nacional (INTI)"', 'casas']
		miArray['terreno del inti'] = ['tenencia_tierra="Nacional (INTI)"', 'casas']
		miArray['terrenos del inti'] = ['tenencia_tierra="Nacional (INTI)"', 'casas']
		miArray['tierra del inti'] = ['tenencia_tierra="Nacional (INTI)"', 'casas']
		miArray['tierras del inti'] = ['tenencia_tierra="Nacional (INTI)"', 'casas']
		miArray['tierra nacional'] = ['tenencia_tierra="Nacional (INTI)"', 'casas']
		miArray['tierras nacional'] = ['tenencia_tierra="Nacional (INTI)"', 'casas']
		miArray['terreno que pertenece al inti'] = ['tenencia_tierra="Nacional (INTI)"', 'casas']
		miArray['terrenos que pertenece al inti'] = ['tenencia_tierra="Nacional (INTI)"', 'casas']
		miArray['terrenos que pertenece al inti'] = ['tenencia_tierra="Nacional (INTI)"', 'casas']
		miArray['tierra regional'] = ['tenencia_tierra="Regional (INTU"', 'casas']
		miArray['terreno regional'] = ['tenencia_tierra="Regional (INTU"', 'casas']
		miArray['terreno del intu'] = ['tenencia_tierra="Regional (INTU"', 'casas']
		miArray['terrenos del intu'] = ['tenencia_tierra="Regional (INTU"', 'casas']
		miArray['tierra del intu'] = ['tenencia_tierra="Regional (INTU"', 'casas']
		miArray['tierras del intu'] = ['tenencia_tierra="Regional (INTU"', 'casas']
		miArray['terreno que pertenece al intu'] = ['tenencia_tierra="Regional (INTU"', 'casas']
		miArray['terrenos que pertenece al intu'] = ['tenencia_tierra="Regional (INTU"', 'casas']
		miArray['terreno que pertenece a ejido'] = ['tenencia_tierra="Municipal (EJIDO)"', 'casas']
		miArray['terrenos que pertenecen a ejido'] = ['tenencia_tierra="Municipal (EJIDO)"', 'casas']
		miArray['terreno ejido'] = ['tenencia_tierra="Municipal (EJIDO)"', 'casas']
		miArray['terrenos ejido'] = ['tenencia_tierra="Municipal (EJIDO)"', 'casas']
		miArray['tierras de ejido'] = ['tenencia_tierra="Municipal (EJIDO)"', 'casas']
		miArray['terrenos de ejido'] = ['tenencia_tierra="Municipal (EJIDO)"', 'casas']
		miArray['terrenos municipales'] = ['tenencia_tierra="Municipal (EJIDO)"', 'casas']
		miArray['tierras municipales'] = ['tenencia_tierra="Municipal (EJIDO)"', 'casas']
		//Tenencia de la tierra
		
		miArray['vivienda venezuela'] = ['vivienda_venezuela="Si"', 'casas']
		miArray['beneficiarios de vivienda venezuela'] = ['vivienda_venezuela="Si"', 'casas']
		miArray['beneficiarios de vv'] = ['vivienda_venezuela="Si"', 'casas']
		miArray['beneficiarios de la mision_vivienda_venezuela'] = ['vivienda_venezuela="Si"', 'casas']
		miArray['beneficiarios de gmvv'] = ['vivienda_venezuela="Si"', 'casas']
		miArray['sin beneficios de vivienda venezuela'] = ['vivienda_venezuela="No"', 'casas']
		miArray['sin beneficios de vv'] = ['vivienda_venezuela="No"', 'casas']
		miArray['sin beneficios de la mision_vivienda_venezuela'] = ['vivienda_venezuela="No"', 'casas']
		miArray['sin beneficios de gmvv'] = ['vivienda_venezuela="No"', 'casas']
		//vivienda venezuela

		miArray['barrio nuevo barrio tricolor'] = ['bnbt="Si"', 'casas']
		miArray['beneficiarios de barrio nuevo barrio tricolor'] = ['bnbt="Si"', 'casas']
		miArray['beneficiarios de bnbt'] = ['bnbt="Si"', 'casas']
		miArray['beneficiarios de barrio nuevo barrio tricolor'] = ['bnbt="Si"', 'casas']
		miArray['sin beneficios de barrio nuevo barrio tricolor'] = ['bnbt="No"', 'casas']
		miArray['sin barrio nuevo barrio tricolor'] = ['bnbt="No"', 'casas']
		miArray['sin beneficios de bnbt'] = ['bnbt="No"', 'casas']
		//bnbt

		miArray['sen'] = ['agua_potable="Pozo"', 'casas']
		miArray['agua por pozo'] = ['agua_potable="Pozo"', 'casas']
		miArray['casas con pozo'] = ['agua_potable="Pozo"', 'casas']
		miArray['casas con pozos'] = ['agua_potable="Pozo"', 'casas']
		miArray['casa con pozos'] = ['agua_potable="Pozo"', 'casas']
		miArray['casa con pozo'] = ['agua_potable="Pozo"', 'casas']
		miArray['casas con agua por pozo'] = ['agua_potable="Pozo"', 'casas']
		miArray['pozo'] = ['agua_potable="Pozo"', 'casas']
		miArray['pozos'] = ['agua_potable="Pozo"', 'casas']
		miArray['casas con agua por pozos'] = ['agua_potable="Pozo"', 'casas']
		miArray['agua por tuberia'] = ['agua_potable="Tuberia"', 'casas']
		miArray['agua por tuberias'] = ['agua_potable="Tuberia"', 'casas']
		miArray['casas con tuberia'] = ['agua_potable="Tuberia"', 'casas']
		miArray['casas con tuberias'] = ['agua_potable="Tuberia"', 'casas']
		miArray['casa con tuberias'] = ['agua_potable="Tuberia"', 'casas']
		miArray['casas con agua por tuberia'] = ['agua_potable="Tuberia"', 'casas']
		miArray['casas con agua por tuberias'] = ['agua_potable="Tuberia"', 'casas']
		miArray['tuberia'] = ['agua_potable="Tuberia"', 'casas']
		miArray['tuberias'] = ['agua_potable="Tuberia"', 'casas']
		miArray['agua por pozo y tuberia'] = ['agua_potable="Pozo y Tuberia"', 'casas']
		miArray['agua por pozo y tuberias'] = ['agua_potable="Pozo y Tuberia"', 'casas']
		miArray['casas con pozo y tuberia'] = ['agua_potable="Pozo y Tuberia"', 'casas']
		miArray['casas con pozo y tuberias'] = ['agua_potable="Pozo y Tuberia"', 'casas']
		miArray['casa con pozo y tuberia'] = ['agua_potable="Pozo y Tuberia"', 'casas']
		miArray['casa con pozo y tuberias'] = ['agua_potable="Pozo y Tuberia"', 'casas']
		miArray['casas con agua por pozo y tuberias'] = ['agua_potable="Pozo y Tuberia"', 'casas']
		miArray['casas con agua por pozo y tuberia'] = ['agua_potable="Pozo y Tuberia"', 'casas']
		miArray['pozo y tuberias'] = ['agua_potable="Pozo y Tuberia"', 'casas']
		miArray['pozo y tuberia'] = ['agua_potable="Pozo y Tuberia"', 'casas']
		miArray['agua por algibe'] = ['agua_potable="Algibe"', 'casas']
		miArray['agua por algibes'] = ['agua_potable="Algibe"', 'casas']
		miArray['casas con algibe'] = ['agua_potable="Algibe"', 'casas']
		miArray['casas con algibes'] = ['agua_potable="Algibe"', 'casas']
		miArray['casas con agua por algibes'] = ['agua_potable="Algibe"', 'casas']
		miArray['casas con agua por algibe'] = ['agua_potable="Algibe"', 'casas']
		miArray['algibe'] = ['agua_potable="Algibe"', 'casas']
		miArray['algibes'] = ['agua_potable="Algibe"', 'casas']
		miArray['agua por cisterna'] = ['agua_potable="Cisterna"', 'casas']
		miArray['casas con agua por cisterna'] = ['agua_potable="Cisterna"', 'casas']
		miArray['cisterna'] = ['agua_potable="Cisterna"', 'casas']
		miArray['agua del vecino'] = ['agua_potable="Del Vecino"', 'casas']
		miArray['del vecino'] = ['agua_potable="Del Vecino"', 'casas']
		miArray['vecino'] = ['agua_potable="Del Vecino"', 'casas']
		miArray['lluvia'] = ['agua_potable="De la lluvia"', 'casas']
		miArray['rio'] = ['agua_potable="Del Rio"', 'casas']
		miArray['casas sin agua directa'] = ['agua_potable="De la lluvia" OR agua_potable="Del Vecino" OR agua_potable="Del Rio"', 'casas']
		miArray['casas sin acceso al agua de forma directa'] = ['agua_potable="De la lluvia" OR agua_potable="Del Vecino" OR agua_potable="Del Rio"', 'casas']
		miArray['casas sin agua de forma directa'] = ['agua_potable="De la lluvia" OR agua_potable="Del Vecino" OR agua_potable="Del Rio"', 'casas']
		miArray['casas sin agua'] = ['agua_potable="De la lluvia" OR agua_potable="Del Vecino" OR agua_potable="Del Rio"', 'casas']
		miArray['casas sin acceso al agua'] = ['agua_potable="De la lluvia" OR agua_potable="Del Vecino" OR agua_potable="Del Rio"', 'casas']
		miArray['viviendas sin agua directa'] = ['agua_potable="De la lluvia" OR agua_potable="Del Vecino" OR agua_potable="Del Rio"', 'casas']
		miArray['viviendas sin acceso al agua de forma directa'] = ['agua_potable="De la lluvia" OR agua_potable="Del Vecino" OR agua_potable="Del Rio"', 'casas']
		miArray['viviendas sin agua de forma directa'] = ['agua_potable="De la lluvia" OR agua_potable="Del Vecino" OR agua_potable="Del Rio"', 'casas']
		miArray['viviendas sin agua'] = ['agua_potable="De la lluvia" OR agua_potable="Del Vecino" OR agua_potable="Del Rio"', 'casas']
		miArray['viviendas sin acceso al agua'] = ['agua_potable="De la lluvia" OR agua_potable="Del Vecino" OR agua_potable="Del Rio"', 'casas']
		miArray['personas sin acceso al agua'] = ['agua_potable="De la lluvia" OR agua_potable="Del Vecino" OR agua_potable="Del Rio"', 'casas']
		miArray['familias sin acceso al agua'] = ['agua_potable="De la lluvia" OR agua_potable="Del Vecino" OR agua_potable="Del Rio"', 'casas']
		miArray['familias sin agua'] = ['agua_potable="De la lluvia" OR agua_potable="Del Vecino" OR agua_potable="Del Rio"', 'casas']
		//Agua potable

		miArray['internet fijo'] = ['internet="Por Cable (CANTV)"', 'casas']
		miArray['por cantv'] = ['internet="Por Cable (CANTV)"', 'casas']
		miArray['internet via cantv'] = ['internet="Por Cable (CANTV)"', 'casas']
		miArray['internet por cantv'] = ['internet="Por Cable (CANTV)"', 'casas']
		miArray['lineas cantv'] = ['internet="Por Cable (CANTV)"', 'casas']
		miArray['internet via modem'] = ['internet="Modem"', 'casas']
		miArray['internet por modem'] = ['internet="Modem"', 'casas']
		miArray['internet satelital'] = ['internet="Satelital"', 'casas']
		miArray['internet por satelite'] = ['internet="Satelital"', 'casas']
		miArray['sin internet'] = ['internet="Sin Servicio"', 'casas']
		//Internet

		miArray['aseo'] = ['disposicion_basura="Servicio de Recoleccion"', 'casas']
		miArray['aseo urbano'] = ['disposicion_basura="Servicio de Recoleccion"', 'casas']
		miArray['entierro'] = ['disposicion_basura="Entierro"', 'casas']
		miArray['por entierro'] = ['disposicion_basura="Entierro"', 'casas']
		miArray['entierran la basura'] = ['disposicion_basura="Entierro"', 'casas']
		miArray['lugares donde entierran la basura'] = ['disposicion_basura="Entierro"', 'casas']
		miArray['casas donde entierran la basura'] = ['disposicion_basura="Entierro"', 'casas']
		miArray['casas que entierran la basura'] = ['disposicion_basura="Entierro"', 'casas']
		miArray['personas que entierran la basura'] = ['disposicion_basura="Entierro"', 'casas']
		miArray['personas que queman la basura'] = ['disposicion_basura="Quema"', 'casas']
		miArray['personas que queman'] = ['disposicion_basura="Quema"', 'casas']
		miArray['casas que queman la basura'] = ['disposicion_basura="Quema"', 'casas']
		miArray['casas que queman'] = ['disposicion_basura="Quema"', 'casas']
		miArray['casas donde queman'] = ['disposicion_basura="Quema"', 'casas']
		miArray['casas donde queman la basura'] = ['disposicion_basura="Quema"', 'casas']
		miArray['casas donde queman'] = ['disposicion_basura="Quema"', 'casas']
		miArray['casas en donde queman la basura'] = ['disposicion_basura="Quema"', 'casas']
		miArray['casas en donde queman'] = ['disposicion_basura="Quema"', 'casas']
		miArray['quema'] = ['disposicion_basura="Quema"', 'casas']
		miArray['basura al aire libre'] = ['disposicion_basura="Al Aire Libre"', 'casas']
		miArray['casas donde dejan la basura al aire libre'] = ['disposicion_basura="Al Aire Libre"', 'casas']
		miArray['casas en donde dejan la basura al aire libre'] = ['disposicion_basura="Al Aire Libre"', 'casas']
		miArray['casas en donde dejan la basura en las calles'] = ['disposicion_basura="Al Aire Libre"', 'casas']
		miArray['personas que dejan la basura en las calles'] = ['disposicion_basura="Al Aire Libre"', 'casas']
		miArray['personas que dejan la basura al aire libre'] = ['disposicion_basura="Al Aire Libre"', 'casas']
		//Disposicion de la basura

		miArray['pozo septico'] = ['agua_servidas="Pozo Septico"', 'casas']
		miArray['pozos septico'] = ['agua_servidas="Pozo Septico"', 'casas']
		miArray['pozos septicos'] = ['agua_servidas="Pozo Septico"', 'casas']
		miArray['pozo septicos'] = ['agua_servidas="Pozo Septico"', 'casas']
		miArray['casas con pozo septico'] = ['agua_servidas="Pozo Septico"', 'casas']
		miArray['casas con pozos septicos'] = ['agua_servidas="Pozo Septico"', 'casas']

		miArray['cloacas'] = ['agua_servidas="Cloacas"', 'casas']
		miArray['cloaca'] = ['agua_servidas="Cloacas"', 'casas']
		miArray['casas con cloacas'] = ['agua_servidas="Cloacas"', 'casas']
		miArray['casas con cloaca'] = ['agua_servidas="Cloacas"', 'casas']
		miArray['casas con sistema de cloaca'] = ['agua_servidas="Cloacas"', 'casas']
		miArray['aguas servidas por cloaca'] = ['agua_servidas="Cloacas"', 'casas']
		miArray['aguas servidas por cloacas'] = ['agua_servidas="Cloacas"', 'casas']

		miArray['aguas servidas al aire libre'] = ['agua_servidas="Al Aire Libre"', 'casas']
		miArray['casas con aguas servidas al aire libre'] = ['agua_servidas="Al Aire Libre"', 'casas']
		miArray['casas que dejan las aguas servidas al aire libre'] = ['agua_servidas="Al Aire Libre"', 'casas']
		miArray['casas que dejan aguas servidas al aire libre'] = ['agua_servidas="Al Aire Libre"', 'casas']
		miArray['casas donde se derraman las aguas servidas'] = ['agua_servidas="Al Aire Libre"', 'casas']
		//aguas servidas al aire libre
		
		miArray['casas con contrato electrico'] = ['electricidad="Con Contrato"', 'casas']
		miArray['contrato electrico'] = ['electricidad="Con Contrato"', 'casas']
		miArray['casas con contrato'] = ['electricidad="Con Contrato"', 'casas']
		miArray['contrato'] = ['electricidad="Con Contrato"', 'casas']
		miArray['casas sin contrato'] = ['electricidad="Sin Contrato"', 'casas']
		miArray['sin contrato'] = ['electricidad="Sin Contrato"', 'casas']
		miArray['casas sin contrato electrico'] = ['electricidad="Sin Contrato"', 'casas']
		miArray['sin contrato electrico'] = ['electricidad="Sin Contrato"', 'casas']
		miArray['casas sin electricidad'] = ['electricidad="Sin Electricidad"', 'casas']
		miArray['casas con electricidad'] = ['electricidad="Con Contrato" OR electricidad="Sin Contrato"', 'casas']
		//electricidad
		
		miArray['medidor electrico en funcionamiento'] = ['medidor_electricidad="En Funcionamiento"', 'casas']
		miArray['casas con medidor electrico en funcionamiento'] = ['medidor_electricidad="En Funcionamiento"', 'casas']
		miArray['casas con medidor en funcionamiente'] = ['medidor_electricidad="En Funcionamiento"', 'casas']
		miArray['casas con medidor electrico dañado'] = ['medidor_electricidad="Danado"', 'casas']
		miArray['medidor electrico'] = ['medidor_electricidad="Danado" OR medidor_electricidad="En Funcionamiento"', 'casas']
		miArray['casas con medidor electrico'] = ['medidor_electricidad="Danado" OR medidor_electricidad="En Funcionamiento"', 'casas']
		miArray['medidor electrico'] = ['medidor_electricidad="Danado" OR medidor_electricidad="En Funcionamiento"', 'casas']
		miArray['casas sin medidor electrico'] = ['medidor_electricidad="No Posee"', 'casas']
		//medidor

		miArray['telefonia fuera de servicio'] = ['telofonia="Telefonia Fija (Fuera de Servicio)"', 'casas']

			
		/*===================================================
                     Consulta a las casas        
    	===================================================*/
	
		//miArray['solo bombonas pequenas'] = ['bombona_pequena!="0" AND bombona_mediana="0" AND bombona_grande="0"', 'personas']
		//miArray['sin_bombonas'] = ['bombona_pequena="0" AND bombona_mediana="0" AND bombona_grande="0"', 'personas']
		//miArray['sin bombonas'] = ['bombona_pequena!="0" AND bombona_mediana!="0" AND bombona_grande!="0"', 'casas']
		
		
		miArray['bombonas pequeñas'] = ['bombona_pequena!="0"/bombona_pequena', 'personas']
		miArray['bombonas medianas'] = ['bombona_mediana!="0"/bombona_mediana', 'personas']
		miArray['bombonas grandes'] = ['bombona_grande!="0"/bombona_grande', 'personas']
		
		miArray['una bombona pequeña'] = ['bombona_pequena="1"', 'personas']
		miArray['una bombona mediana'] = ['bombona_mediana="1"', 'personas']
		miArray['una bombona grande'] = ['bombona_grande="1"', 'personas']

		miArray['mas de una bombona pequeña'] = ['bombona_pequena>=2', 'personas']
		miArray['mas de una bombona mediana'] = ['bombona_mediana>=2', 'personas']
		miArray['mas de una bombona granda'] = ['bombona_grande>=2', 'personas']

		miArray['mas de dos bombonas pequeñas'] = ['bombona_pequena>=3', 'personas']
		miArray['mas de dos bombonas medianas'] = ['bombona_mediana>=3', 'personas']
		miArray['mas de dos bombonas grandes'] = ['bombona_grande>=3', 'personas']
		
		miArray['mas de tres bombonas pequeñas'] = ['bombona_pequena>=4', 'personas']
		miArray['mas de tres bombonas medianas'] = ['bombona_mediana>=4', 'personas']
		miArray['mas de tres bombonas grandes'] = ['bombona_grande>=4', 'personas']
		



		/**ojo */


		miArray['mta'] = ['mesa_tecnica_agua="SI"', 'personas']
		miArray['bus'] = ['movilizacion="Bus"', 'personas']
		


		miArray['jgh'] = ['recibe_bono_jose_g="SI"', 'personas']



		miArray['fisica'] = ['discapacidad="Fisica"', 'personas']
		miArray['auditiva'] = ['discapacidad="Auditiva"', 'personas']
		miArray['visual'] = ['discapacidad="Visual"', 'personas']
		miArray['vohabla'] = ['discapacidad="Vohabla"', 'personas']
		miArray['intelectual'] = ['discapacidad="Intelectual"', 'personas']
		miArray['mental'] = ['discapacidad="Mental"', 'personas']
		miArray['autismo'] = ['discapacidad="Autismo o Asperger"', 'personas']
		miArray['enfermos'] = ['diabetico="SI" OR enf_cardiaca="SI" OR artritis="SI" OR epilepsia="SI"', 'personas']

		miArray['parto humanizado'] = ['parto_humanizado="SI"', 'personas']
		miArray['embarazadas'] = ['embarazada="SI"', 'personas']
		miArray['embarazadas de alto riesgo'] = ['embarazada_alto_riesgo="SI"', 'personas']
		miArray['no pensionados'] = ['pension="NO"', 'personas']
		miArray['pensionados'] = ['pension="SI"', 'personas']
		
		miArray['patrios productivos'] = ['actividad_agricola="Patio Productivo"', 'personas']
		miArray['conucos'] = ['actividad_agricola="conuco25"', 'personas']
		miArray['cria de animales de consumo'] = ['actividad_agricola="Cria de Animales de Consumo"', 'personas']

		/* Dimension social 
		sexo
		edad
		educacion
		profesion
		ocupacion
		combo alimenticio
		*/

		/** ojo */
		miArray['personas con discapacidad'] = ['discapacidad="Fisica" OR discapacidad="Auditiva" OR discapacidad="Visual" OR discapacidad="Vohabla" OR discapacidad="Intelectual" OR discapacidad="Mental" OR discapacidad="Autismo o Asperger" OR ', 'personas']
		
		miArray['mujeres'] = ['sexo="Femenino"', 'personas']
		miArray['femenino'] = ['sexo="Femenino"', 'personas']
		miArray['feminas'] = ['sexo="Femenino"', 'personas']
		miArray['féminas'] = ['sexo="Femenino"', 'personas']
		miArray['sexo femenino'] = ['sexo="Femenino"', 'personas']
		miArray['mujer'] = ['sexo="Femenino"', 'personas']
		miArray['hombre'] = ['sexo="Masculino"', 'personas']
		miArray['hombres'] = ['sexo="Masculino"', 'personas']
		miArray['sexo masculinos'] = ['sexo="Masculino"', 'personas']
		/** Sexo */

		miArray['clap'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['habitantes atentidos por el clap'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['personas atentidas por el clap'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['combo clap'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['bolsa clap'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['bolsa'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['alimentos'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['alimentos clap'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['personas que reciben bolsa clap'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['habitantes que reciben bolsa clap'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['habitantes que reciben la bolsa clap'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['personas que reciben la bolsa clap'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['habitantes que reciben el combo clap'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['personas que reciben el combo clap'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['habitantes que reciben el combo alimenticio clap'] = ['combo_alimenticio_clap="SI"', 'personas']
		miArray['personas que reciben el combo alimenticio clap'] = ['combo_alimenticio_clap="SI"', 'personas']
		
		/** Combo clap */
		
		
		miArray['hombres que reciben el combo alimenticio clap'] = ['combo_alimenticio_clap="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que reciben el combo clap'] = ['combo_alimenticio_clap="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres atentidos por el clap'] = ['combo_alimenticio_clap="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que reciben bolsa clap'] = ['combo_alimenticio_clap="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que reciben la bolsa clap'] = ['combo_alimenticio_clap="SI" AND sexo="Masculino"', 'personas']
		
		/** Combo clap por sexo masculino*/
		
		
		miArray['mujeres que reciben el combo alimenticio clap'] = ['combo_alimenticio_clap="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que reciben el combo clap'] = ['combo_alimenticio_clap="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres atentidos por el clap'] = ['combo_alimenticio_clap="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que reciben bolsa clap'] = ['combo_alimenticio_clap="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que reciben la bolsa clap'] = ['combo_alimenticio_clap="SI" AND sexo="Femenino"', 'personas']
		
		/** Combo clap por sexo femenino*/
		
		
		miArray['covid'] = ['padecio_covid="SI"', 'personas']
		miArray['covid19'] = ['padecio_covid="SI"', 'personas']
		miArray['covid-19'] = ['padecio_covid="SI"', 'personas']
		miArray['personas que padecieron covid'] = ['padecio_covid="SI"', 'personas']
		miArray['personas que padecieron covid19'] = ['padecio_covid="SI"', 'personas']
		miArray['personas que padecieron covid-19'] = ['padecio_covid="SI"', 'personas']
		miArray['mujeres que padecieron covid'] = ['padecio_covid="SI" AND sexo="Masculino"', 'personas']
		miArray['mujeres que padecieron covid19'] = ['padecio_covid="SI" AND sexo="Masculino"', 'personas']
		miArray['mujeres que padecieron covid-19'] = ['padecio_covid="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que padecieron covid'] = ['padecio_covid="SI" AND sexo="Femenino"', 'personas']
		miArray['hombres que padecieron covid19'] = ['padecio_covid="SI" AND sexo="Femenino"', 'personas']
		miArray['hombres que padecieron covid-19'] = ['padecio_covid="SI" AND sexo="Femenino"', 'personas']
		/** Covid por sexo*/


		miArray['hombres diabeticos'] = ['diabetico="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres con diabetes'] = ['diabetico="SI" AND sexo="Masculino"', 'personas']
		miArray['hombre diabetico'] = ['diabetico="SI" AND sexo="Masculino"', 'personas']
		miArray['mujeres con diabetes'] = ['diabetico="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres diabeticas'] = ['diabetico="SI" AND sexo="Femenino"', 'personas']
		miArray['mujer diabetica'] = ['diabetico="SI" AND sexo="Femenino"', 'personas']
		miArray['diabeticos'] = ['diabetico="SI"', 'personas']
		miArray['diabeticas'] = ['diabetico="SI"', 'personas']
		miArray['personas diabeticas'] = ['diabetico="SI"', 'personas']
		miArray['habitantes diabeticos'] = ['diabetico="SI"', 'personas']
		miArray['personas con diabetes'] = ['diabetico="SI"', 'personas']
		miArray['diabetico'] = ['diabetico="SI"', 'personas']
		miArray['diabetica'] = ['diabetico="SI"', 'personas']
		miArray['diabetes'] = ['diabetico="SI"', 'personas']

		/** Diabetes */

		miArray['personas hipertensas'] = ['hipertenso="SI"', 'personas']
		miArray['personas que padecen de hipertension'] = ['hipertenso="SI"', 'personas']
		miArray['personas que padecen hipertension'] = ['hipertenso="SI"', 'personas']
		miArray['personas que sufren de hipertension'] = ['hipertenso="SI"', 'personas']
		miArray['personas que sufren hipertension'] = ['hipertenso="SI"', 'personas']
		miArray['hipertensos'] = ['hipertenso="SI"', 'personas']
		miArray['hipertension'] = ['hipertenso="SI"', 'personas']

		miArray['hombres hipertensos'] = ['hipertenso="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres con hipertension'] = ['hipertenso="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que padecen hipertension'] = ['hipertenso="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que padecen de hipertension'] = ['hipertenso="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que sufren hipertension'] = ['hipertenso="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que sufren de hipertension'] = ['hipertenso="SI" AND sexo="Masculino"', 'personas']

		miArray['mujeres hipertensas'] = ['hipertenso="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres con hipertension'] = ['hipertenso="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que padecen hipertension'] = ['hipertenso="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que padecen de hipertension'] = ['hipertenso="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que sufren de hipertension'] = ['hipertenso="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que sufren hipertension'] = ['hipertenso="SI" AND sexo="Femenino"', 'personas']

		/* Hipertension */


		miArray['artritis'] = ['artritis="SI"', 'personas']
		miArray['personas con artritis'] = ['artritis="SI"', 'personas']
		miArray['personas que padecen artritis'] = ['artritis="SI"', 'personas']
		miArray['personas que padecen de artritis'] = ['artritis="SI"', 'personas']
		miArray['personas que sufren artritis'] = ['artritis="SI"', 'personas']
		miArray['personas que sufren de artritis'] = ['artritis="SI"', 'personas']

		miArray['hombres con artritis'] = ['artritis="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que padecen artritis'] = ['artritis="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que padecen de artritis'] = ['artritis="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que sufren artritis'] = ['artritis="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que sufren de artritis'] = ['artritis="SI" AND sexo="Masculino"', 'personas']

		miArray['mujeres con artritis'] = ['artritis="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que padecen artritis'] = ['artritis="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que padecen de artritis'] = ['artritis="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que sufren artritis'] = ['artritis="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que sufren de artritis'] = ['artritis="SI" AND sexo="Femenino"', 'personas']
		/* artritis */

		
		miArray['enfermedad cardiaca'] = ['enf_cardiaca="SI"', 'personas']
		miArray['personas con enfermedad cardiaca'] = ['enf_cardiaca="SI"', 'personas']
		miArray['personas que tienen enfermedad cardiaca'] = ['enf_cardiaca="SI"', 'personas']
		miArray['personas que padecen enfermedad cardiaca'] = ['enf_cardiaca="SI"', 'personas']
		miArray['personas que sufren enfermedad cardiaca'] = ['enf_cardiaca="SI"', 'personas']
		miArray['personas que padecen de enfermedad cardiaca'] = ['enf_cardiaca="SI"', 'personas']
		miArray['personas que sufren de enfermedad cardiaca'] = ['enf_cardiaca="SI"', 'personas']

		miArray['hombres con enfermedad cardiaca'] = ['enf_cardiaca="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que tienen enfermedad cardiaca'] = ['enf_cardiaca="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que padecen enfermedad cardiaca'] = ['enf_cardiaca="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que sufren enfermedad cardiaca'] = ['enf_cardiaca="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que padecen de enfermedad cardiaca'] = ['enf_cardiaca="SI" AND sexo="Masculino"', 'personas']
		miArray['hombres que sufren de enfermedad cardiaca'] = ['enf_cardiaca="SI" AND sexo="Masculino"', 'personas']

		miArray['mujeres con enfermedad cardiaca'] = ['enf_cardiaca="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que tienen enfermedad cardiaca'] = ['enf_cardiaca="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que padecen enfermedad cardiaca'] = ['enf_cardiaca="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que sufren enfermedad cardiaca'] = ['enf_cardiaca="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que padecen de enfermedad cardiaca'] = ['enf_cardiaca="SI" AND sexo="Femenino"', 'personas']
		miArray['mujeres que sufren de enfermedad cardiaca'] = ['enf_cardiaca="SI" AND sexo="Femenino"', 'personas']
		
		/* enfermedad cardiaca */
		


		miArray['ets'] = ['ETS="SI"', 'personas']
		miArray['efermedades de tansmision sexual'] = ['ETS="SI"', 'personas']
		miArray['personas con enfermedades de transmision sexual'] = ['ETS="SI"', 'personas']
		miArray['personas que tengan enfermedades de transmision sexual'] = ['ETS="SI"', 'personas']
		miArray['personas que tengan alguna enfermeda de transmision sexual'] = ['ETS="SI"', 'personas']
		miArray['personas que tengan alguna ets'] = ['ETS="SI"', 'personas']

		/* ets */
	
	
	



		miArray['cancer de cabeza y cuello'] = ['cancer="Cabeza y Cuello"', 'personas']
		miArray['personas con cancer de cabeza y cuello'] = ['cancer="Cabeza y Cuello"', 'personas']
		miArray['mujeres con cancer de cabeza y cuello'] = ['cancer="Cabeza y Cuello" AND sexo="Femenino"', 'personas']
		miArray['hombres con cancer de cabeza y cuello'] = ['cancer="Cabeza y Cuello" AND sexo="Masculino"', 'personas']

		miArray['cancer de cerebro'] = ['cancer="Cerebro"', 'personas']
		miArray['personas con cancer de cerebro'] = ['cancer="Cerebro"', 'personas']
		miArray['mujeres con cancer de cerebro'] = ['cancer="Cerebro" AND sexo="Femenino"', 'personas']
		miArray['hombres con cancer de cerebro'] = ['cancer="Cerebro" AND sexo="Masculino"', 'personas']

		miArray['cancer de colorectal'] = ['cancer="Colorectal"', 'personas']
		miArray['personas con cancer de colorectal'] = ['cancer="Colorectal"', 'personas']
		miArray['mujeres con cancer de colorectal'] = ['cancer="Colorectal" AND sexo="Femenino"', 'personas']
		miArray['hombres con cancer de colorectal'] = ['cancer="Colorectal" AND sexo="Masculino"', 'personas']

		miArray['cancer de cuello uterino'] = ['cancer="Cuello Uterino"', 'personas']
		miArray['personas con cancer de cuello uterino'] = ['cancer="Cuello Uterino"', 'personas']
		miArray['mujeres con cancer de cuello uterino'] = ['cancer="Cuello Uterino" AND sexo="Femenino"', 'personas']

		miArray['cancer endometrio'] = ['cancer="Endometrio"', 'personas']
		miArray['personas con cancer de endometrio'] = ['cancer="Endometrio"', 'personas']
		miArray['personas con cancer endometrio'] = ['cancer="Endometrio"', 'personas']
		miArray['mujeres con cancer de endometrio'] = ['cancer="Endometrio" AND sexo="Femenino"', 'personas']
		miArray['mujeres con cancer endometrio'] = ['cancer="Endometrio" AND sexo="Femenino"', 'personas']

		miArray['cancer de estomago'] = ['cancer="Estomago"', 'personas']
		miArray['personas con cancer de estomago'] = ['cancer="Estomago"', 'personas']
		miArray['mujeres con cancer de estomago'] = ['cancer="Estomago" AND sexo="Femenino"', 'personas']
		miArray['hombres con cancer de estomago'] = ['cancer="Estomago" AND sexo="Masculino"', 'personas']
	
	
		miArray['cancer hepatico'] = ['cancer="Hepatico"', 'personas']
		miArray['personas con cancer de hepatico'] = ['cancer="Hepatico"', 'personas']
		miArray['mujeres con cancer de hepatico'] = ['cancer="Hepatico" AND sexo="Femenino"', 'personas']
		miArray['mujeres con cancer hepatico'] = ['cancer="Hepatico" AND sexo="Femenino"', 'personas']
		miArray['hombres con cancer de hepatico'] = ['cancer="Hepatico" AND sexo="Masculino"', 'personas']
		miArray['hombres con cancer hepatico'] = ['cancer="Hepatico" AND sexo="Masculino"', 'personas']
		
		miArray['cancer de higado'] = ['cancer="Higado"', 'personas']
		miArray['personas con cancer de higado'] = ['cancer="Higado"', 'personas']
		miArray['mujeres con cancer de higado'] = ['cancer="Higado" AND sexo="Femenino"', 'personas']
		miArray['mujeres con cancer en el higado'] = ['cancer="Higado" AND sexo="Femenino"', 'personas']
		miArray['hombres con cancer de higado'] = ['cancer="Higado" AND sexo="Masculino"', 'personas']
		miArray['hombres con cancer en el higado'] = ['cancer="Higado" AND sexo="Masculino"', 'personas']

		miArray['cancer de huesos'] = ['cancer="Huesos"', 'personas']
		miArray['cancer en los huesos'] = ['cancer="Huesos"', 'personas']
		miArray['personas con cancer de huesos'] = ['cancer="Huesos"', 'personas']
		miArray['personas con cancer en los huesos'] = ['cancer="Huesos"', 'personas']
		miArray['mujeres con cancer de huesos'] = ['cancer="Huesos" AND sexo="Femenino"', 'personas']
		miArray['mujeres con cancer en los huesos'] = ['cancer="Huesos" AND sexo="Femenino"', 'personas']
		miArray['hombres con cancer de huesos'] = ['cancer="Huesos" AND sexo="Masculino"', 'personas']
		miArray['hombres con cancer en los huesos'] = ['cancer="Huesos" AND sexo="Masculino"', 'personas']
		
		miArray['leucemia'] = ['cancer="Leucemia"', 'personas']
		miArray['personas con leucemia'] = ['cancer="Leucemia"', 'personas']
		miArray['mujeres con leucemia'] = ['cancer="Leucemia" AND sexo="Femenino"', 'personas']
		miArray['hombres con leucemia'] = ['cancer="Leucemia" AND sexo="Masculino"', 'personas']
		
		miArray['cancer de mama'] = ['cancer="Mama" AND sexo="Femenino"', 'personas']
		miArray['mujeres con cancer de mama'] = ['cancer="Mama" AND sexo="Femenino"', 'personas']
		miArray['personas con cancer de mama'] = ['cancer="Mama" AND sexo="Femenino"', 'personas']

		miArray['melanoma'] = ['cancer="Melnoma"', 'personas']
		miArray['personas con melanoma'] = ['cancer="Melnoma"', 'personas']
		miArray['mujeres con melanoma'] = ['cancer="Melnoma" AND sexo="Femenino"', 'personas']
		miArray['hombres con melanoma'] = ['cancer="Melnoma" AND sexo="Masculino"', 'personas']

		/* cancer */
		/*

		<option value="Melnoma">Melnoma</option>
		<option value="Mieloma">Mieloma</option>
		<option value="Ojos">Ojos</option>
		<option value="Ovarios">Ovarios</option>
		<option value="Pancreas">Pancreas</option>
		<option value="Piel">Piel</option>
		<option value="Prostata">Prostata</option>
		<option value="Pulmon">Pulmon</option>
		<option value="Riñon">Riñon</option>
		<option value="Tiroides">Tiroides</option>
		<option value="Utero">Utero</option>
		<option value="Vagina">Vagina</option>
		<option value="Vejiga">Vejiga</option>
		<option value="Vulva">Vulva</option>
		*/
		
		miArray['epilepsia'] = ['epilepsia="SI"', 'personas']
		miArray['personas con epilepsia'] = ['epilepsia="SI"', 'personas']
		miArray['personas que sufren de epilepsia'] = ['epilepsia="SI"', 'personas']
		
		miArray['mujeres con epilepsia'] = ['epilepsia="SI" AND sexo="Femenino"', 'personas']
		miArray['hombres con epilepsia'] = ['epilepsia="SI" AND sexo="Masculino"', 'personas']
		/* Epilepsia */

		/** Falta enfermedad */

		miArray['enf_renal'] = ['enf_renal="SI"', 'personas']
		miArray['discapacidad'] = ['discapacidad="SI"', 'personas']
		miArray['paralisis'] = ['paralisis="SI"', 'personas']
		
		//por edad pendiente y escolarizados
		
		miArray['escolarizados'] = ['educacion="Media General" AND edad<=17 OR educacion="Media General" AND edad<=16 OR educacion="Inicial" AND edad<=7 OR educacion="Basica" AND edad>=6 AND edad<=13', 'personas']

		miArray['media general'] = ['educacion="Media General" AND edad<=17', 'personas']

		miArray['media general incompleto'] = ['educacion="educacion="Media General" AND edad<=16', 'personas']

		miArray['educacion inicial'] = ['educacion="Inicial" AND edad<=7', 'personas']
		miArray['educacion basica'] = ['educacion="Basica" AND edad>=6 AND edad<=13', 'personas']



		miArray['niños no escolarizados'] = ['educacion="Sin estudio" AND edad>=6 AND edad<=12 OR educacion="No Escolarizado Inicial a Media General" AND edad>=6 AND edad<=16', 'personas']
		miArray['jovenes no escolarizados'] = ['educacion="Sin estudio" AND edad>=6 AND edad<=16 OR educacion="No Escolarizado Inicial a Media General" AND edad>=6 AND edad<=16', 'personas']
		miArray['no escolarizados'] = ['educacion="Sin estudio" AND edad>=6 AND edad<=16 OR educacion="No Escolarizado Inicial a Media General" AND edad>=6 AND edad<=16', 'personas']

		/*  parte de educacion */



		miArray['discapacidad'] = ['discapacidad!="NO"', 'personas']
		miArray['personas con discapacidad'] = ['discapacidad!="NO"', 'personas']
		miArray['personas que requieren ayuda tecnica'] = ['requiere_ayuda!="NO" AND requiere_ayuda!="NO APLICA"', 'personas']
		miArray['ayuda tecnica'] = ['requiere_ayuda!="NO" AND requiere_ayuda!="NO APLICA"', 'personas']
		miArray['jgh'] = ['recibe_bono_jose_g!="NO" AND recibe_bono_jose_g!="NO APLICA"', 'personas']
		miArray['jose gregorio hernandez'] = ['recibe_bono_jose_g!="NO" AND recibe_bono_jose_g!="NO APLICA"', 'personas']
		miArray['bono jose gregorio hernandez'] = ['recibe_bono_jose_g!="NO" AND recibe_bono_jose_g!="NO APLICA"', 'personas']
		miArray['atendidos con el bono jose gregorio hernandez'] = ['recibe_bono_jose_g!="NO" AND recibe_bono_jose_g!="NO APLICA"', 'personas']
		miArray['proegidos con el bono jose gregorio hernandez'] = ['recibe_bono_jose_g!="NO" AND recibe_bono_jose_g!="NO APLICA"', 'personas']


		/*  personas con discapacidad */

		miArray['madres lactantes'] = ['madre_lactante!="NO" AND madre_lactante!="NO APLICA"', 'personas']
		miArray['madre lactante'] = ['madre_lactante!="NO" AND madre_lactante!="NO APLICA"', 'personas']
		miArray['bono lactancia materna'] = ['bono_lactancia!="NO" AND bono_lactancia!="NO APLICA"', 'personas']
		miArray['bono de lactancia materna'] = ['bono_lactancia!="NO" AND bono_lactancia!="NO APLICA"', 'personas']
		/* madres lacantes */

		miArray['bonos'] = ['conf_ingreso_mensual="Bonos" OR conf_ingreso_mensual="Emprendimiento Personal Más Bonos" OR conf_ingreso_mensual="Salario en Bolivares más Bonos" OR conf_ingreso_mensual="Salario en Divisas más Bonos" OR conf_ingreso_mensual="Trabajo Particular más Bonos" OR conf_ingreso_mensual="Salario, más Bonos, más emprendimiento Personal"', 'personas']
		miArray['personas atendidas con bonos'] = ['conf_ingreso_mensual="Bonos" OR conf_ingreso_mensual="Emprendimiento Personal Más Bonos" OR conf_ingreso_mensual="Salario en Bolivares más Bonos" OR conf_ingreso_mensual="Salario en Divisas más Bonos" OR conf_ingreso_mensual="Trabajo Particular más Bonos" OR conf_ingreso_mensual="Salario, más Bonos, más emprendimiento Personal"', 'personas']
		miArray['personas atendidas mediante el sistema patria'] = ['conf_ingreso_mensual="Bonos" OR conf_ingreso_mensual="Emprendimiento Personal Más Bonos" OR conf_ingreso_mensual="Salario en Bolivares más Bonos" OR conf_ingreso_mensual="Salario en Divisas más Bonos" OR conf_ingreso_mensual="Trabajo Particular más Bonos" OR conf_ingreso_mensual="Salario, más Bonos, más emprendimiento Personal"', 'personas']
	
		/* bonos */

		miArray['brigadistas somos venezuela'] = ['msv="SI"', 'personas']
		miArray['msv'] = ['msv="SI"', 'personas']
		miArray['brigada somos venezuela'] = ['msv="SI"', 'personas']
		miArray['somos venezuela'] = ['msv="SI"', 'personas']

		/* somos venezuela */



		miArray['planificacion familiar'] = ['planificacio_familiar="Es Participante"', 'personas']
		/* Planificación familia */
		
		
		miArray['deficit nutricional'] = ['deficit_nutricional="SI"', 'personas']
		miArray['personas con deficit nutricional'] = ['deficit_nutricional="SI"', 'personas']
		/* Deficit nutricional */
		
		
		miArray['atendidos por el inn'] = ['combo_inn="SI"', 'personas']
		/* Combo alimenticio INN */
		
		
		miArray['hogares de la patria'] = ['hogares_de_la_patria="SI"', 'personas']
		miArray['atendidos por hogares de la patria'] = ['hogares_de_la_patria="SI"', 'personas']
		miArray['protegidos con hogares de la patria'] = ['hogares_de_la_patria="SI"', 'personas']
		/* Hogares de la patria */



			Object.entries(miArray).forEach(([key, value]) => {
			document.write("'" + key + "',") 
			});
	

	</script>


