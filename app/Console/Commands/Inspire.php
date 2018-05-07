<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Inspire extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Scheduled SMS';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $numbers = \App\TargetNumber::where('send_type', '!=', '0')->get();
        if ($numbers) {
            $list = PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL . 'New Task Has been started on ' . date('Y-m-d H:i:s') . PHP_EOL . PHP_EOL;
            foreach ($numbers as $num) {
                $sendFlag = $num->proccessSchedule();
                $list .= $num->id . ' => ' . $sendFlag . PHP_EOL;
            }
            echo $list;
        } else {
            echo 'There is no scheduled SMS.';
        }
    }

}
