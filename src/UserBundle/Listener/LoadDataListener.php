<?php

namespace UserBundle\Listener;

use AncaRebeca\FullCalendarBundle\Event\CalendarEvent;
use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;

class LoadDataListener
{
    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return FullCalendarEvent[]
     */
    public function loadEvents(CalendarEvent $calendarEvent)
    {

        $request = $calendarEvent->getRequest();
        $filter = $request->get('filter');



        $em = $this->getDoctrine()->getManager();
        $events =$em->getRepository('UserBundle:EventCustom')
            ->findAll();

        foreach ($events as $event) {

            // create an event with a start/end time, or an all day event
            if ($event->getAllDay() === false) {
                $eventEntity = new EventEntity($event->getTitle(), $event->getStartDate(), $event->getEndDate());
            } else {
                $eventEntity = new EventEntity($event->getTitle(), $event->getStartDate(), null, true);
            }

            $calendarEvent->addEvent($eventEntity);
        }

    }
}