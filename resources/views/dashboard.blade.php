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
      
      @auth
        <a class="navbar-brand" href="/users">Panel zarządzania</a>
      @endauth
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          @auth
          <li class="nav-item">
            <a class="nav-link" href="#" tabindex="-1" >Profil użytkownika</a>
          </li>
          @endauth
        </ul>

        <form class="d-flex" style="margin-right: 150px;" method="get" action="{{ url('/search') }}">
          @csrf
          
          <input class="form-control me-2" style="width: 600px;" type="text" id="search" name="search" placeholder="Search" aria-label="Search">
          <select name="category_dropdown">
            
              <option>Wszystkie</option>  
              <option>Elektronika</option>
              <option>Dom i ogród</option>
              <option>AGD</option>
              <option>Spożywcze</option>
              <option>Moda</option>
              <option>Zdrowie</option>
              <option>Motoryzacja</option>
            
          </select>
          <button class="btn btn-outline-success" type="submit">Wyszukaj</button>
        </form>
      <!-- popup -->
        <form method="get" action="{{ url('/searchMultiple') }}">    
          @csrf
          <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#reg-modal">Wyszukaj wiele</button>
          <div class="modal fade" id="reg-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal-title"> Wpisz, czego szukasz</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  
                  <input type="text" name="first_field" placeholder="1. przedmiot" value="">
                  <br>
                  <br>
                  <input type="text" name="second_field" placeholder="2. przedmiot" value="">
                </div>
                <div class="modal-footer">
                  <button class="btn btn-warning" type="submit">Wyszukaj</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      @if (Route::has('login'))
      <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
          @auth
              <a href="{{ url('/home') }}" class="text-sm text-white-700 dark:text-gray-500 underline">Wyloguj</a>
          @else
              <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Zaloguj</a>

              @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Zarejestruj się</a>
              @endif
          @endauth
      </div>
  @endif
    </div>
  </nav>

  <div class="card">
    <div class="card-body">

    </div>
  </div>

  <div class="container">
    <br>    
        <div class="row">

            @foreach ($offers as $offer)
            <div class="col-4">
                <div class="card" style="margin: 20px;">
                    <div class="card-header" style="background-color: rgb(242, 184, 76);">Oferta: {{ $offer->item_name }}</div>
                    <div class="card-body" style="background-color:rgb(224, 243, 194)">                      
                      <p>Kategoria: {{ $offer->category }}</p>
                      <p>Sprzedawca: {{ $usernames[random_int(0, 200)]->username }}</p>
                      <p class="text-danger">Cena: {{ $offer->price }}</p>
                      <img src="{{ $offer->pictures }}" width ="200" height="120" alt="no image found">
                        <div class="btn-group">
                          <a href="{{ url('/offers/' . $offer->id) }}" title="View Offer" class="btn btn-info btn-sm">Wyświetl</a>
                          @auth
                          <a href="{{ url('/offers/' . $offer->id) . '/edit/' }}" title="Edit Offer" class="btn btn-primary btn-sm">Edytuj</a>
                          @endauth
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach
            
    </div>
    <div class="row" style="float: right;" >{{ $offers->links() }}</div>
</div>

</body>
</html>
