Conversor de Sistemas de Numeración — Walkthrough
Archivos creados
Archivo	Descripción

index.html
Estructura HTML + CSS con diseño dark premium

converter.js
Lógica de conversión, validación y eventos
Características implementadas
4 sistemas: Decimal, Binario, Octal, Hexadecimal
Conversión en tiempo real al escribir con parseInt(valor, base) → Number.toString(base)
Validación por base: regex impide caracteres inválidos (ej. "9" en binario)
Copiar al portapapeles con feedback visual
Formato agrupado para legibilidad (ej. 1111 1111 en binario)
Diseño responsivo con glassmorphism, animaciones y tipografía monoespaciada
Verificación en navegador
Estado inicial de la aplicación

Pruebas realizadas
Prueba	Resultado
Decimal 255 → BIN 1111 1111, OCT 377, HEX FF	✅
Binario 1010 → DEC 10, OCT 12, HEX A	✅
Binario rechaza "9" con mensaje de error	✅
Hexadecimal FF → DEC 255, BIN 1111 1111, OCT 377	✅
Demo de uso