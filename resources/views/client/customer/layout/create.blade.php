@extends('client.customer.global.container.wrapper')
@section('wrapper')
<form method="POST">
    @csrf
    <div class="modal-header">
        <h4 class="modal-title">Add Person</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <select class="form-control" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label>Birthday</label>
            <input class="form-control" name="birthday" />
            <input type="hidden" name="fuse" value="person" />
            <input type="hidden" name="fuseAction" value="store" />
        </div>
    </div>
    <div class="modal-footer">
        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
        <input type="submit" class="btn btn-info" value="Save">
    </div>
</form>
@endsection
