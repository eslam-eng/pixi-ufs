<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationsResource;
use App\Services\PushNotificationService;
use Illuminate\Http\Request;


class NotificationController extends Controller
{
    public function __construct(protected PushNotificationService $pushNotificationService)
    {
    }

    public function getNotifications()
    {
        try {
            $notifications = $this->pushNotificationService->getUserNotifications();
            return NotificationsResource::collection($notifications);
        } catch (\Exception $exception) {
            return apiResponse(message: $exception->getMessage(), code: 400);
        }
    }

    public function markAsRead(int $notification_id)
    {
        try {
            $this->pushNotificationService->markAsRead($notification_id);
            return apiResponse();
        } catch (\Exception $exception) {
            return apiResponse(message: 'there is an error', code: 400);
        }
    }

    public function sendFcmNotification(Request $request)
    {
        $tokens = [$request->fcm_token];
        app()->make(PushNotificationService::class)->sendToTokens('test', 'test',$tokens);
    }


//    send fcm to token
}
