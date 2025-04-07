<?php
session_start();

// Genera una cadena aleatoria (captcha)
$captcha_length = 5;
$captcha_string = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $captcha_length);
$_SESSION["captcha"] = $captcha_string;

// Crear una imagen para el captcha
header("Content-Type: image/png");
$image = imagecreate(100, 40);
$bg_color = imagecolorallocate($image, 255, 255, 255); // blanco
$text_color = imagecolorallocate($image, 0, 0, 0); // negro

// Agregar líneas aleatorias
for ($i = 0; $i < 5; $i++) {
    $line_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255)); // Color aleatorio
    imageline($image, rand(0, 100), rand(0, 40), rand(0, 100), rand(0, 40), $line_color);
}

// Agregar puntos aleatorios
for ($i = 0; $i < 100; $i++) {
    $point_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255)); // Color aleatorio
    imagesetpixel($image, rand(0, 100), rand(0, 40), $point_color);
}

// Ruta de la fuente TTF
$font_path = 'font/Avion.ttf'; // Asegúrate de que la ruta sea correcta

// Añadir el texto del captcha usando la fuente TTF
$font_size = 18; // Tamaño de la fuente
$x = 10; // Posición X del texto
$y = 30; // Posición Y del texto
$angle = 5; // Ángulo de rotación (0 grados)

imagettftext($image, $font_size, $angle, $x, $y, $text_color, $font_path, $captcha_string);

// Enviar la imagen al navegador
imagepng($image);
imagedestroy($image);
?>
