<?php

namespace Modules\Notifications\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Modules\Notifications\app\Models\Notification;
use Modules\Notifications\app\Resources\NotificationResource;

class NotificationsController extends Controller
{

    /**
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function __invoke(): AnonymousResourceCollection|JsonResponse
    {
        if (auth()->id() != 1){

            return json(
                __('Cannot access this page'),
                headerStatus: 401
            );
        }

        return NotificationResource::collection(Notification::paginate(9))->additional([
            'msg' => __('Retrieve 10 Notifications'),
            'status' => 'success'
        ]);
    }
}
