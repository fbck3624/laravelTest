<?php

namespace App\Http\Traits;

use Carbon\Carbon;

trait MyModelTrait
{
    public function createdAt(string $createdAt)
    {
        // 使用 Carbon 解析 ISO 8601 時間戳
        $createdAt = Carbon::parse($createdAt);

        // 格式化日期和時間 'Y-m-d H:i:s'
        return $createdAt->format('Y-m-d H:i:s');
    }

    public function updatedAt(string $updatedAt)
    {
        // 使用 Carbon 解析 ISO 8601 時間戳
        $updatedAt = Carbon::parse($updatedAt);

        // 格式化日期和時間 'Y-m-d H:i:s'
        return $updatedAt->format('Y-m-d H:i:s');
    }
}
