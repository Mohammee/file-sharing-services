<x-text-input @class(['block my-2 w-full', 'form-control is-invalid' => $errors->has('title')]) type="text"
              name="title" :value="old('title', $media->title)"  required autofocus placeholder="Title"/>
<x-input-error :messages="$errors->get('title')" class="mt-2"/>

<x-text-input @class(['block my-2 w-full', 'form-control is-invalid' => $errors->has('descritpion')]) type="text"
              name="descritpion" :value="old('description', $media->description)"  autofocus placeholder="Description"/>
<x-input-error :messages="$errors->get('descritpion')" class="mt-2"/>


<x-text-input @class(['block my-3 w-full form-control', 'is-invalid' => $errors->has('file')]) type="file"
              name="file" />
<x-input-error :messages="$errors->get('file')" class="mt-2"/>

<div class="col-md-12 d-flex justify-content-center">
    <x-secondary-button @class(['text-center']) type="submit">{{ $btnName ?? 'Upload' }}</x-secondary-button>
</div>
