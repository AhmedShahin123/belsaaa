<?php
/**
 * User: amir
 * Date: 9/9/19
 * Time: 10:08 AM
 */

namespace BeSaah\Concerns;


use Symfony\Component\Workflow\Marking;
use Symfony\Component\Workflow\Transition;
use Symfony\Component\Workflow\TransitionBlockerList;

interface HasWorkflowInterface
{
    /**
     * Returns the object's Marking.
     *
     * @param string $workflowName Name of workflow
     *
     * @return Marking The Marking
     *
     */
    public function getMarking($workflowName = null);

    /**
     * Returns true if the transition is enabled.
     *
     * @param string $transitionName A transition
     * @param string $workflowName   Name of workflow
     *
     * @return bool true if the transition is enabled
     */
    public function can($transitionName, $workflowName = null);

    /**
     * Builds a TransitionBlockerList to know why a transition is blocked.
     *
     * @param string $transitionName
     * @param string $workflowName
     *
     * @return TransitionBlockerList
     */
    public function buildTransitionBlockerList(string $transitionName, $workflowName = null): TransitionBlockerList;

    /**
     * Fire a transition.
     *
     * @param string $transitionName A transition
     * @param string $workflowName   Name of workflow
     * @param array  $context        Data to be set
     *
     * @return Marking The new Marking
     *
     */
    public function apply($transitionName, $workflowName = null, array $context = []);

    /**
     * Returns all enabled transitions.
     *
     * @param string $workflowName Name of workflow
     *
     * @return Transition[] All enabled transitions
     */
    public function getEnabledTransitions($workflowName = null);
}
