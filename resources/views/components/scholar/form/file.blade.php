@props(['accept' => '', 'label' => '', 'name' => '', 'help' => '', 'placeholder' => '', 'required' => true])
<div>
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text">
                    {{$label}}
                @if ($required)
                    <span class="text-red-600">
                        *
                    </span>
                @else
                <span class="text-sm">(optional)</span>
                @endif
            </span>
        </label>
        <input
        accept="{{$accept}}"
        name="{{$name}}"
        @if($required)
            required
        @endif
        type="file"
        placeholder="{{$placeholder ?? $label}}"
        class="w-full @error($name) input-error @enderror"
        >

        @error($name)
            <span class="text-red-600">{{$message}}</span>
        @enderror
        <div class="label">
            <span class="label-text-alt">{!!$help!!}</span>
        </div>
    <x-scholar.form.copyright-disclaimer/>
    </div>
</div>
