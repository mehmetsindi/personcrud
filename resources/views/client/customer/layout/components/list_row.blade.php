<tr>
    <td>
    </td>
    <td>{{ $p->name }}</td>
    <td>{{ $p->address->address ?? '' }}</td>
    <td>{{ $p->address->city_name ?? '' }}</td>
    <td>{{ $p->address->country_name ?? '' }}</td>
    <td>
        <form method="POST">
            @include('client.customer.global.components.fuse_form', [
                'fuse' => 'person',
                'fuseAction' => 'read',
            ])
            <input type="hidden" name="slug" value="{{$p->slug}}">
            <button class="btn btn-success" type="submit"><i class="material-icons" data-toggle="tooltip"
                    title="Edit">&#xE254;</i></button>
        </form>

        <form method="POST">
            @include('client.customer.global.components.fuse_form', [
                'fuse' => 'person',
                'fuseAction' => 'delete',
            ])
            <input type="hidden" name="slug" value="{{$p->slug}}">
            <button class="btn btn-danger" type="submit"><i class="material-icons" data-toggle="tooltip"
                    title="Edit">&#xE872;</i></button>
        </form>
    </td>
</tr>
