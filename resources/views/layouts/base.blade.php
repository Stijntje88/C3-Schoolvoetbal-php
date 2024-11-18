<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? '4s tournament website'}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-green-700">
    <header class="border-b-2 p-8">
        <nav>
            @guest
            <div class="flex justify-around">
                <a href="{{route('home')}}"><img class="h-16 border-2 rounded-lg" src="{{asset('img/4s-logo.png')}}" alt="logo"></a>
                <div class="flex justify-evenly w-3/5">
                    <a href="">Home</a>
                    <a href="">Wedstrijd Schema</a>
                    <a href="">Scores</a>
                    <a href="">Leaderboard</a>
                </div>
                <div class="flex justify-end w-1/5">
                    <a class="mr-2" href="{{route('login')}}">Login</a> |
                    <a class="ml-2" href="{{route('register')}}">Register</a>
                </div>
            </div>
            @endguest

            @auth
            <div class="flex justify-between">
                <div class="flex justify-evenly w-3/5">
                    <a href="{{route('home')}}"><img class="h-16 border-2 rounded-lg" src="{{asset('img/4s-logo.png')}}" alt="logo"></a>
                    <a href="">Home</a>
                    <a href="">Wedstrijd Schema</a>
                    <a href="">Scores</a>
                    <a href="">Leaderboard</a>
                    <a href="">Mijn team</a>
                    <a href="{{route('teams.index')}}">Team beheer</a>
                </div>
                <div class="flex justify-end w-1/5">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <input type="submit" value="Logout">
                    </form>
                </div>
            </div>
            @endauth
        </nav>
    </header>
    <main class="w-4/5 mx-auto my-32 py-12">
        {{$slot}}
    </main>
    <footer class="border-t-2 p-5 bottom-0">
        <p>&copy;All copy rights reserved. ERIC, $TIJN EN JORT.</p>
    </footer>
</body>

</html>
