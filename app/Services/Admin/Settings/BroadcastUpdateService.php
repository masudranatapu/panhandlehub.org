<?php

namespace App\Services\Admin\Settings;

class BroadCastUpdateService
{
    public function update($request){
        $request->validate([
            'pusher_app_id' => 'required',
            'pusher_app_key' => 'required',
            'pusher_app_secret' => 'required',
            'pusher_app_cluster' => 'required',
        ]);

        checkSetEnv('PUSHER_APP_ID', $request->pusher_app_id);
        checkSetEnv('PUSHER_APP_KEY', $request->pusher_app_key);
        checkSetEnv('PUSHER_APP_SECRET', $request->pusher_app_secret);
        checkSetEnv('PUSHER_APP_CLUSTER', $request->pusher_app_cluster);
    }
}
