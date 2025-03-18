Supongamos que estás diseñando una aplicación para una biblioteca. 
Necesitaríamos modelar las siguientes clases básicas:
Libro
Usuario
Préstamo

Cada clase tendría atributos y métodos relacionados. Por ejemplo:

Libro
Atributos: título, autor, ISBN, estado.
Métodos: prestar(), devolver().

Usuario
Atributos: nombre, ID de usuario, dirección.
Métodos: registrar(), consultarHistorial().

Préstamo
Atributos: fechaInicio, fechaFin, estado.
Métodos: calcularMulta(), extenderPlazo().

Además, habría relaciones entre las clases. Por ejemplo,
un Préstamo estaría asociado a un Usuario y a un Libro,
un Libro podría tener varios Préstamos asociados.

En términos de base de datos, podríamos tener tablas como:
Libro (id, título, autor, ISBN, estado)
Usuario (id, nombre, dirección)
Préstamo (id, id_libro, id_usuario, fechaInicio, fechaFin, estado)

Plato

Cliente

Orden

Ahora, definamos cada clase con sus posibles atributos y métodos:

Plato

Atributos: nombre, precio, ingredientes, disponibilidad.

Métodos: actualizarDisponibilidad(), calcularCosto().

Cliente

Atributos: nombre, número de contacto, historialDeOrdenes.

Métodos: realizarOrden(), consultarHistorial().

Orden

Atributos: númeroOrden, cliente, listaDePlatos, total.

Métodos: calcularTotal(), agregarPlato(), eliminarPlato(), confirmarOrden().

Relaciones:
Un Cliente puede realizar múltiples Ordenes.

Una Orden incluye múltiples Platos.

Un Plato puede estar en varias Ordenes, pero debe verificar su disponibilidad.