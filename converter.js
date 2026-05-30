/**
 * ============================================================
 * Conversor de Sistemas de Numeración
 * ============================================================
 *
 * Este script maneja la conversión en tiempo real entre los
 * cuatro sistemas de numeración: Decimal (10), Binario (2),
 * Octal (8) y Hexadecimal (16).
 *
 * LÓGICA PRINCIPAL DE CONVERSIÓN:
 * 1. Se recibe el valor ingresado y la base de origen seleccionada.
 * 2. Se usa parseInt(valor, base) para convertir el valor a Decimal.
 *    - parseInt interpreta la cadena según la base indicada.
 *    - Ejemplo: parseInt("1010", 2) → 10 (binario a decimal)
 * 3. Se usa Number.toString(base) para convertir el Decimal a las
 *    otras bases de destino.
 *    - Ejemplo: (10).toString(16) → "a" (decimal a hexadecimal)
 *
 * VALIDACIÓN:
 * Cada base tiene caracteres válidos específicos:
 *    - Binario (2): solo 0 y 1
 *    - Octal (8): dígitos del 0 al 7
 *    - Decimal (10): dígitos del 0 al 9
 *    - Hexadecimal (16): dígitos 0-9 y letras A-F
 * Se usan expresiones regulares para validar la entrada.
 * ============================================================
 */

(function () {
    'use strict';

    // ==============================
    // Referencias a elementos del DOM
    // ==============================
    const baseSelector = document.getElementById('baseSelector');
    const inputValue = document.getElementById('inputValue');
    const clearBtn = document.getElementById('clearBtn');
    const validationMsg = document.getElementById('validationMsg');
    const validationTxt = document.getElementById('validationText');
    const resultGrid = document.getElementById('resultGrid');
    const emptyState = document.getElementById('emptyState');

    // ==============================
    // Configuración de cada base
    // ==============================
    // Definimos las propiedades de cada sistema de numeración:
    // - label: nombre para la interfaz
    // - regex: patrón de caracteres válidos (sin contar el prefijo negativo)
    // - placeholder: texto de ayuda en el campo de entrada
    // - errorMsg: mensaje de error personalizado
    const BASE_CONFIG = {
        2: {
            label: 'Binario',
            regex: /^-?[01]+$/,
            placeholder: 'Ej: 1010, 11111111',
            errorMsg: 'Solo se permiten los dígitos 0 y 1 en binario'
        },
        8: {
            label: 'Octal',
            regex: /^-?[0-7]+$/,
            placeholder: 'Ej: 17, 377',
            errorMsg: 'Solo se permiten dígitos del 0 al 7 en octal'
        },
        10: {
            label: 'Decimal',
            regex: /^-?[0-9]+$/,
            placeholder: 'Ej: 42, 255, 1024',
            errorMsg: 'Solo se permiten dígitos del 0 al 9 en decimal'
        },
        16: {
            label: 'Hexadecimal',
            regex: /^-?[0-9a-fA-F]+$/,
            placeholder: 'Ej: FF, 1A3, CAFE',
            errorMsg: 'Solo dígitos 0-9 y letras A-F en hexadecimal'
        }
    };

    // Base seleccionada actualmente (por defecto: Decimal)
    let currentBase = 10;

    // ==============================
    // Funciones de utilidad
    // ==============================

    /**
     * Muestra un mensaje de validación (error) bajo el campo de entrada.
     * @param {string} message - Texto del mensaje a mostrar.
     */
    function showValidation(message) {
        validationTxt.textContent = message;
        validationMsg.classList.add('visible');
    }

    /**
     * Oculta el mensaje de validación.
     */
    function hideValidation() {
        validationMsg.classList.remove('visible');
    }

    /**
     * Formatea un número en una base determinada para facilitar la lectura.
     * Agrupa los dígitos cada 4 caracteres (para binario y hexadecimal)
     * o cada 3 (para octal y decimal), separados por espacios.
     * @param {string} value - El valor ya convertido como cadena.
     * @param {number} base - La base del sistema de numeración.
     * @returns {string} El valor formateado con separadores de grupo.
     */
    function formatOutput(value, base) {
        // Determinamos si el número es negativo para manejarlo por separado
        const isNegative = value.startsWith('-');
        let digits = isNegative ? value.slice(1) : value;

        // Elegimos el tamaño de grupo según la base
        // Binario y Hex: grupos de 4; Octal y Decimal: grupos de 3
        const groupSize = (base === 2 || base === 16) ? 4 : 3;

        // Separar dígitos en grupos de derecha a izquierda
        let result = '';
        let count = 0;
        for (let i = digits.length - 1; i >= 0; i--) {
            result = digits[i] + result;
            count++;
            if (count % groupSize === 0 && i !== 0) {
                result = ' ' + result;
            }
        }

        return (isNegative ? '-' : '') + result;
    }

    // ==============================
    // Función principal de conversión
    // ==============================

    /**
     * Realiza la conversión del valor ingresado a todos los otros sistemas.
     *
     * Proceso:
     * 1. Lee el valor del campo de entrada.
     * 2. Valida que los caracteres sean válidos para la base seleccionada.
     * 3. Usa parseInt(valor, baseOrigen) para obtener el número en decimal.
     * 4. Usa decimalValue.toString(baseDestino) para convertir a cada base.
     * 5. Muestra los resultados en la interfaz.
     */
    function performConversion() {
        const raw = inputValue.value.trim();

        // Si el campo está vacío, limpiamos los resultados
        if (raw === '' || raw === '-') {
            hideValidation();
            showEmptyState();
            return;
        }

        // --- PASO 1: Validación de caracteres ---
        // Verificamos que el valor ingresado contenga solo caracteres
        // válidos para la base seleccionada usando la regex correspondiente.
        const config = BASE_CONFIG[currentBase];
        if (!config.regex.test(raw)) {
            showValidation(config.errorMsg);
            showEmptyState();
            return;
        }

        // --- PASO 2: Conversión a Decimal ---
        // parseInt(cadena, base) interpreta la cadena como un número
        // en la base dada y retorna su valor en decimal (base 10).
        // Ejemplo: parseInt("FF", 16) → 255
        const decimalValue = parseInt(raw, currentBase);

        // Verificamos que la conversión sea válida
        if (isNaN(decimalValue)) {
            showValidation('El valor ingresado no es válido');
            showEmptyState();
            return;
        }

        // Si todo es válido, ocultamos cualquier error previo
        hideValidation();

        // --- PASO 3: Conversión a las otras bases ---
        // Number.toString(base) convierte un número decimal a una
        // representación en cadena en la base indicada.
        // Ejemplo: (255).toString(2) → "11111111"
        const conversions = {
            2: decimalValue.toString(2),   // A Binario
            8: decimalValue.toString(8),   // A Octal
            10: decimalValue.toString(10),  // A Decimal
            16: decimalValue.toString(16)   // A Hexadecimal
        };

        // --- PASO 4: Renderizar resultados ---
        renderResults(conversions);
    }

    // ==============================
    // Funciones de renderizado (UI)
    // ==============================

    /**
     * Muestra el estado vacío cuando no hay resultados que mostrar.
     */
    function showEmptyState() {
        resultGrid.innerHTML = '';
        resultGrid.appendChild(emptyState);
        emptyState.style.display = 'block';
    }

    /**
     * Genera el HTML de los resultados de conversión y los muestra.
     * Solo muestra las bases que son diferentes a la base de origen.
     * @param {Object} conversions - Objeto con las conversiones { base: valor }.
     */
    function renderResults(conversions) {
        // Ocultamos el estado vacío
        emptyState.style.display = 'none';

        // Limpiamos resultados anteriores
        resultGrid.innerHTML = '';

        // Lista de las bases que queremos mostrar como resultado
        // (excluimos la base de origen ya que es la entrada del usuario)
        const targetBases = [2, 8, 10, 16].filter(b => b !== currentBase);

        targetBases.forEach(base => {
            const config = BASE_CONFIG[base];
            // Obtenemos el valor convertido
            let value = conversions[base];

            // Hexadecimal se muestra en mayúsculas por convención
            if (base === 16) {
                value = value.toUpperCase();
            }

            // Formateamos con separadores para mejor legibilidad
            const displayValue = formatOutput(value, base);

            // Creamos el elemento del resultado
            const item = document.createElement('div');
            item.className = 'result-item';
            item.setAttribute('data-base', base);

            item.innerHTML = `
        <div class="result-label">
          <span class="badge">${base === 2 ? 'BIN' : base === 8 ? 'OCT' : base === 10 ? 'DEC' : 'HEX'}</span>
          <span class="name">${config.label}</span>
        </div>
        <div class="result-value-area">
          <span class="result-value" title="${value}">${displayValue}</span>
          <button class="copy-btn" title="Copiar valor" data-value="${value}">📋</button>
        </div>
      `;

            resultGrid.appendChild(item);
        });

        // Agregamos el emptyState al DOM pero oculto (para referencia futura)
        resultGrid.appendChild(emptyState);
    }

    // ==============================
    // Función de copiar al portapapeles
    // ==============================

    /**
     * Copia un valor al portapapeles del usuario.
     * Muestra retroalimentación visual cambiando el ícono temporalmente.
     * @param {HTMLElement} button - El botón de copiar presionado.
     */
    function copyToClipboard(button) {
        const value = button.getAttribute('data-value');

        navigator.clipboard.writeText(value).then(() => {
            // Retroalimentación visual: cambiamos el ícono a ✓
            const original = button.textContent;
            button.textContent = '✓';
            button.classList.add('copied');

            setTimeout(() => {
                button.textContent = original;
                button.classList.remove('copied');
            }, 1500);
        }).catch(() => {
            // Fallback: seleccionar el texto si clipboard API no está disponible
            const textarea = document.createElement('textarea');
            textarea.value = value;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);

            button.textContent = '✓';
            button.classList.add('copied');
            setTimeout(() => {
                button.textContent = '📋';
                button.classList.remove('copied');
            }, 1500);
        });
    }

    // ==============================
    // Event Listeners
    // ==============================

    /**
     * Evento: Selección de base de origen.
     * Al hacer clic en uno de los botones de base, se actualiza la
     * base activa, se cambia el placeholder del input y se re-ejecuta
     * la conversión con el valor actual.
     */
    baseSelector.addEventListener('click', function (e) {
        const btn = e.target.closest('.base-option');
        if (!btn) return;

        // Removemos la clase 'active' de todos los botones
        document.querySelectorAll('.base-option').forEach(b => b.classList.remove('active'));

        // Activamos el botón seleccionado
        btn.classList.add('active');

        // Actualizamos la base actual
        currentBase = parseInt(btn.getAttribute('data-base'), 10);

        // Actualizamos el placeholder del input según la base elegida
        inputValue.placeholder = BASE_CONFIG[currentBase].placeholder;

        // Re-ejecutamos la conversión con el nuevo sistema de origen
        // para que los resultados se actualicen inmediatamente
        hideValidation();
        performConversion();
    });

    /**
     * Evento: Entrada de texto (conversión en tiempo real).
     * Cada vez que el usuario escribe o modifica el campo de entrada,
     * se ejecuta la conversión automáticamente gracias al evento 'input'.
     */
    inputValue.addEventListener('input', function () {
        performConversion();
    });

    /**
     * Evento: Botón de limpiar.
     * Vacía el campo de entrada, oculta errores y restaura el estado inicial.
     */
    clearBtn.addEventListener('click', function () {
        inputValue.value = '';
        hideValidation();
        showEmptyState();
        inputValue.focus();
    });

    /**
     * Evento: Copiar al portapapeles.
     * Se usa delegación de eventos en el contenedor de resultados
     * para manejar clics en cualquier botón de copiar.
     */
    resultGrid.addEventListener('click', function (e) {
        const copyButton = e.target.closest('.copy-btn');
        if (copyButton) {
            copyToClipboard(copyButton);
        }
    });

    /**
     * Evento: Atajo de teclado.
     * Escape limpia el campo de entrada.
     */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            inputValue.value = '';
            hideValidation();
            showEmptyState();
            inputValue.focus();
        }
    });

    // ==============================
    // Inicialización
    // ==============================
    // Establecemos el placeholder inicial según la base por defecto (decimal)
    inputValue.placeholder = BASE_CONFIG[currentBase].placeholder;

    // Enfocamos el campo de entrada para que el usuario pueda empezar
    // a escribir inmediatamente al cargar la página
    inputValue.focus();

})();
