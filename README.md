# PHP-sistema-de-clinica
Este es un proyecto viejo que termine hace un años atras con PHP (el cual no esta separado en capaz), al cual no le di mas mantencion debido a que seguido de esto y de programar una tienda con PHP (la cual tampoco estaba separada en capaz), pase directamente a LARAVEL donde utilice este mismo proyecto con esta misma interfaz pero realizando el sistema de permisos separado por rutas que eran validadas por middleware en LARAVEL, los cuales mas adelante al ganar mas experiencia me di cuenta que:

-Podria haber separado en capaz el proyecto.

-Utilizar un sistema de roles y permiso directo de la base de datos (el cual ya implemente en un proyecto de turnos en ASP.NET).

-O podria haber separado los permisos de cada rol en diferentes layout para que cada rol tenga permisos especificos sobre su layout, el cual no utilizaria por que no es un sistema muy eficiente, lo mas adecuado seria lo anterior generar los permisos desde la base de datos con un sistema de roles y permisos para poder asignar nuevos permisos y/o mismos permisos a diferentes roles segun la necesidad, esto mismo ya lo implemente en un proyecto ASP.NET, el cual se encuentra en mi repositorio https://github.com/Walter-Damian-Diaz/UTN--ASP.NET--proyecto_final-Web_sistema_turnos_clinica).
Completamente abierto a preguntas tecnicas al respecto de este proyecto.

-Este proyecto tambien lo implemente en LARAVEL con un sistema de permiso a traves de rutas con middleware que LARAVEL ofrece, se encuentra hospedado en un host completamente funcional en mi subdominio el cual se puede probar desde ahi www.clinica.walter.diaz.com.ar
