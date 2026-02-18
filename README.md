# vibecodingDetenidos (Feb 2026)
### Comparativa de Vibe Coding

Este es uno de los experimentos semanales que realizo en vibecodingmexico.com  

Este repositorio es el resultado de un experimento de vibecoding **Enfocado a empresas medianas LATAM 2026** realizado el 4 de febrero de 2026. La misión: crear un sistema de favoritos estilo Metro, seguro y ligero, optimizado para redes inestables (como el metro de la CDMX) y servidores cPanel.

## ⚖️ Sobre la Licencia
He elegido la **Licencia MIT** por su simplicidad. Es lo más cercano a una "Creative Commons" para código: haz lo que quieras con él, solo mantén el crédito del autor. 

* **¿Por qué no LGPL 2.1?** Aunque es una gran licencia para proteger mejoras (obligando a compartir los cambios del archivo), para este experimento buscaba la mínima fricción posible. La MIT es "Plug & Play", igual que la filosofía del proyecto.

## ✍️ Acerca del Autor
Este proyecto forma parte de una serie de artículos en **[vibecodingmexico.com](https://vibecodingmexico.com)**. Mi enfoque no es la programación de laboratorio, sino la **Programación Real**: aquella que sobrevive a servidores compartidos, bloqueos de oficina y conexiones de una sola rayita de señal.

Mi nombre es Alfonso Orozco Aguilar, soy mexicano, programo desde 1991 para comer, y no tengo cuenta de Linkedin para disminuir superficie de ataque. Llevo trabajando desde que tengo memoria como devops / programador senior, y en 2026 estoy por terminar la licenciatura de contaduria. En el sitio esta mi perfil de facebook.

[Perfil de Facebook de Alfonso Orozco Aguilar](https://www.facebook.com/alfonso.orozcoaguilar)

## 🛠️ ¿Por qué cPanel y PHP?
Elegimos **cPanel** porque es el estándar de la industria desde hace 25 años y el ambiente más fácil de replicar para cualquier profesional. 
* **Versión de PHP:** Asumimos un entorno moderno de **PHP 8.4**, pero por su naturaleza procedural, el código es confiable en cualquier hospedaje compartido con **PHP 7.x** o superior. Tu respaldo es como un "Tupperware" que puedes cambiar de refrigerador sin problemas.

---


## 📂 Guía de Archivos (Los Especímenes)

Análisis y contexto más detallados en

https://vibecodingmexico.com/vibe-coding-un-dashboard-detenido/
Ahi vienen los enlaces para verlos en vivo. 

Ganador Copilot segunda opción real Gemini. Grok merece premio aparte por solidez de manejo de errores y proactivo.

| Candidato | Calificación | Perfil Profesional | Factor de "Activo Fijo" |
| :--- | :---: | :--- | :--- |
| **🏆 Copilot** | **9.6** | Becario Flojo | **Premium:** Hizo buen trabajo y se ve muy bien. |
| **🛡️ Gemini** | **9.5** | Ingeniero Senior | **Estructural:** El más Completo. No hzio cosas que otros sí |
| **💎 Cohere** | **9.5** | Senior Remoto | **Sobrio:** Muy legible,solido y es siempre arma secreta. Demasiado poco ambicioso |
| **💼 Claude** | **9.5** | Consultor Senior | **Elegancia:** Calidad indiscutible de presentación. Dos pequeños errores |
| **📉 Grok** | **9.4** | Junior autodidacta | **Impredecible:** Resultado excelente pero no se ve ultima fila. Hizo masde lo que se pidió|

* **`copilotdetenidos.php`**
* **`geminidetenidos.php`**
* **`coheredetenidos.php`**
* **`claudedetenidos.php`**
* **`grokdetenidos.php`**: La origina
* **`grokdetenidos2.php`**: La mejorada con mismo problema
* **`grokdetenidos3.php`**: Esta sin datos de prueba los tuve que pegar
* **`grokdetenidos4.php`**: La mejor 

Hay un análisis mas amplio en el link. Noté además unas características raras de CARACTER de grok, como junior independiente aunque
mas bien de personalidad. Hizo algo similar Gemini tendré que hacer pruebas externas. Grok se puso modo "barrio" usando palabras como
"Carnal" y gemini confundió un contexto y empezó a  ser unaespecie decapatazde recursos humanos. Voy aahacer una neuvasección para
evaluar cosas fuera de calidad o generación de código, sino calidad ...humana en toma de decisiones.

Si te interesa leee Vibecodingmexico.com  los viernes.

---
## 📂 Contexto
El 6 de febrero 2026 entré a un Ministerio Publico en CDMX, y el monitor de WINDOWS7, si windows 7 mostrabaun dashboard de detenciones de personas con caracteristicas como  faltan 227962 horascon 110 minutos, sin determinar. 

Evidentemente era un error de Apis.
---

## 🤖 El Prompt Original (La Prueba)
Para que el experimento sea replicable, este fue el comando enviado a todas las LLMs:

INICIA PROMPT

Ejercicio de vibecoding.
Contexto: en un ministerio público de la CDMX vi un monitor con errores de lógica que recibían probablemente información de un API que estaba mal. Voy a hacer un ejercicio de vibecoding para comparar varios modelos.

Prompt (corregido)
Código
# ROL: Senior Full-Stack Developer (Vibecoding Mode)

Actúa como un desarrollador experto en PHP y UI/UX institucional. Tu objetivo es ganar una competencia de código replicable en un solo archivo.

# EL PROBLEMA A RESOLVER

Debes recrear un "Monitor de Detenciones" inspirado en las oficinas del Ministerio Público de la CDMX. El sistema original presenta datos corruptos y una visualización deficiente. Tu misión es crear una interfaz robusta que procese un universo de datos "sucios" y los presente de forma clara, profesional y automatizada.

# REGLAS TÉCNICAS (ESTRUCTURA)

1. LENGUAJE: PHP 8.x puro.

2. FRONTEND: Bootstrap 4.6 y Font Awesome (carga exclusiva vía jsDelivr).

3. PROHIBICIONES:

   - NO usar base de datos.
   - NO usar short tags (<?).
   - NO usar short echo (<?=). Usar siempre <?php echo ...; ?>.
   - TODO el código debe estar en un único archivo (.php).

4. PERSISTENCIA: Crea un array interno con un universo de 24 registros de prueba (Persona, Delito, Tiempo, Estatus).

# LÓGICA DE NEGOCIO (COLORES Y ALERTAS)

La columna 3 (Estatus/Tiempo) debe cambiar de color dinámicamente:

- FONDO ROJO: si el estatus contiene las palabras "consignado" o "recluido".
- FONDO AMARILLO: si el tiempo es mayor a 36 horas y no está consignado (atención con los datos corruptos de miles de horas).
- FONDO NORMAL: si el tiempo es menor a 36 horas.

# INTERFAZ Y DINÁMICA

- NAVBAR: fija arriba, identificando tu nombre de modelo y la versión de PHP actual.
- FOOTER: estático y profesional con Bootstrap.
- PAGINACIÓN AUTOMÁTICA: el monitor debe mostrar bloques de 6 registros. Cada 7 segundos debe cambiar al siguiente bloque automáticamente y regresar al primero al terminar (loop). Usa JS Vanilla o Meta-Refresh para esto.
- DISEÑO: estilo "Dashboard de Control", limpio y legible a distancia.

# SALIDA ESPERADA

Dame el código completo en un solo bloque, listo para copiar, pegar y ejecutar


FIN DE PROMPT


---

## 🖼️ Evidencia Visual
Las imágenes de las interfaces generadas se encuentran en la carpeta del repositorio para su consulta. 
## 🚀 Requisitos Mínimos
1. Un dominio y hospedaje php 7.x Hospedaje compartido con PHP 7.x o superior y acceso a MySQL/MariaDB.
