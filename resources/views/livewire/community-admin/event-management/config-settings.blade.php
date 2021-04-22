<div class="layout-px-spacing">
    <div class="row layout-top-spacing">

        <x-widget heading="Event" width="6">

            <x-row>
                <div class="col-xl-12 col-lg-12">
                    <x-form.text labeled="Event Name" wireTo="name" />
                </div>
            </x-row>

            <x-form.track-dropdown wireTo="track"/>

        </x-widget>

        <x-widget heading="Passwords" width="3">
            <x-form.text labeled="Admin Password" wireTo="adminPassword"/>
            <x-form.text labeled="Event Password" wireTo="password"/>
            <x-form.text labeled="Spectator Password" wireTo="spectatorPassword"/>
        </x-widget>

        <x-widget heading="Something" width="3">
            <x-form.checkbox name="allowAutoDQ" labeled="Allow Auto DQ"/>
            <x-form.checkbox name="shortFormationLap" />
        </x-widget>

        <x-widget heading="Assist Rules" width="3">
            <x-form.checkbox name="disableAutosteer" />
            <x-form.checkbox name="disableAutoLights" />
            <x-form.checkbox name="disableAutoWiper" />
            <x-form.checkbox name="disableAutoEngineStart" />
            <x-form.checkbox name="disableAutoPitLimiter" />
            <x-form.checkbox name="disableAutoGear" />
            <x-form.checkbox name="disableAutoClutch" />
            <x-form.checkbox name="disableIdealLine" />
            <hr>
            <x-form.text wireTo="stabilityControlLevelMax" labeled="Max Stability Control (0-100)"/>
        </x-widget>

        <x-widget heading="Weather" width="2">
            <x-form.text wireTo="ambientTemp" labeled="Ambient Temp" />
            <x-form.text wireTo="cloudLevel" labeled="Cloud % (0-100)" />
            <x-form.text wireTo="rain" labeled="Rain % (0-100)" />
            <x-form.text wireTo="weatherRandomness" labeled="Randomness (0-7)" />
            <x-form.checkbox name="simracerWeatherConditions" />
            <x-form.checkbox name="isFixedConditionQualification" />
        </x-widget>

        <x-widget heading="Other Options" width="3">
            <x-form.text wireTo="preRaceWaitingTimeSeconds" />
            <x-form.text wireTo="sessionOverTimeSeconds" />
            <x-form.text wireTo="postQualySeconds" labeled="Post Qualification Seconds" />
            <x-form.text wireTo="postRaceSeconds" />
        </x-widget>

        <x-widget heading="Pit Conditions" width="4">
            <x-form.checkbox name="isRefuellingAllowedInRace" />
            <x-form.checkbox name="isRefuellingTimeFixed" />
            <x-form.checkbox name="isMandatoryPitstopRefuellingRequired" />
            <x-form.checkbox name="isMandatoryPitstopTyreChangeRequired" />
            <x-form.checkbox name="isMandatoryPitstopSwapDriverRequired" />
            <hr>
            <x-row>
                <div class="col-xl-6 col-lg-12">
                    <x-form.text wireTo="mandatoryPitstopCount" />
                </div>
                <div class="col-xl-6 col-lg-12">
                    <x-form.text wireTo="pitWindowLengthSec" />
                </div>
                <div class="col-xl-6 col-lg-12">
                    <x-form.text wireTo="driverStintTimeSec" />
                </div>
                <div class="col-xl-6 col-lg-12">
                    <x-form.text wireTo="maxTotalDrivingTime" />
                </div>
                <div class="col-xl-6 col-lg-12">
                    <x-form.text wireTo="tyreSetCount" labeled="Tyre Set Count (1-50)" />
                </div>

                @if($event->teamEvent)
                <div class="col-xl-6 col-lg-12">
                    <x-form.text wireTo="maxDriverCount" labeled="Max Drivers Per Team"/>
                </div>
                @endif
            </x-row>
        </x-widget>

    </div>
</div>
