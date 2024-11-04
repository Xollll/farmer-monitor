
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css" />
    <title>Welcome</title>
  </head>
  <body>
    <nav>
      <div class="nav__header">
        <div class="nav__logo">
          <a href="#">F<span>MS</span></a>
        </div>
        <div class="nav__menu__btn" id="menu-btn">
          <span><i class="ri-menu-line"></i></span>
        </div>
    </div>
    <ul class="nav__links" id="nav-links">
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact</a></li>
    </ul>

    @if (Route::has('login'))
    <div class="nav__btns flex flex-1 justify-end">
        @auth
            <a
                href="{{ url('/home') }}"
                class="btn rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Dashboard
            </a>
        @else
            <a href="{{ route('register') }}" class="btn sign__up rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Sign Up
            </a>

            <a href="{{ route('login') }}" class="btn sign__in rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Sign In
            </a>
        @endauth
    </div>
@endif

    </nav>
    <header class="header__container">
    <div class="header__image">
        <div class="header__image__card header__image__card-1">
        Crop health
        </div>
        <div class="header__image__card header__image__card-4">
        Moisture level
        </div>
    <img src="assets/pot.png" alt="header">
    </div>
    <div class="header__content">
        <h1>Farmer<br />Monitor <span>System</span></h1>
        <p>
          Embark on Your Journey Today and Discover Uncharted Wonders Around the
          World - Your Adventure Awaits with Exciting Experiences, Unforgettable
          Memories, and Endless Opportunities
        </p>
      </div>
    </header>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="main.js"></script>
  </body>
</html>
