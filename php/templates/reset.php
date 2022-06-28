<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Template Contact</title>
    <style>
        .container{
            width: 90%;
            margin: 0 auto;
        }
        
        .header{
            text-align: center;
            margin: 0;
            padding: 0;
        }
        
        h4, h5{
            margin: 0
        }
        
        .mail__title{
            font-size: 30px;
            font-family: sans-serif;
        }
        
        .from, .subject{
            margin: 0;
            font-size: 19px;
        }
        
        .text{
            text-align: justify;
        }
        
        .headers a{
            text-decoration: none;
            color: fuchsia;
        }
        
        .asunto{
            color: brown;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a target="_blank" href="http://http://localhost/reservasala/">
            <img src="{EMAIL_LOGO}" alt="" class="logo">   
            </a>
            <h5 class="mail__title">{EMAIL_TITLE}</h5>
        </div>
        <div class="text">
            <p>
                Estimado(a), Junto con saludar, adjuntamos el link para restablecer su contraseña.<br/>
                <a href="{MESSAGE}">Resetear Contraseña</a>
            </p>
        </div>
        
    </div>
</body>
</html>