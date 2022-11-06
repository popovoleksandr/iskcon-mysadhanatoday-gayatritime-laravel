<?php

namespace App\Http\Controllers;

use Carbon\Traits\Date;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use AurorasLive\SunCalc;
use Illuminate\Support\Collection;
use Spatie\CalendarLinks\Link;

use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;



class Controller extends BaseController
{
    private $date;
    private $latitude;
    private $longitude;
    private $startDate;
    private $endDate;
    private $alertMinutesBefore;
    private $uuidPrefix = 'gayatritime_';

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function calculate(Request $request)
    {
        $this->latitude = $request->lat;
        $this->longitude = $request->lng;
        $this->startDate = DateTime::createFromFormat('Y-m-d', $request->start_date);
        $this->endDate = DateTime::createFromFormat('Y-m-d', $request->end_date);
        $this->alertMinutesBefore = $request->alert_minutes_before;

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($this->startDate, $interval, $this->endDate);


        $eventsArray = [];
        foreach ($period as $dt) {
            $eventsArray[] = $this->getCalculationForDate($dt);
        }
        $calendar = Calendar::create('Gayatri for ' . $this->startDate->format('Y.m.d'))
            ->event(collect($eventsArray)->flatten()->toArray());

        return response()->streamDownload(function () use ($calendar) {
            echo $calendar->get();
        }, 'calendar.ics', [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => "attachment; filename=\"calendar.ics\"",
        ]);
    }

    public function getCalculationForDate(DateTime $date): array
    {
        $lat = $this->latitude;
        $lng = $this->longitude;
        $alertMinutesBefore = $this->alertMinutesBefore;

        return [
                $this->getGayatriSandhyaEvent($date, $lat, $lng, $alertMinutesBefore),
                $this->getSavitriSandhyaEvent($date, $lat, $lng, $alertMinutesBefore),
                $this->getSarasvatiSandhyaEvent($date, $lat, $lng, $alertMinutesBefore),
        ];
    }

    private function getGayatriSandhyaEvent(DateTime $date, $lat, $lng, $alertMinutesBefore = 0): Event
    {
        $sc = new SunCalc($date, $lat, $lng);
        $sunTimes = $sc->getSunTimes();

        /**
         * @var DateTime $sunrise
         */
        $sunrise = $sunTimes['sunrise'];

        // Calculating Gayatri Sandhya
        $gayatriSandhyaStart = clone $sunrise;
        $gayatriSandhyaEnds = clone $sunrise;

        $gayatriSandhyaStart->sub(new \DateInterval('PT24M'));
        $gayatriSandhyaEnds->add(new \DateInterval('PT24M'));

        return $this->createCalendarEvent(
            __('main.controller_gayatri_sandhya'),
            $gayatriSandhyaStart,
            $gayatriSandhyaEnds,
            $alertMinutesBefore,
            $this->uuidPrefix . $gayatriSandhyaStart->format('Ymd') . '_gayatri'
        );
    }

    private function getSavitriSandhyaEvent(DateTime $date, $lat, $lng, $alertMinutesBefore = 0): Event
    {
        $sc = new SunCalc($date, $lat, $lng);
        $sunTimes = $sc->getSunTimes();

        /**
         * @var DateTime $sunrise
         * @var DateTime $sunset
         */
        $sunrise = $sunTimes['sunrise'];
        $sunset = $sunTimes['sunsetStart'];

        $diff = $sunset->diff($sunrise);

        $tillNoonSeconds = new \DateInterval('PT' . intval(($diff->h*60*60 + $diff->i*60 + $diff->i)/2) . 'S');

        /**
         * @var DateTime $noon
         * @var DateTime $sunset
         */
        $noon = $sunrise->add($tillNoonSeconds);


        // Calculating Gayatri Sandhya
        $savitriSandhyaStart = clone $noon;
        $savitriSandhyaEnds = clone $noon;

        $savitriSandhyaStart->sub(new \DateInterval('PT24M'));
        $savitriSandhyaEnds->add(new \DateInterval('PT24M'));

        return $this->createCalendarEvent(
            __('main.controller_savitri_sandhya'),
            $savitriSandhyaStart,
            $savitriSandhyaEnds,
            $alertMinutesBefore,
            $this->uuidPrefix . $savitriSandhyaStart->format('Ymd') . '_savitri'
        );

    }

    private function getSarasvatiSandhyaEvent(DateTime $date, $lat, $lng, $alertMinutesBefore = 0): Event
    {
        $sc = new SunCalc($date, $lat, $lng);
        $sunTimes = $sc->getSunTimes();

        /**
         * @var DateTime $sunset
         */
        $sunset = $sunTimes['sunsetStart'];

        // Calculating Gayatri Sandhya
        $sarasvatiSandhyaStart = clone $sunset;
        $sarasvatiSandhyaEnds = clone $sunset;

        $sarasvatiSandhyaStart->sub(new \DateInterval('PT24M'));
        $sarasvatiSandhyaEnds->add(new \DateInterval('PT24M'));


        return $this->createCalendarEvent(
            __('main.controller_sarasvati_sandhya'),
            $sarasvatiSandhyaStart,
            $sarasvatiSandhyaEnds,
            $alertMinutesBefore,
            $this->uuidPrefix . $sarasvatiSandhyaStart->format('Ymd') . '_sarasvati'
        );
    }

    private function createCalendarEvent($name, DateTime $start, DateTime $end, $remindBeforeMinutes, $uuid): Event
    {
        return Event::create($name)
            ->startsAt($start)
            ->endsAt($end)
            ->uniqueIdentifier($uuid)
            ->alertMinutesBefore($remindBeforeMinutes,  __('main.alert_message_before', ['name' => $name, 'duration'=> $remindBeforeMinutes]) )
            ->alertAt($start, __('main.alert_message_started', ['name' => $name]))
            ->alertAt($end, __('main.alert_message_ended', ['name' => $name]));
    }
}
