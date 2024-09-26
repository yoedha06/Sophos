<?php

namespace App\Helpers;

use App\Models\Computer;
use App\Models\Event;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class SophosHelper
{
    public SettingHelper $setting;
    public function __construct()
    {
        $this->setting = (new SettingHelper);
    }

    public function request($url)
    {
        return Http::baseUrl($url);
    }

    public function createToken()
    {
        return Http::asForm()->post('https://id.sophos.com/api/v2/oauth2/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $this->setting()->client_id,
            'client_secret' => $this->setting()->client_secret,
            'scope' => 'token',
        ]);
    }

    public function getWhoAmI()
    {
        $requestWhoAmI = $this->request('https://api.central.sophos.com')->withToken($this->setting()->access_token)->get('/whoami/v1');

        $error = $requestWhoAmI->json()['error'] ?? null;
        if($error == 'Unauthorized'){

            $token = $this->createToken();
            
           SettingHelper::setByKey('access_token', $token->json()['access_token'] ?? null);
        }

        if ($requestWhoAmI->ok()) {
            Tenant::updateOrCreate([
                'id_tenant' => $requestWhoAmI->json()['id'],
            ], [
                'id_tenant' => $requestWhoAmI->json()['id'],
                'type' => $requestWhoAmI->json()['idType'],
                'api_host' => $requestWhoAmI->json()['apiHosts'],
            ]);
        }

        return $requestWhoAmI;

    }

    public function getEndpoint()
    {
        $tenant = Tenant::first();
        $requestEndpoint = Http::baseUrl('https://api-au01.central.sophos.com')
            ->withToken($this->setting()->access_token)
            ->withHeader('X-Tenant-ID' , $tenant->id_tenant)
            ->get('/endpoint/v1/endpoints');

        $error = $requestEndpoint->json()['error'] ?? null;
        if($error == 'Unauthorized'){

            $token = $this->createToken();
            
           SettingHelper::setByKey('access_token', $token->json()['access_token'] ?? null);
           $requestEndpoint = Http::baseUrl('https://api-au01.central.sophos.com')
            ->withToken($this->setting()->access_token)
            ->withHeader('X-Tenant-ID' , $tenant->id_tenant)
            ->get('/endpoint/v1/endpoints');

            if($requestEndpoint->ok()){
                $items = collect($requestEndpoint->json()['items']);
                foreach($items as $item)
                    Computer::updateOrCreate([
                        'id_computer' => $item['id'],
                    ],[
                        'id_computer' => $item['id'],
                        'type' => $item['type'],
                        'tenant_id' => $item['tenant']['id'],
                        'hostname' => $item['hostname'],
                        'health_overall_status' => $item['health']['overall'],
                        'health_threats_status' => $item['health']['threats']['status'],
                        'health_service_status' => $item['health']['services']['status'],
                        'health_service_details' => $item['health']['services']['serviceDetails'],
                        'operating_system' => $item['os'],
                        'ipv4_addresses' => $item['ipv4Addresses'],
                        'mac_addresses' => $item['macAddresses'],
                        'group' => $item['group'] ?? null,
                        'assosiated_person' => $item['associatedPerson'],
                        'tamper_protection_enabled' => $item['tamperProtectionEnabled'],
                        'assigned_products' => $item['assignedProducts'],
                        'last_seen_at' => $item['lastSeenAt'],
                        'encryption' => $item['encryption'],
                        'isolation' => $item['isolation'],
                    ]);
            }
            return $requestEndpoint;
        }

        if($requestEndpoint->ok()){
            $items = collect($requestEndpoint->json()['items']);
            foreach($items as $item)
                Computer::updateOrCreate([
                    'id_computer' => $item['id'],
                ],[
                    'id_computer' => $item['id'],
                    'type' => $item['type'],
                    'tenant_id' => $item['tenant']['id'],
                    'hostname' => $item['hostname'],
                    'health_overall_status' => $item['health']['overall'],
                    'health_threats_status' => $item['health']['threats']['status'],
                    'health_service_status' => $item['health']['services']['status'],
                    'health_service_details' => $item['health']['services']['serviceDetails'],
                    'operating_system' => $item['os'],
                    'ipv4_addresses' => $item['ipv4Addresses'],
                    'mac_addresses' => $item['macAddresses'],
                    'group' => $item['group'] ?? null,
                    'assosiated_person' => $item['associatedPerson'],
                    'tamper_protection_enabled' => $item['tamperProtectionEnabled'],
                    'assigned_products' => $item['assignedProducts'],
                    'last_seen_at' => $item['lastSeenAt'],
                    'encryption' => $item['encryption'],
                    'isolation' => $item['isolation'],
                ]);
        }

        return $requestEndpoint;
    }

    public function getEvent()
    {
        $tenant = Tenant::first();
        $requestEndpoint = Http::baseUrl('https://api-au01.central.sophos.com')
            ->withToken($this->setting()->access_token)
            ->withHeader('X-Tenant-ID', $tenant->id_tenant)
            ->get('/siem/v1/events');
        
        $error = $requestEndpoint->json()['error'] ?? null;
        if($error == 'Unauthorized'){

            $token = $this->createToken();
            
            SettingHelper::setByKey('access_token', $token->json()['access_token'] ?? null);
        }

        if($requestEndpoint->ok())
        {
            $items = collect($requestEndpoint->json()['items']);
            foreach($items as $item)
                Event::updateOrCreate([
                    'id_event' => $item['id'],
                ],[
                    'id_event' => $item['id'],
                    'source' => $item['source'],
                    'type' => $item['type'],
                    'severity' => $item['severity'],
                    'event_create_at' => Carbon::parse($item['created_at']),
                    'source_info' => $item['source_info']['ip'],
                    'customer_id' => $item['customer_id'],
                    'computer_id' => $item['endpoint_id'],
                    'endpoint_type' => $item['endpoint_type'],
                    'user_id' => $item['user_id'],
                    'when' => Carbon::parse($item['when']),
                    'name' => $item['name'],
                    'location' => $item['location'],
                    'group' => $item['group'],
                ]);
        }

        return $requestEndpoint;
    }

    private function setting()
    {
        return SettingHelper::data();
    }
}