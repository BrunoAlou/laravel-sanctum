<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class AddressService
{
    public function getAddressFromZip(string $zip)
    {
        $url = "https://viacep.com.br/ws/{$zip}/json/";
        
        try {
            $response = Http::get($url);

            if ($response->successful() && !isset($response['erro'])) {
                return [
                    'logradouro' => $response['logradouro'],
                    'bairro' => $response['bairro'],
                    'localidade' => $response['localidade'],
                    'uf' => $response['uf']
                ];
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }
}
