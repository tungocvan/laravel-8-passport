@php
    $number = (string) rand(100,999);
    $title = $options['title'] ?? '' ;
    $name = $options['name'] ?? 'name-'.$number;
    $selected = $options['selected'] ?? 'Open this select menu';
    $multiple = $options['multiple'] ?? '';
    $selectArray =$options['select'] ?? [['value' => '1','title' => 'One'],['value' => '2','title' => 'Two']];
    $value = $options['value'] ?? ''; 
@endphp
<div class="mb-2" style="padding: 5px">
    @if ($title !=='')
            <label class="form-label" for="{{ $name }}">{{ $title }}</label>
    @endif
    <select class="form-select" aria-label="Default select" name="{{ $name }}[]" {{ $multiple?'multiple':'' }}>
        @if ($selected =='Open this select menu')
            <option selected>Open this select menu</option>
        @endif
        @foreach ($selectArray as $item)
             <option {{ $item['value'] ==  $selected?'selected':'' }} value="{{$item['value']}}">{{$item['title']}}</option>
        @endforeach
    </select>
</div>