<?php
/**
 * User: amir
 * Date: 5/30/19
 * Time: 2:55 PM
 */

namespace BeSaah;


use Illuminate\Events\Dispatcher;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventDispatcherAdapter extends EventDispatcher
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        parent::__construct();
        $this->dispatcher = $dispatcher;
    }

    /**
     * Dispatches an event to all registered listeners.
     *
     * @param string $eventName The name of the event to dispatch. The name of
     *                              the event is the name of the method that is
     *                              invoked on listeners.
     * @param Event|null $event The event to pass to the event handlers/listeners
     *                              If not supplied, an empty Event instance is created
     *
     * @return Event
     */
    public function dispatch($event)
    {
        parent::dispatch($event);

        $eventName = 1 < \func_num_args() ? func_get_arg(1) : null;

        if (\is_object($event)) {
            $eventName = $eventName ?? \get_class($event);
        } elseif (\is_string($event) && (null === $eventName || $eventName instanceof Event)) {
            @trigger_error(sprintf('Calling the "%s::dispatch()" method with the event name as the first argument is deprecated since Symfony 4.3, pass it as the second argument and provide the event object as the first argument instead.', EventDispatcherInterface::class), E_USER_DEPRECATED);
            $swap = $event;
            $event = $eventName ?? new Event();
            $eventName = $swap;
        }

        $this->dispatcher->dispatch($eventName, $event);

        return $event;
    }
}
