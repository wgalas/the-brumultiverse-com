<?php

namespace App\Nova\Actions;

use App\Models\PublishApproval;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;

class PublishWork extends Action
{
    use InteractsWithQueue, Queueable;

    private $latestRequest;

    public function updateRequest($requests)
    {
        foreach ($requests as $r) { // this will update
            $r->update([
                'approved_at' => now(),
                'status' => PublishApproval::STATUS_APPROVED,
                'approved_at_user_id' => auth()->id(),
            ]);
        }
    }
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $requests = $model->publishApprovals;

            $this->latestRequest = $model->publishApprovals()->latest()->first();

            $this->updateRequest($requests); // this will update all rqeuest to approved state.

            $model->update([
                'published_at' => $fields['date'],
            ]);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Date::make('Date')
                ->rules(['required'])
                ->help('The default value is the preferred date of the author/artist.')
                ->default(fn () => optional($this->latestRequest)->preferred_date),
        ];
    }
}
