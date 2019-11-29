<?php

namespace Owp\OwpCore\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('period', [$this, 'formatPeriod']),
        ];
    }

    public function formatPeriod($start, $end = null)
    {
        setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');

        if (empty($end) || $start->getTimestamp() === $end->getTimestamp()) {
            $date = strftime('%A %d %B %Y à %H:%M', $start->getTimestamp());
        } elseif ($start->format('d') === $end->format('d')) {
            $date = strftime('%A %d %B %Y de %H:%M', $start->getTimestamp()) . strftime(' à %H:%M', $start->getTimestamp());
        } else {
            $date = strftime('%A %d %B %Y à %H:%M ', $start->getTimestamp()) . ' au ' . strftime('%A %d %B %Y à %H:%M', $end->getTimestamp());
        }

        return $date;
    }
}
