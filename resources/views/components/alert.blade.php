@props(['message' => 'success', 'class'])

@if(session()->has($message))
    <div {{ $attributes->merge(['class' => $class ?? 'alert alert-success']) }}>
    <strong>{{ session()->get($message) }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
