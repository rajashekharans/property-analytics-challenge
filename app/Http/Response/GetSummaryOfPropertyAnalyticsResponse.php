<?php

namespace App\Http\Response;

use Illuminate\Support\Collection;

class GetSummaryOfPropertyAnalyticsResponse
{
    private $analytics;
    private $properties;

    public function __construct(Collection $analytics, Collection $properties)
    {
        $this->analytics = $analytics;
        $this->properties = $properties;
    }

    public function jsonSerialize(): array
    {
        $response = [];
        if($this->properties->count() > 0) {
            $response = [
                'Min' => $this->analytics->min(),
                'Max' => $this->analytics->max(),
                'Median' => $this->analytics->median(),
                'Percentage of Properties With values(%)' =>  $this->getPercentageOfPropertiesWithValues(),
                'Percentage of Properties without values(%)' => $this->getPercentageOfPropertiesWithoutValues(),
            ];
        }

        return $response;
    }

    public function getPercentageOfPropertiesWithoutValues()
    {
        return (
            (($this->properties->count() - $this->analytics->count()) * 100) / ($this->properties->count())
        );
    }

    public function getPercentageOfPropertiesWithValues()
    {
        return (
            ($this->analytics->count() * 100) / ($this->properties->count())
        );
    }
}

