<?php

namespace App\Http\Controllers\Scholar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestToPublishController extends Controller
{
    public function requestToPublish(Request $request)
    {
        $data = $request->validate([
            'type' => 'required',
            'id' => 'required',
            'notes' => 'required',
        ]);

        $type = $data['type'];
        $model = ("$type")::findOrFail($data['id']);

        $model->publishApprovals()->create([
            'notes' => $data['notes'],
            'user_id' => auth()->id(),
            'account_id' => $model->account_id,
        ]);

        return back()->withSuccess('Request Submitted!');
    }
}
