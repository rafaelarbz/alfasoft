@extends('template')
@section('body')

<div class="container justify-content-center col-6">

    @include('alerts')

    @if (count($peoples) > 0)
        <div class="card">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>NAMES</th>
                        <th class="text-end">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peoples as $people)
                        <tr>
                            <td>{{$people->name}}</td>
                            <td class="text-end">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a style="border-radius: 15px" href="/people/{{$people->id}}/details" class="btn btn-outline-secondary btn-sm" title="Details"><i class="fa fa-plus"></i></a>
                                    <a style="border-radius: 15px" href="/people/{{$people->id}}/edit" class="btn btn-outline-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <form action="/people/delete/{{$people->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button style="border-radius: 15px" type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash-o" title="Delete"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        No peoples...
    @endif
</div>

@endsection