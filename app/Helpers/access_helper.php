<?php

function canAccess(array $allowedLevels): bool
{
    $level = session('level');
    return $level && in_array($level, $allowedLevels);
}

/**
 * Cek menu aktif berdasarkan URL
 */
function isActive(string $url): string
{
    return url_is(ltrim($url, '/') . '*') ? 'active' : '';
}

/**
 * Cek apakah group menu harus terbuka
 */
function isGroupOpen(array $children): bool
{
    foreach ($children as $child) {
        if (isset($child['url']) && url_is(ltrim($child['url'], '/') . '*')) {
            return true;
        }
    }
    return false;
}


