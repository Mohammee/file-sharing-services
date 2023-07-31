<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 d-flex justify-content-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div  class="p-6 text-gray-900 dark:text-gray-100" >
                    <a href="{{ route('medias.create') }}" @class(['hover:text-gray-400'])>Upload File</a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('medias.index') }}" @class(['hover:text-gray-400'])>Your Files</a>
                </div>
            </div>
        </div>


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('medias.create') }}" @class(['hover:text-gray-400'])>Download File</a>
                </div>
            </div>
        </div>

        <x-slot name="footer" >
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                &copy{!!  date('Y') . '<strong class="text-green-600">Mohammad Abusultan</strong>' !!}
            </h2>
        </x-slot>
    </div>
</x-app-layout>
