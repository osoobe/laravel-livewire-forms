@php
    $name = $props['prefix'] . $props['name'];
    $attributes = $attributes->class([
        'form-control',
        'form-control-sm' => $props['small'],
        'form-control-lg' => $props['large'],
        'is-invalid' => $errors->has($name),
    ])->merge(array_merge($attrs, ['id' => $name]));

    $inputValue = $this->data('text', '');
@endphp

<div class="{{ !$props['prefix'] ? 'mb-3' : '' }}">
    @isset($props['label'])
        <label for="{{ $name }}" class="form-label">
            {{ __($props['label']) }}
        </label>
    @endisset

    {{-- <textarea {{ $attributes }} wire:model{{ $props['model'] ?? '' }}="data.{{ $name }}"></textarea> --}}
    {{-- <x-input.tinymce  wire:model{{ $props['model'] ?? '' }}="data.{{ $name }}" placeholder="Type anything you want..." /> --}}
    {{-- <x-input.tinymce wire:model.defer="data.{{ $name }}" placeholder="Type anything you want..." /> --}}
    {{-- {{ dd($props['model']) }} --}}
    <div
        {{-- x-data="{ value: '' }" --}}
        x-data="{ value: '{{ $inputValue }}' }"
        x-init="
            {{-- console.log('console', @this); --}}
            tinymce.init({
                target: $refs.tinymce,
                themes: 'modern',
                height: 200,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                setup: function(editor) {
                    editor.on('blur', function(e) {
                        value = editor.getContent();
                        {{-- document.querySelector('#field_data_{{ $name }}').value = value; --}}
                        @this.set('data.text', value);
                    })

                    editor.on('init', function (e) {
                        if (value != null) {
                            editor.setContent(value)
                        }
                    })

                    function putCursorToEnd() {
                        editor.selection.select(editor.getBody(), true);
                        editor.selection.collapse(false);
                    }

                    $watch('value', function (newValue) {
                        if (newValue !== editor.getContent()) {
                            editor.resetContent(newValue || '');
                            putCursorToEnd();
                        }
                    });
                }
            })
        "
    >
        <div >
            <input
                x-ref="tinymce"
                x-bind:value="value"
                type="textarea"
                {{ $attributes }}
                {{-- {{ $attributes->whereDoesntStartWith('wire:model') }} --}}
                {{-- wire:model.defer="data.{{ $name }}" --}}
                {{-- wire:model.defer="data.text" --}}
            >
            {{-- {{ dd($attributes) }} --}}
            {{-- <input type="text" id="field_data_{{ $name }}" wire:model.defer="data.{{ $name }}" /> --}}
        </div>
    </div>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @isset($props['help'])
        <div class="form-text">{{ __($props['help']) }}</div>
    @endisset
</div>
