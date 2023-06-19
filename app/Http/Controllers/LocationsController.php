<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationsResource;
use App\Services\LocationsService;

class LocationsController extends Controller
{
    public function __construct(private LocationsService $locationService)
    {
        
    }

    public function getAllCities(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $governorates = $this->locationService->getAll(['depth' => 1]);
        return LocationsResource::collection($governorates);
    }

    public function getAllAreas(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $governorates = $this->locationService->getAll(['depth' => 2]);
        return LocationsResource::collection($governorates);
    }

    public function getLocationByParentId($id)
    {
        $locations = $this->locationService->getLocationDescendants(location_id: $id);
        return $locations;
    }
}
