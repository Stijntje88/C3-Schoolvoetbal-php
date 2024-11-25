<x-base-layout>
    <div class="w-4/5 mx-auto">
        <h1 class="font-bold text-3xl mb-10">Edit tournament</h1>
        <form action="{{route('tournaments.update', $tournament )}}" method="post" class="border-2 p-6 shadow-lg">
            @csrf
            @method('PUT')

            <div class="flex flex-col mb-10">
                <label for="title">Tournament titel</label>
                <input type="text" name="title" id="title" value="{{$tournament->title}}">
            </div>

            <div class="flex flex-col mb-10">
                <label for="max_teams">Maximaal aantal teams dat aan dit toernooi mag bevatten</label>
                <input type="number" name="max_teams" id="max_teams" value="{{$tournament->max_teams}}">
            </div>

            <div class="mt-6">
                <input type="submit" value="Edit tournament" class="border-2 bg-blue-600 rounded-lg p-2 w-32">
            </div>
        </form>
    </div>
</x-base-layout>
