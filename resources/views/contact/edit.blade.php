@extends('template')
@section('body')

<div class="container justify-content-center col-6">
    
    @include('alerts')

    <div class="card">
        <div class="card-header text-center">
            Edit Contact
        </div>
        <form action="/people/contact/{{$contact->id}}/edit" method="get">
            @csrf
            @method('PUT')
            <div class="col px-3 mb-2">
                <div class="mb-2 mt-2">
                    <div class="input-group">
                        <input type="search" class="form-control rounded" placeholder="Search by country name" name="search"/>
                        <button type="submit" class="btn btn-outline-secondary">🔍</button>
                    </div>
                </div>
            </div>
        </form>
        <form action="/people/contact/update/{{$contact->id}}" method="post">
            @csrf
            @method('PUT')
            <div class="col px-3 mb-2">
                <div class="mb-2">
                    <label for="country_code" class="small">Country Code *</label>
                    <select class="form-control" name="country_code" id="country_code" required>
                        <option value="">---</option>
                        @foreach ($countryCodes as $item)
                            @php
                                $root = $item['idd']['root'] ?? '';
                                $suffixes = $item['idd']['suffixes'][0] ?? '';
                            @endphp
                            <option value="{{$root.$suffixes}}" 
                            @if ($contact->country_code == $root.$suffixes)
                                selected
                            @endif>{{$item['name']['common'] ?? ''}} ({{$root.$suffixes}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label for="number" class="small">Phone Number *</label>
                    <input class="form-control" maxlength="9" type="text" value="{{$contact->number}}" name="number" id="number" placeholder="99999-9999" required>
                </div>
            </div>
            <div class="col px-3 text-center mb-2">
                <button type="submit" class="btn btn-outline-secondary">Save</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById('number').addEventListener('blur', function (e) {
    var x = e.target.value.match(/(\d{4})(\d{4})/);
    e.target.value = x[1] + '-' + x[2];
    });
</script>
@endsection