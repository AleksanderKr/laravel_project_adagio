<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>database connection test</title>
</head>
<body>
    <div>
        <?php 
            if(DB::connection()->getPdo()) {
                echo 'successful connection to database: '.DB::connection()->getDatabaseName();
                
                $users = DB::table('users')->get();
                foreach ($users as $user) {
                    echo "<br />".$user->username;
                }
            }
            
        ?>

    </div>
</body>
</html>