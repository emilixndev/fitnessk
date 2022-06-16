<?php

namespace App\EventSubscriber;


use App\Entity\Lesson;
use App\Repository\LessonRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CalendarSubscriber implements EventSubscriberInterface
{

    public function __construct(
        private LessonRepository $lessonRepository,
    )
    {
    }

    #[ArrayShape([CalendarEvents::SET_DATA => "string"])] public static function getSubscribedEvents(): array
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar): void
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();


        $Lessons = $this->lessonRepository
            ->createQueryBuilder('lesson')
            ->where('lesson.date BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult()
        ;

        /** @var Lesson $lesson */
        foreach ($Lessons as $lesson) {
            if($lesson->getEnable()){
                $lessonEvent = new Event(
                    $lesson->getName(),
                    $lesson->getDate(),
                    $lesson->getDateTimeEnd() // If the end date is null or not defined, a all day event is created.
                );
                $lessonEvent->setOptions([
                    'backgroundColor' => $lesson->getColor(),
                    'borderColor' => $lesson->getColor(),
                ]);
                $calendar->addEvent($lessonEvent);
            }
        }
    }
}