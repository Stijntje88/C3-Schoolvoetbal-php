<x-base-layout>
    <div class="mb-8">
        <h1 class="font-extrabold text-2xl">MIJN TEAM(S)</h1>
        @foreach ($mijnTeam as $team)
        <h1 class="font-bold text-xl mt-6 mb-2">{{$team->name}}</h1>
        @if ($team->players)
        @php
        $players = json_decode($team->players, true);
        @endphp
        <p class="text-lg font-semibold">Players / Spelers</p>
        @foreach ($players as $player)
        <li class="mb-2">{{$player}}</li>
        @endforeach
        @endif
        @endforeach
    </div>

    <a href="{{route('user.addTeam')}}" class="p-2 bg-blue-600 hover:bg-blue-700 rounded-xl">Voeg team aan tournament</a>
</x-base-layout>
