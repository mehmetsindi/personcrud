<?php

namespace App\Modules\Address\Controller;

use App\Helpers\Picker;
use App\Http\Controllers\Controller;


class AddressController extends Controller
{
    use Picker;

    public function worker()
    {
        return $this->pickUp();
    }
}
