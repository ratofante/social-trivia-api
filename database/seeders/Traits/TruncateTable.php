<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait TruncateTable
{
    protected function truncate($table)
    {
        DB::Table($table)->truncate();
    }
}