@extends('template')
@section('body')
@php
    Route::current()->getName() == 'edit' ? $editable = true : $editable = false;
@endphp

@if ($editable == true)
    @include('edit')
@else
    <div class="container justify-content-between row">
        
        @include('alerts')

        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    Associated Contacts
                </div>
                <div class="col px-3 mb-2 mt-2">
                    <table class="table table-hover">
                        <tbody>
                            @foreach ($people->contacts as $item)
                                <tr>
                                    <td>{{$item->country_code}} {{$item->number}}</td>
                                    <td class="text-end">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <a style="border-radius: 15px" href="/people/contact/{{$item->id}}/edit" class="btn btn-outline-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <form action="/people/contact/delete/{{$item->id}}" method="post">
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
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header text-center">
                    <nav class="navbar bg-light">
                        <div class="container-fluid">
                            <a class="navbar-brand">People Details</a>
                            <div class="d-flex" role="search">
                                <a style="border-radius: 15px" href="/people/contact/{{$people->id}}/new" class="btn btn-outline-secondary btn-sm me-2" title="New Contact"><i class="fa fa-link"></i></a>
                                <a style="border-radius: 15px" href="/people/{{$people->id}}/edit" class="btn btn-outline-warning btn-sm me-2" title="Edit"><i class="fa fa-pencil"></i></a>
                                <form action="/people/delete/{{$people->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button style="border-radius: 15px" type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash-o" title="Delete"></i></button>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col px-3 mb-2">
                    <input type="hidden" name="id" value="{{$people->id}}">
                    <div class="mb-2 mt-2">
                        <label for="name" class="small">Name @if ($editable == true) * @endif</label>
                        <input class="form-control" type="text" value="{{$people->name}}" name="name" id="name" placeholder="People Name" required @if ($editable == false) readonly @endif>
                    </div>
                    <div class="mb-2">
                        <label for="email" class="small">E-mail</label>
                        <input class="form-control" type="email" value="{{$people->email}}" name="email" id="email" placeholder="E-mail" @if ($editable == false) readonly @endif>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection
