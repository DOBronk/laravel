<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Toon student') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Naam: {{ $student->name }} <br>
                    Geboortedatum: {{ \Carbon\Carbon::parse($student->dob)->format('d-m-Y') }}<br>
                    Ouders: <br>
                    @forelse($student->parents()->get() as $parent)
                        {{ $parent->name }}
                    @empty
                        Geen ouders gevonden
                    @endforelse
                    <br>Mentors: <br>
                    @forelse($student->mentors() as $mentor)
                        {{ $mentor->name }}
                    @empty
                        Geen mentors gevonden
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>