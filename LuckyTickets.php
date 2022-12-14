<?php

/**
 * LuckyTickets is class for counting lucky tickets
 *
 * @author acround
 */
class LuckyTickets
{

    private static $sums = [];

    private static function getSum(int $num): int
    {
        $index = $num;
        if (!isset(self::$sums[$index])) {
            $sum = intdiv($num, 100);
            $num = $num % 100;
            $sum += intdiv($num, 10);
            $num = $num % 10;
            $sum += $num;
            while ($sum > 9) {
                $sum = intdiv($sum, 10) + ($sum % 10);
            }
            self::$sums[$index] = $sum;
        }
        return self::$sums[$index];
    }

    private static function isTicketLucky(int $num): bool
    {
        $firstNumbers = intdiv($num, 1000);
        $lastNumbers = $num % 1000;
        return self::getSum($firstNumbers) == self::getSum($lastNumbers);
    }

    public static function run(int $start, int $end): int
    {
        $out = 0;
        for ($i = $start; $i <= $end; $i++) {
            if (self::isTicketLucky($i)) {
                $out++;
            }
        }
        return $out;
    }

}
