<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\AddressService;

class AddressController extends Controller
{
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function getAddress($zip)
    {
        $address = $this->addressService->getAddressFromZip($zip);

        if ($address) {
            return response()->json($address);
        } else {
            return response()->json(['error' => 'CEP não encontrado'], 404);
        }
    }
}