<?php

/**
 * Generic checker
 */
function can(array $levels): bool
{
    $level = session('level');
    return $level && in_array($level, $levels);
}

/**
 * CRUD helpers (sesuai modul)
 */
function canCreate(string $module): bool
{
    return match ($module) {
        'pekerjaan'     => can([1]),
        'produksi'      => can([1]),
        'data-engine'   => can([1]),
        'barang'        => can([1]),
        'maintenance'   => can([1,2]),
        default         => false,
    };
}

function canEdit(string $module): bool
{
    return canCreate($module);
}

function canDelete(string $module): bool
{
    return canCreate($module);
}

function canLog(string $module): bool
{
    return canLog($module);
}
