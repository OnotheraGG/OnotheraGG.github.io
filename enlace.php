<?php

// --- CONFIGURACIÓN ---
// 1. Dominio permitido (desde donde debe venir el clic)
$dominioPermitido = 'patreon.com';

// 2. URL final del archivo en tu servicio tipo Dropbox
$urlDestinoFinal = 'https://drive.proton.me/urls/VS4K7SCTZ0#By9tFZcEDfuX';

// 3. (Opcional) URL a donde redirigir si el acceso no es válido
$urlAccesoDenegado = 'https://tu-dominio.infinityfreeapp.com/acceso-denegado.html';

// --- LÓGICA DE VERIFICACIÓN (No necesitas modificar esto) ---
$refererPermitido = false;

if (isset($_SERVER['HTTP_REFERER'])) {
    $refererUrl = $_SERVER['HTTP_REFERER'];
    $refererHost = parse_url($refererUrl, PHP_URL_HOST);

    // Comprueba si el host del referer termina con el dominio permitido
    // (Ej: 'patreon.com' o 'www.patreon.com')
    if ($refererHost && (str_ends_with($refererHost, '.' . $dominioPermitido) || $refererHost === $dominioPermitido)) {
         $refererPermitido = true;
    }
}

// --- REDIRECCIÓN ---
if ($refererPermitido) {
    // El referer es válido, redirigir al destino final
    header('Location: ' . $urlDestinoFinal);
    exit; // Importante: detener la ejecución del script después de redirigir
} else {
    // El referer NO es válido o no existe
    // Opción A: Redirigir a una página de "acceso denegado"
     header('Location: ' . $urlAccesoDenegado);
     exit;

    // Opción B: Mostrar un mensaje directamente (menos elegante)
    // echo "Acceso denegado. Solo se permite el acceso desde Patreon.";
    // exit;
}

?>