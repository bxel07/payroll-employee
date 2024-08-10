<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('employee.update', $employee) }}">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $employee->name)" required autofocus />
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mt-4">
                        <x-label for="address" :value="__('Address')" />
                        <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $employee->address)" />
                        @error('address')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="mt-4">
                        <x-label for="phone_number" :value="__('Phone Number')" />
                        <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number', $employee->phone_number)" />
                        @error('phone_number')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Position -->
                    <div class="mt-4">
                        <x-label for="position" :value="__('Position')" />
                        <x-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position', $employee->position)" required />
                        @error('position')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Hire Date -->
                    <div class="mt-4">
                        <x-label for="hire_date" :value="__('Hire Date')" />
                        <x-input id="hire_date" class="block mt-1 w-full" type="date" name="hire_date" :value="old('hire_date', $employee->hire_date->format('Y-m-d'))" required />
                        @error('hire_date')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="my-6 border-t border-gray-300"></div>

                    <!-- Base Salary -->
                    <div class="mt-4">
                        <x-label for="base_salary" :value="__('Base Salary')" />
                        <x-input id="base_salary" class="block mt-1 w-full" type="number" name="base_salary" :value="old('base_salary', $employee->salary->base_salary ?? 0)" step="0.01" min="0" />
                        @error('base_salary')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Allowance -->
                    <div class="mt-4">
                        <x-label for="allowance" :value="__('Allowance')" />
                        <x-input id="allowance" class="block mt-1 w-full" type="number" name="allowance" :value="old('allowance', $employee->salary->allowance ?? 0)" step="0.01" min="0" />
                        @error('allowance')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Work Schedules -->
                    <div class="mt-4">
                        <x-label for="work_schedules" :value="__('Work Schedules')" />
                        @foreach($workSchedules as $schedule)
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox" name="work_schedules[]" value="{{ $schedule->id }}"
                                           {{ in_array($schedule->id, old('work_schedules', $employee->workSchedules->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    <span class="ml-2">
                                        {{ __('Day') }}: {{ $schedule->day_of_week }},
                                        {{ __('Start') }}: {{ $schedule->start_time }}, 
                                        {{ __('End') }}: {{ $schedule->end_time }}
                                    </span>
                                </label>
                            </div>
                        @endforeach
                        @error('work_schedules')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Update Employee') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
