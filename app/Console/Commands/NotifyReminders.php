<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Reminder;
use Telegram;
use Illuminate\Support\Carbon;

class NotifyReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reminders = Reminder::whereNotNull('tanggal')->get();
        foreach($reminders as $reminder) {
            $created = new Carbon($reminder->tanggal);
            $now = Carbon::now();

            if ($created->diff($now)->days < 30) {

                $text = "<u>A new Notification Message</u>\n"
                . "<b>From: </b>\n"
                . "Admin SARASA\n"
                . "<b>Subject: </b>\n"
                . $reminder->nama . "\n"
                . "<b>Message: </b>\n"
                . $reminder->deskripsi;

                $reminder->notify(
                    Telegram::sendMessage([
                        'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                        'parse_mode' => 'HTML',
                        'text' => $text
                    ])
                );
                
            } else {
                echo "Notifikasi belum bisa terkirim";
            }


        }
    }
}
