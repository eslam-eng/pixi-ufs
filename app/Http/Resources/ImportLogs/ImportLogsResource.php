<?php

namespace App\Http\Resources\ImportLogs;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImportLogsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'created_by' => $this->created_name,
            'total_count' => $this->total_count,
            'field_count' => $this->failed_count,
            'status' => $this->status_text,
            'errors' => $this->errors,
        ];
    }
}
