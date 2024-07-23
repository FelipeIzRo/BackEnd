//03 - Data types

// Existen 6 tipos de datos en JavaScript
// 1. String
// 2. Number
// 3. Boolean
// 4. Undefined
// 5. BigInt
// 6. Symbol

// Y un tipo de dato especial
// 7. Null

// Y estructuras de datos, que son un tipo de dato especial que se utiliza para organizar colecciones de datos. 
// Entre las estructuras de datos mas comunes tenemos:
// 8. Object
// 9. Array


// 1. String
// Es una cadena de caracteres, se declaran entre comillas simples o dobles.
// Ejemplos:
var personName = "Juan"; // Variable de tipo string

// 2. Number
// Es un número, se declaran sin comillas.
// Ejemplos:
const PI = 3.1416; // Variable de tipo number

// 3. Boolean
// Es un valor booleano, es decir, verdadero o falso.
// Ejemplos:

const isAdult = true; // Variable de tipo boolean

// 4. Undefined
// Es un valor especial que indica que la variable no tiene un valor asignado.
// Ejemplos:
let x;
console.log(x); // undefined

// 5. BigInt
// Es un tipo de dato numérico que puede representar números enteros de cualquier longitud.
// Ejemplos:
const bigNumber = 1234567890123456789012345678901234567890n;
console.log(bigNumber); // 1234567890123456789012345678901234567890n

// 6. Symbol
// Es un tipo de dato cuyos valores son únicos e inmutables.
// Ejemplos:
const symbol1 = Symbol("a");
const symbol2 = Symbol("a");
console.log(symbol1 === symbol2); // false

// 7. Null
// Es un valor especial que indica que la variable no tiene un valor asignado.
// Ejemplos:
let y = null;
console.log(y); // null

