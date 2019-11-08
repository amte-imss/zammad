<html dir="ltr" class="" lang="es"><head prefix="og: http://ogp.me/ns#">
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <script></script>
  <title>Buzón</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="index, follow">
  <style>
    form {
        /* Sólo para centrar el formulario a la página */
        margin: 0 auto;
        width: 400px;
        /* Para ver el borde del formulario */
        padding: 1em;
        border: 1px solid #CCC;
        border-radius: 1em;
    }
    form div + div {
        margin-top: 1em;
    }
    label {
        /* Para asegurarse que todos los labels tienen el mismo tamaño y están alineados correctamente */
        display: inline-block;
        width: 90px;
        text-align: right;
    }
    input, textarea {
        /* Para asegurarse de que todos los campos de texto tienen las mismas propiedades de fuente
        Por defecto, las areas de texto tienen una fuente con monospace */
        font: 1em sans-serif;

        /* Para darle el mismo tamaño a todos los campos de texto */
        width: 300px;
        -moz-box-sizing: border-box;
        box-sizing: border-box;

        /* Para armonizar el look&feel del borde en los campos de texto */
        border: 1px solid #999;
    }
    input:focus, textarea:focus {
        /* Para dar un pequeño destaque en elementos activos*/
        border-color: #000;
    }
    textarea {
        /* Para alinear campos de texto multilínea con sus labels */
        vertical-align: top;

        /* Para dar suficiente espacio para escribir texto */
        height: 5em;

        /* Para permitir a los usuarios cambiar el tamaño de cualquier textarea verticalmente
            No funciona en todos los navegadores */
        resize: vertical;
    }
  </style>
</head>
<body>

<form action="create.php" method="post">
    <div>
        <label for="mail">E-mail:</label>
        <input type="email" id="mail" name="user_email" />
    </div>
    <div>
        <label for="name">Matrícula:</label>
        <input type="text" id="matricula" name="matricula" />
    </div>
    <div>
        <label for="name">Asunto:</label>
        <input type="text" id="subject" name="subject_name" />
    </div>
    <div>
        <label for="msg">Mensaje:</label>
        <textarea id="msg" name="user_message"></textarea>
    </div>
    
    <div class="button">
        <button type="submit">Send your message</button>
    </div>
</form>
</body>
</html>