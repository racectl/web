<x-widget width="6" heading="Weather">
    <div wire:ignore class="pt-4 pb-2">
        <x-row>
            <div class="col-xl-3 col-md-3 col-sm-3 text-center" title="Ambient Temp">
                <i data-feather="thermometer" width="4rem" height="4rem"></i>
                <h6 class="mt-2">
                    {{ $this->event->accConfig->event->ambientTemp }}&#176;C
                </h6>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-3 text-center" title="Cloud Level">
                <i data-feather="cloud" width="4rem" height="4rem"></i>
                <h6 class="mt-2">
                    {{ $this->event->accConfig->event->cloudLevel }}%
                </h6>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-3 text-center" title="Rain Level">
                <i data-feather="cloud-rain" width="4rem" height="4rem"></i>
                <h6 class="mt-2">
                    {{ $this->event->accConfig->event->rain }}%
                </h6>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-3 text-center" title="Weather Randomness">
                <i data-feather="trending-up" width="4rem" height="4rem"></i>
                <h6 class="mt-2">
                    {{ $this->event->accConfig->event->weatherRandomness }}
                </h6>
            </div>
        </x-row>
        <div class="text-success text-center">
            @if($this->event->accConfig->event->simracerWeatherConditions)
                <br>Sim Racer Weather Conditions Enabled.
            @endif

            @if($this->event->accConfig->event->isFixedConditionQualification)
                <br>Fixed Conditions For Qualification Enabled.
            @endif
        </div>
    </div>
</x-widget>
