<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Work Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('schedule.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <x-label for="day_of_week" :value="__('Day of Week')" />
                        <select id="day_of_week" name="day_of_week" class="block mt-1 w-full">
                            <option value="">Select a day</option>
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                <option value="{{ $day }}" {{ old('day_of_week') == $day ? 'selected' : '' }}>
                                    {{ $day }}
                                </option>
                            @endforeach
                        </select>
                        @error('day_of_week')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-label for="start_time" :value="__('Start Time')" />
                        <x-input id="start_time" class="block mt-1 w-full" type="time" name="start_time" :value="old('start_time')" required />
                        @error('start_time')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-label for="end_time" :value="__('End Time')" />
                        <x-input id="end_time" class="block mt-1 w-full" type="time" name="end_time" :value="old('end_time')" required />
                        @error('end_time')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
