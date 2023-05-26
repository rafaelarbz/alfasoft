<div class="container justify-content-center col-6">
    
    @include('alerts')

    <div class="card">
        <div class="card-header text-center">
            Edit People 
        </div>
        <form action="/people/update/{{$people->id}}" method="post">
            @csrf
            @method('PUT')
            <div class="col px-3 mb-2">
                <input type="hidden" name="id" value="{{$people->id}}">
                <div class="mb-2 mt-2">
                    <label for="name" class="small">Name *</label>
                    <input class="form-control" type="text" value="{{$people->name}}" name="name" id="name" placeholder="People Name" required>
                </div>
                <div class="mb-2">
                    <label for="email" class="small">E-mail</label>
                    <input class="form-control" type="email" value="{{$people->email}}" name="email" id="email" placeholder="E-mail">
                </div>
            </div>
            <div class="col px-3 text-center mb-2">
                <button type="submit" class="btn btn-outline-secondary">Save</button>
            </div>
        </form>
    </div>
</div>