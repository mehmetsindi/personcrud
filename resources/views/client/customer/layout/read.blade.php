@extends('client.customer.global.container.wrapper')
@section('wrapper')

    @if(session()->has('errors'))
    <div class="alert alert-danger" role="alert">
        {{session('errors')->first('message')}}
      </div>
    @endif


    <div class="table-title">
        <div class="row">
            <div class="col-sm-6">
                <h2>Manage <b>Person</b></h2>
            </div>
            <div class="col-sm-6">
                <form method="POST">
                    @include('client.customer.global.components.fuse_form', [
                        'fuse' => 'person',
                        'fuseAction' => 'create',
                    ])
                    <button class="btn btn-success" type="submit">Add Person</button>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th></th>
                <th>
                    <form method="POST">
                        @include('client.customer.global.components.fuse_form', [
                            'fuse' => 'person',
                            'fuseAction' => 'read',
                        ])
                        <input type="hidden" name="sort" value="asc">
                        <input type="hidden" name="sortTitle" value="name">
                        <button class="btn btn-default" type="submit">Name</button>
                    </form>
                </th>
                <th>Address</th>
                <th>City</th>
                <th>Country</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($data->count() == 1)
                @each('client.customer.layout.components.edit', $data, 'p', 'client.customer.layout.components.no_row')
            @else
                @each('client.customer.layout.components.list_row', $data, 'p', 'client.customer.layout.components.no_row')
            @endif
        </tbody>
    </table>
    <div class="clearfix">
        <ul class="pagination">
            {{ $data->links() }}
        </ul>
    </div>
@endsection
@section('css')
@endsection
@section('js')
@endsection
