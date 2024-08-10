<div x-data="{ open: false }" class="flex">
    <button @click="open = !open" class="p-4 absolute top-17 left-4 md:hidden z-10">
        <!-- Icon for toggle button -->
        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
    </button>

    <aside :class="open ? 'block' : 'hidden'" class="fixed md:relative md:block bg-gray-800 text-white w-64 h-screen">
        <div class="p-4">
            <h2 class="text-lg font-semibold">Dashboard</h2>
        </div>
        <nav class="px-4">
            <ul>
                <li class="my-2">
                    <a href="{{ route('account.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">
                        Account Manager
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{ route('employee.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">
                        Employee Manager
                    </a>
                </li>
                <li class="my-2">
                    <a href="{{ route('schedule.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">
                        Work Schedules Manager
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="flex-1 p-4 md:ml-64">
        {{ $slot }}
    </div>
</div>