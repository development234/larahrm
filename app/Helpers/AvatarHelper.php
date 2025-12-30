<?php

namespace App\Helpers;

class AvatarHelper
{
    public static function getGenderFromName($name)
    {
        $maleNames = ['budi', 'agus', 'adi', 'tono', 'joko', 'surya', 'david', 'michael', 'john', 'ryan', 'kevin', 'andi', 'rian', 'reza', 'fajar', 'ahmad', 'ali', 'bambang', 'doni', 'eko'];
        $femaleNames = ['sari', 'rini', 'dewi', 'lina', 'maya', 'sinta', 'lisa', 'sarah', 'maria', 'anna', 'diana', 'putri', 'amel', 'nina', 'ratna', 'siti', 'ayu', 'fitri', 'nurul', 'wati'];
        
        $firstName = strtolower(explode(' ', $name)[0]);
        
        if (in_array($firstName, $maleNames)) {
            return 'male';
        } elseif (in_array($firstName, $femaleNames)) {
            return 'female';
        } else {
            // Default ke male jika tidak dikenali
            return 'male';
        }
    }
    
    public static function renderAvatar($name, $size = 'w-48 h-48')
    {
        $gender = self::getGenderFromName($name);
        
        if ($gender === 'male') {
            return view('components.avatar-male', compact('size'));
        } else {
            return view('components.avatar-female', compact('size'));
        }
    }
}