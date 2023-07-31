<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{ url('/') }}" class="hover:text-gray-400">{{ __('Dashboard') }}</a>
        </h2>
    </x-slot>

    <x-alert />
    <div class="py-12 d-flex justify-content-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="col-md-12 d-flex justify-content-center">
                <img  src="{{ asset('upload.jpeg') }}" alt="upload" @class(['img-fluid w-20 rounded-5'])>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('medias.update', $media->id) }}" class="form" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                       @include('medias._form', ['btnName' => 'Save'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
