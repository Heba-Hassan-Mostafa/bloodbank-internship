<form action="{{url(route('governorate.store'))}}"  method="post">
    {{csrf_field()}}
    <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control" type="text" name="name" >
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Insert</button>
    </div>

</form>
