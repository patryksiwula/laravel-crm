<div class="md:flex w-60 fixed h-screen bg-slate-700">
    <nav x-data="{ open: false }" class="w-full h-full">
        <div class="bg-slate-800 border-slate-900 text-white text-center font-bold py-5 text-xl">
            <h2>{{ __('Laravel CRM') }}</h2>
        </div>
        <ul class="h-[calc(100%-8rem)]">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <svg viewBox="0 0 24 25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" stroke="none">
                    <path d="m23.9 11.437a12 12 0 0 0 -23.9 1.563 11.878 11.878 0 0 0 3.759 8.712 4.84 4.84 0 0 0 3.354 1.288h9.767a4.994 4.994 0 0 0 3.509-1.429 11.944 11.944 0 0 0 3.511-10.134zm-16.428 8.224a1 1 0 0 1 -1.412.09 8.993 8.993 0 0 1 5.94-15.751 9.1 9.1 0 0 1 2.249.283 1 1 0 1 1 -.5 1.938 6.994 6.994 0 0 0 -6.367 12.028 1 1 0 0 1 .09 1.412zm4.528-4.661a2 2 0 1 1 .512-3.926l3.781-3.781a1 1 0 1 1 1.414 1.414l-3.781 3.781a1.976 1.976 0 0 1 -1.926 2.512zm5.94 4.751a1 1 0 0 1 -1.322-1.5 6.992 6.992 0 0 0 2.161-7 1 1 0 1 1 1.938-.5 9.094 9.094 0 0 1 .283 2.249 9 9 0 0 1 -3.06 6.751z"/>
                </svg>
                <span class="font-sans text-sm">{{ __('Dasboard') }}</span>
            </x-nav-link>
            <x-nav-link :href="route('users.index')" :active="request()->routeIs('users*')">
                <svg viewBox="0 0 24 25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" stroke="none">
                    <path d="M12,12A6,6,0,1,0,6,6,6.006,6.006,0,0,0,12,12ZM12,2A4,4,0,1,1,8,6,4,4,0,0,1,12,2Z"/>
                    <path d="M12,14a9.01,9.01,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.01,9.01,0,0,0,12,14Z"/>
                </svg>
                <span class="font-semibold text-sm">{{ __('Users') }}</span>
            </x-nav-link>
            <x-nav-link :href="'#'" :active="false">
                <svg viewBox="0 0 24 25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" stroke="none">
                    <path d="m19 4h-4v-1a3 3 0 0 0 -6 0v1h-4a5.006 5.006 0 0 0 -5 5v10a5.006 5.006 0 0 0 5 5h14a5.006 5.006 0 0 0 5-5v-10a5.006 5.006 0 0 0 -5-5zm-8-1a1 1 0 0 1 2 0v2a1 1 0 0 1 -2 0zm11 16a3 3 0 0 1 -3 3h-14a3 3 0 0 1 -3-3v-10a3 3 0 0 1 3-3h4.184a2.982 2.982 0 0 0 5.632 0h4.184a3 3 0 0 1 3 3zm-12-9h-5a1 1 0 0 0 -1 1v8a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-8a1 1 0 0 0 -1-1zm-1 8h-3v-6h3zm11-3a1 1 0 0 1 -1 1h-5a1 1 0 0 1 0-2h5a1 1 0 0 1 1 1zm0-4a1 1 0 0 1 -1 1h-5a1 1 0 0 1 0-2h5a1 1 0 0 1 1 1zm-2 8a1 1 0 0 1 -1 1h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 1 1z"/>
                </svg>
                <span class="font-semibold text-sm">{{ __('Clients') }}</span>
            </x-nav-link>
            <x-nav-link :href="'#'" :active="false">
                <svg viewBox="0 0 24 25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" stroke="none">
                    <path d="M21.155,3.272,18.871.913A3.02,3.02,0,0,0,16.715,0H12A5.009,5.009,0,0,0,7.1,4H7A5.006,5.006,0,0,0,2,9V19a5.006,5.006,0,0,0,5,5h6a5.006,5.006,0,0,0,5-5v-.1A5.009,5.009,0,0,0,22,14V5.36A2.988,2.988,0,0,0,21.155,3.272ZM13,22H7a3,3,0,0,1-3-3V9A3,3,0,0,1,7,6v8a5.006,5.006,0,0,0,5,5h4A3,3,0,0,1,13,22Zm4-5H12a3,3,0,0,1-3-3V5a3,3,0,0,1,3-3h4V4a2,2,0,0,0,2,2h2v8A3,3,0,0,1,17,17Z"/>
                </svg>
                <span class="font-semibold text-sm">{{ __('Projects') }}</span>
            </x-nav-link>
            <x-nav-link :href="'#'" :active="false">
                <svg viewBox="0 0 24 25" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" stroke="none">
                    <path d="m4 6a2.982 2.982 0 0 1 -2.122-.879l-1.544-1.374a1 1 0 0 1 1.332-1.494l1.585 1.414a1 1 0 0 0 1.456.04l3.604-3.431a1 1 0 0 1 1.378 1.448l-3.589 3.414a2.964 2.964 0 0 1 -2.1.862zm20-2a1 1 0 0 0 -1-1h-10a1 1 0 0 0 0 2h10a1 1 0 0 0 1-1zm-17.9 9.138 3.589-3.414a1 1 0 1 0 -1.378-1.448l-3.6 3.431a1.023 1.023 0 0 1 -1.414 0l-1.59-1.585a1 1 0 0 0 -1.414 1.414l1.585 1.585a3 3 0 0 0 4.226.017zm17.9-1.138a1 1 0 0 0 -1-1h-10a1 1 0 0 0 0 2h10a1 1 0 0 0 1-1zm-17.9 9.138 3.585-3.414a1 1 0 1 0 -1.378-1.448l-3.6 3.431a1 1 0 0 1 -1.456-.04l-1.585-1.414a1 1 0 0 0 -1.332 1.494l1.544 1.374a3 3 0 0 0 4.226.017zm17.9-1.138a1 1 0 0 0 -1-1h-10a1 1 0 0 0 0 2h10a1 1 0 0 0 1-1z"/>
                </svg>
                <span class="font-semibold text-sm">{{ __('Tasks') }}</span>
            </x-nav-link>
        </ul>

        <form action="{{ route('logout') }}" method="POST" class="flex h-16 bg-slate-800 text-white">
            @csrf

            <button type="submit" class="flex space-x-2 align-middle items-center w-full h-full text-left pl-4 cursor-pointer hover:border-slate-400 hover:border-l-8 duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6" fill="currentColor">
                    <path d="M22.829,9.172,18.95,5.293a1,1,0,0,0-1.414,1.414l3.879,3.879a2.057,2.057,0,0,1,.3.39c-.015,0-.027-.008-.042-.008h0L5.989,11a1,1,0,0,0,0,2h0l15.678-.032c.028,0,.051-.014.078-.016a2,2,0,0,1-.334.462l-3.879,3.879a1,1,0,1,0,1.414,1.414l3.879-3.879a4,4,0,0,0,0-5.656Z"/>
                    <path d="M7,22H5a3,3,0,0,1-3-3V5A3,3,0,0,1,5,2H7A1,1,0,0,0,7,0H5A5.006,5.006,0,0,0,0,5V19a5.006,5.006,0,0,0,5,5H7a1,1,0,0,0,0-2Z"/>
                </svg>

                <span>
                    {{ __('Logout') }}
                </span>
            </button>
        </form>
    </nav>
</div>