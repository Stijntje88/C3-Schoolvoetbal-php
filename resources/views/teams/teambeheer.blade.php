<x-base-layout>
    <div class="container mx-auto px-4 py-6 grid grid-cols-3 gap-6">
        <!-- Linkerzijde: Lijst met teams -->
        <div class="col-span-2">
            <h2 class="text-xl font-bold mb-4">Bestaande Teams</h2>
            <ul class="bg-white shadow-md rounded p-4 space-y-2">
                @forelse($teams as $team)
                    <li class="border-b last:border-none pb-2">
                        <h3 class="text-lg font-semibold">{{ $team->name }}</h3>
                        <p class="text-sm text-gray-600">Gemaakt door: {{ $team->user->name }}</p>
                    </li>
                @empty
                    <li class="text-gray-500">Er zijn nog geen teams aangemaakt.</li>
                @endforelse
            </ul>
        </div>

        <!-- Rechterzijde: Formulier om een nieuw team aan te maken -->
        <div>
            <h2 class="text-xl font-bold mb-4">Team Aanmaken</h2>
            <form method="POST" action="{{ route('teams.store') }}" class="bg-white shadow-md rounded p-4">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Teamnaam</label>
                    <input type="text" id="name" name="name"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Team Aanmaken
                </button>
            </form>
        </div>
    </div>
</x-base-layout>
