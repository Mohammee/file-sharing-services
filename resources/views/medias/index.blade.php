<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{ url('/') }}" class="hover:text-gray-400">{{ __('Dashboard') }}</a>
        </h2>
    </x-slot>

    <x-alert/>
    <x-alert message="error" @class(['alert alert-danger'])/>
    <div class="container">
        <div class="py-12 row">
            @forelse($medias as $media)
                <div class="mx-1 card col-md-3">
                    <div class="card-body">
                        <label class="col-form-label mb-2 d-block">Title: <strong
                                class="text-info">{{ $media->title }}</strong></label>
                        <label class="col-form-label mb-2 d-block">Description: <strong
                                class="text-info">{{ $media->description }}</strong></label>
                        <label class="col-form-label mb-2 d-block">Shared Url: <strong class="text-info"
                                                                                       id="link-{{ $media->id }}">
                                <x-text-input value="{{ $media->downloadLink }}" disabled />
                            </strong></label>

                        <div class="d-flex justify-between">
                            <x-primary-button data-url="{{ route('medias.show-file',[$media->code, $media->file]) }}" class="showButton">Show</x-primary-button>
                            <a href="{{ route('medias.edit', $media->id) }}"><x-secondary-button >Edit</x-secondary-button></a>
                        </div>
                        <form action="{{ route('medias.destroy', $media->id) }}" method="post" @class(['m-2'])>
                            @csrf
                            @method('DELETE')
                            <x-danger-button class="w-100 text-center">Delete</x-danger-button>
                        </form>
                    </div>
                </div>

            @empty
                <h3 class="text-center text-info">YOU DON'T HAVE ENY FILE UPLOADED.</h3>
            @endforelse
        </div>
    </div>

    @push('extra-js')
        <script>
            $(document).ready(function () {

                $('.showButton').click(function(){
                   window.open($(this).data('url'), '_blank');
                });

                // $('.copyButton').click(function () {
                //     navigator.clipboard.writeText('textToCopy').then(
                //         function () {
                //             /* clipboard successfully set */
                //             window.alert('Success! The text was copied to your clipboard')
                //         },
                //         function () {
                //             /* clipboard write failed */
                //             window.alert('Opps! Your browser does not support the Clipboard API')
                //         }
                //     )
                //     // // Select the text content of the element
                //     // $id = $(this).data('id');
                //     // var textToCopy = document.getElementById('#link-' + $id)
                //     // var range = document.createRange();
                //     // range.selectNode(textToCopy);
                //     // window.getSelection().removeAllRanges();
                //     // window.getSelection().addRange(range);
                //     //
                //     // // Copy the selected text to the clipboard
                //     // document.execCommand('copy');
                //     //
                //     // // Clean up by deselecting the text
                //     // window.getSelection().removeAllRanges();
                //     //
                //     // // Optionally, display a message to indicate that the text has been copied
                //     // alert('Data copied to clipboard: ' + textToCopy.textContent);
                // });
            });
        </script>
    @endpush
</x-app-layout>
