<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarjetas de Participantes</title>
    <link rel="stylesheet" href="./css/contactos.css">
</head>
<body>
    <div class="cards-container">
        <?php
        // Array de participantes
        $participantes = [
            [
                "imagen" => "Img/Elkin.png",
                "nombre" => "Elkin",
                "descripcion" => "Desarrollador backend en formación, interesado en bases de datos y APIs.",
                "github" => "https://github.com/Elkinnn",
                "facebook" => "https://www.facebook.com/profile.php?id=100004821498926&locale=es_LA"
            ],
            [
                "imagen" => "Img/Diego.png",
                "nombre" => "Diego",
                "descripcion" => "Apasionado por la programación orientada a objetos y la resolución de problemas.",
                "github" => "https://github.com/Diego200509",
                "facebook" => "https://www.facebook.com/diego.jijon.77?locale=es_LA"
            ],
            [
                "imagen" => "Img/.png",
                "nombre" => "Mateo",
                "descripcion" => "Especialista en diseño y desarrollo frontend con un enfoque en UX/UI.",
                "github" => "https://github.com/ArielParedesLozada",
                "facebook" => "https://facebook.com/mateo.profile"
            ],
            [
                "imagen" => "Img/Leo.png",
                "nombre" => "Leonel",
                "descripcion" => "Interesado en tecnologías de inteligencia artificial y aprendizaje automático.",
                "github" => "https://github.com/Leo538",
                "facebook" => "https://www.facebook.com/profile.php?id=100010167997541&locale=es_LA"
            ],
            [
                "imagen" => "Img/Sebas.png",
                "nombre" => "Sebastian",
                "descripcion" => "Programador full stack en desarrollo, apasionado por la innovación tecnológica.",
                "github" => "https://github.com/seby10",
                "facebook" => "https://www.facebook.com/sebas.constantenaranjo?locale=es_LA"
            ],
            [
                "imagen" => "Img/Pablo.png",
                "nombre" => "Pablo",
                "descripcion" => "Especialista en redes y ciberseguridad, comprometido con la seguridad digital.",
                "github" => "https://github.com/PabloAML1",
                "facebook" => "https://www.facebook.com/pablo.montero.1884?locale=es_LA"
            ]
        ];

        // Generar las tarjetas dinámicamente
        foreach ($participantes as $participante) {
            echo "
            <div class='card'>
                <img src='{$participante['imagen']}' alt='Imagen de {$participante['nombre']}'>
                <div class='card-content'>
                    <h3>{$participante['nombre']}</h3>
                    <p>{$participante['descripcion']}</p>
                    <div class='social-links'>
                        <a href='{$participante['github']}' title='GitHub' target='_blank'>GitHub</a>
                        <a href='{$participante['facebook']}' title='Facebook' target='_blank'>Facebook</a>
                    </div>
                </div>
            </div>
            ";
        }
        ?>
    </div>
</body>
</html>
