<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreFcmTokenRequest;
use App\Http\Resources\AuthUserResource;
use App\Http\Resources\LocationsResource;
use App\Services\AuthService;
use App\Services\LocationService;
use App\Services\LocationsService;
use Exception;
use Illuminate\Support\Facades\Auth;

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

    public function getLocationByParentId($id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $locations = $this->locationService->getLocationDescendants(location_id: $id);
        return LocationsResource::collection($locations);
    }
}
