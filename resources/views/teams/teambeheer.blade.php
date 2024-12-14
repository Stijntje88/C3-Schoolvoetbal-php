<x-base-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="font-bold text-2xl mb-6">MIJN TEAM</h1>
        @foreach ($teams as $team)
        <div class="flex justify-between w-3/5 items-center mb-6">
            <div>
                <h1><span class="font-semibold text-xl">Team Naam:</span> {{$team->name}}</h1>
                <p><span class="font-semibold text-xl">Gemaakt door:</span> {{$team->user->name}}</p>
            </div>
            <a class="rounded-lg bg-blue-600 p-2" href="{{route('teams.edit', $team)}}">Bewerken</a>
        </div>
        @endforeach

    </div>
</x-base-layout>
