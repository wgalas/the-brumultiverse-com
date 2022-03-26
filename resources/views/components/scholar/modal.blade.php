@props(['id' => \Str::random(16), 'button' => 'open modal', 'extra' => '', 'noButton' => false])

<!-- The button to open modal -->
<div class="mt-4">
    @if ($noButton)
    {{$trigger}}
    @else
        <label for="{{$id}}" class="btn {{$extra}} modal-button btn-sm m-1">{{$button}}</label>
    @endif
</div>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="{{$id}}" class="modal-toggle">
<div class="modal">
    <div class="modal-box relative">
        <label for="{{$id}}" class="absolute top-2 right-2">
            <img src="/img/icons/crud/x.svg" alt="">
        </label>
    {{$slot}}
  </div>
</div>