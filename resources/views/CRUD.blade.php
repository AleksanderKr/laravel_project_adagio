<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD</title>
</head>
<body>
    <?php
        
        echo 'Lista tabel';
        $tables = DB::select('SHOW TABLES');
        foreach($tables as $table)
        {
            echo "<br />".head($table);
        }
        
        /*
            do CRUD-a:
            - po zalogowaniu welcome page z listą tabel, klik w tabelę pokazuje zawartość z polem do wyszukiwania,
            
            ???spróbujcie napisać uniwersalny wzorzec do wyszukiwania po kolumnach???, jakiś uniwersalny SELECT bez dużej ilości
            if'ów, nie wiem - jakiś hejt na if'y
            
        */
    ?>
    <div class = "crud_welcome">
        
    </div>
</body>
</html>