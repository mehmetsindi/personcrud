<?php

namespace App\Modules\Person\Controller;

use App\Helpers\Picker;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    use Picker;

    public function worker()
    {
        $fuseAction = $this->getFuseAction();

        $data = $this->pickUp();

        $error = $data['error'] ?? false;

        if ($fuseAction == 'update' || $fuseAction == 'delete' || $fuseAction == 'store') {
            return redirect('/person')->withErrors(['message' => $error]);
        }

        return view('client.customer.layout.' . $fuseAction)->with(['data' => $data]);
    }
}
