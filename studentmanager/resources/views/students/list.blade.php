<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table>
                        <tr>
                            <th style="text-align:left">{{ __('Name') }}</th>
                            <th style="text-align:left">{{ __('Date of birth') }}</th>
                            @if (Auth::user()->roles()->first()['name'] == 'ROLE_MENTOR' || Auth::user()->roles()->first()['name'] == 'ROLE_ADMIN')
                                <th style="text-align:left">{{ __('Email') }}</th>
                                <th style="text-align:left">{{ __('Phone') }}</th>
                            @endif
                        </tr>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($student->dob)->format('d-m-Y') }}</td>
                                @if (Auth::user()->roles()->first()['name'] == 'ROLE_MENTOR' || Auth::user()->roles()->first()['name'] == 'ROLE_ADMIN')
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->phone }}</td>
                                @endif
                            </tr>
                        @empty
                            <p>{{ __('No students found') }}</p>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
