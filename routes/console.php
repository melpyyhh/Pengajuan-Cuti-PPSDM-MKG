<?php
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\UpdateMasaKerja;
use App\Console\Commands\UpdateSisaCuti;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
Schedule::command(UpdateMasaKerja::class)->yearly();
Schedule::command(UpdateSisaCuti::class)->yearly();
