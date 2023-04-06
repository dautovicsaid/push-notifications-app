<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.19.1/firebase-app.js";
        import { getMessaging, onMessage, getToken } from "https://www.gstatic.com/firebasejs/9.19.1/firebase-messaging.js";

        const firebaseConfig = {
            apiKey: "AIzaSyDJqegX0LIbDcWXzBQNDu8kMUmlHOGMdxA",
            authDomain: "test-app-2831e.firebaseapp.com",
            projectId: "test-app-2831e",
            storageBucket: "test-app-2831e.appspot.com",
            messagingSenderId: "160329246652",
            appId: "1:160329246652:web:3d7ce24af4e0fc360d2db9",
            measurementId: "G-B04H3CBN1X"
        };

        const app = initializeApp(firebaseConfig);
        const messaging = getMessaging(app);

        async function initFirebaseMessagingRegistration() {
            try {
                const permission = await Notification.requestPermission();
                if (permission === 'granted') {
                    const token = await getToken(messaging, { vapidKey: "BHv4IYPNW02mPFx39h6xv9Ycm2qNhyoIBF-Csw7kridvuhzK4ZYJfLJ1aAg54VfS_nc_2Ljoz67Fo0Tc0kC_hek" });
                    axios.post("{{ route('device.token.update') }}", {
                        _method: "PATCH",
                        token
                    })} else {
                    console.log(`Notification permission not granted`);
                }
            } catch (err) {
                console.log(`Token Error :: ${err}`);
            }
        }

        initFirebaseMessagingRegistration();

        onMessage(messaging, ({ data: { body, title } }) => {
            new Notification(title, { body });
        });

    </script>
</body>
</html>
