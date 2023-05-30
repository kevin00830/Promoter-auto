<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_messages')->insert([
            [
                'msg_type' => 'admin_alert_wifi',
                'msg_body' => '[admin_alert_wifi_body]',
            ],
            [
                'msg_type' => 'admin_alert_login',
                'msg_body' => '[admin_alert_login_body]',
            ],
            [
                'msg_type' => 'admin_alert_desktopapp',
                'msg_body' => '[admin_alert_desktopapp_body]',
            ]
        ]);
    }
}
