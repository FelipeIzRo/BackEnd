// 3.2 Data conversion
// En JavaScript, los datos pueden ser convertidos de un tipo a otro. Por ejemplo, un número puede ser convertido a un string, o un string puede ser convertido a un número.
//
// JavaScript tiene dos tipos de conversiones de datos:
//
// Implícita: Cuando JavaScript convierte los datos automáticamente.
// Explícita: Cuando el programador convierte los datos manualmente.
// 3.2.1 Implicit data conversion
// JavaScript convierte los datos automáticamente cuando un operador espera un tipo de dato diferente al que se le está pasando.
//
// Por ejemplo, si se le pasa un string a un operador que espera un número, JavaScript convierte el string a un número automáticamente.

// Ejemplo:
const x = "6" / 2; // x es 3, 6 es convertido a un número
console.log(x); // 3

// Ejemplo:
const y = "6" + 2; // y es 62, 2 es convertido a un string
console.log(y); // 62

// La conversion implicita tambien se conoce como coercion.

// 3.2.2 Explicit data conversion
// JavaScript también permite convertir los datos manualmente. Para esto, se utilizan las funciones Number(), String(), Boolean(), BigInt() y Symbol().

// Ejemplo:
const a = Number("6"); // a es 6
console.log(a); // 6

// Ejemplo:
const b = String(6); // b es "6"
console.log(b); // "6"

// Ejemplo:
const c = Boolean(6); // c es true
console.log(c); // true

// Ejemplo:
const d = BigInt(6); // d es 6n
console.log(d); // 6n

// Ejemplo:
const e = Symbol(6); // e es Symbol(6)
console.log(e); // Symbol(6)
