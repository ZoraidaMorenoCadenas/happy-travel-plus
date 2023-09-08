<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="{{ asset('css/cards.css')}}" rel="stylesheet">
    <link href="{{ asset('css/home-navbar.css')}}" rel="stylesheet">
    <link href="{{ asset('css/navigation-blade.css')}}" rel="stylesheet">

</head>

<body>
    <header class="home-register-container">
        <a href="{{ url('/') }}"> <img class="logo" src="{{ asset('assets/Logo.svg') }}"></a>

        <div class="nav-bar-right-div">
            <!-- Search Input -->
            <div class="nav-bar-search-input-container">
                <form class="search-input" action="{{ route('searchGuest') }}" method="GET">
                    <input class="search" placeholder="Search..." type="text" name="query">
                    <button value='Search' class="search-button" type="submit"><img
                            src="{{ asset('assets/Glass-icon.svg') }}"></button>
                </form>
            </div>
            <!--nav links-->
            <div class="nav-links-container">
                @if (Route::has('login'))
                @auth
                <a class="dashboard-button" href="{{ url('/dashboard') }}"><img
                        src="{{ asset('assets/Avatar-icon.svg') }}"></a>
                @else
                <a class="login-button" href="{{ route('login') }}"></a>
                <!--boton de login si quieres poner-->
                @if (Route::has('register'))
                <a class="home-button " href="{{ url('/') }}"> <img src="{{ asset('assets/Home-icon.svg') }}"></a>
                <a class="register-button" href="{{ route('register') }}"><img
                        src="{{ asset('assets/Avatar-icon.svg') }}"></a>

                @endif
                @endauth
            </div>
            @endif
        </div>


    </header>
    <div class="grid-container">
        @php
        $cardsPerPage = 8;
        $currentPage = request()->query('page', 1);

        $combinedCards = $cards;
        $totalPages = ceil($combinedCards->count() / $cardsPerPage);
        $startIndex = ($currentPage - 1) * $cardsPerPage;
        $slicedCards = $combinedCards->slice($startIndex, $cardsPerPage);
        @endphp

        @foreach ($slicedCards as $card)
        <div class="card-container">
            <div class="img-container">
                @if ($card instanceof App\Models\Card)
                <img class="image-card" src="{{ asset('storage/' . $card->image) }}" alt="Image">
                @else
                <img class="image-card" src="{{ $card->image }}" alt="{{ $card->title }}">
                @endif
            </div>
            <h3 class="card-title">{{ $card->title }}</h3>
            <h4 class="card-location">{{ $card->location }}</h4>
        </div>
        @endforeach
    </div>

    <div class="pagination">
        @for ($page = 1; $page <= $totalPages; $page++) <a href="?page={{ $page }}"
            class="{{ $page == $currentPage ? 'current-page' : '' }}">
            {{ $page }}
            </a>
            @endfor
    </div>

</body>

</html>