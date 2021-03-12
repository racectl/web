<?php

namespace App\MenuBuilder;

class MenuEntry
{
    public $title, $link, $active;
    protected $route;

    public function __construct($title, $routeName, $routeParam = null)
    {
        $this->route = app('Illuminate\Http\Request')->route();
        $this->title = $title;
        $this->link = route($routeName, $routeParam);
        $this->active = $this->determineActive($routeName, $routeParam);
    }

    protected function determineActive($routeName, $routeParam)
    {
        if ($routeName == 'event.show') {
            return $this->routeIsForEvent($routeParam);
        }

        if ($routeName == 'series.show') {
            return $this->routeIsForSeries($routeParam);
        }

        $currentRoute = $this->route->getName();
        return $routeName == $currentRoute;
    }

    protected function routeIsForEvent($routeParam)
    {
        if (!array_key_exists('event', $this->route->parameters)) return false;

        $eventIdFromRoute = $this->route->parameters['event']->id;
        return $routeParam == $eventIdFromRoute;
    }

    protected function routeIsForSeries($routeParam)
    {
        if (!array_key_exists('series', $this->route->parameters)) return false;

        $seriesIdFromRoute = $this->route->parameters['series']->id;
        return $routeParam == $seriesIdFromRoute;
    }
}
