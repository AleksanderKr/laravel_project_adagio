<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adagio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Adagio</a>
      <a class="navbar-brand" href="/users">usercrud</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
          <li class="nav-item">
            <a class="nav-link" href="#" tabindex="-1" >user profile</a>
          </li>
        </ul>
        <form class="d-flex" style="margin-right: 400px;" method="post">
          @csrf
          @method('POST')
          <input class="form-control me-2" style="width: 600px;" type="search" placeholder="Search" aria-label="Search">
          <select name="wat">
            <optgroup label="primo">
              <option>uno</option>
            </optgroup>
            <optgroup label="secundo">
              <option>duo</option>
            </optgroup>
          </select>
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="card">
    <div class="card-body">
      <div class="container">
        <div class="col">
          <a href="#"> wat </a>
          <a href="#"> wat </a>
        </div>
      </div>
    </div>
  </div>



</body>
</html>