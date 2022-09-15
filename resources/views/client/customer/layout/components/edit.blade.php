<form method="POST">
    @csrf
    <div class="modal-header">
        <h4 class="modal-title">Edit Person</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="{{$p->name}}" required>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <select class="form-control" name="gender">
                <option @selected($p->gender == 'male') value="male">Male</option>
                <option @selected($p->gender == 'female') value="female">Female</option>
                <option @selected($p->gender == 'other') value="other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label>Birthday</label>
            <input class="form-control" name="birthday" value="{{$p->birthday}}" />
            <input type="hidden" name="fuse" value="person" />
            <input type="hidden" name="fuseAction" value="update" />
            <input type="hidden" name="slug" value="{{$p->slug}}" />
        </div>
    </div>
    <div class="modal-footer">
        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
        <input type="submit" class="btn btn-info" value="Save">
    </div>
</form>



<div class="modal-header">
    <h4 class="modal-title">Edit Address</h4>
    @if(!is_null($p->address))
    <form method="POST">
        @include('client.customer.global.components.fuse_form', [
            'fuse' => 'address',
            'fuseAction' => 'delete',
        ])
        <input type="hidden" name="slug" value="{{$p->address->slug}}">
        <button class="btn btn-danger" type="submit"><i class="material-icons" data-toggle="tooltip"
                title="Delete">&#xE872;</i></button>
    </form>
    @endif
</div>
<form method="POST">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="address" value="{{$p->address->address ?? null}}" required>
        </div>
        <div class="form-group">
            <label>City</label>
            <input class="form-control" name="cityName" value="{{$p->address->city_name ?? null}}" />
            <input type="hidden" name="fuse" value="address" />
            @if(is_null($p->address))
            <input type="hidden" name="fuseAction" value="store" />
            <input type="hidden" name="personSlug" value="{{$p->slug}}" />
            @else
            <input type="hidden" name="fuseAction" value="update" />
            @endif
            <input type="hidden" name="slug" value="{{$p->address->slug ?? null}}" />
        </div>

        <div class="form-group">
            <label>Country</label>
            <input type="text" class="form-control" name="countryName" value="{{$p->address->country_name ?? null}}" required>
        </div>
    </div>
    <div class="modal-footer">
        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
        <input type="submit" class="btn btn-info" value="Save">
    </div>
</form>


