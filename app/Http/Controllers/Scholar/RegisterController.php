<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Aan;
use App\Models\Club;
use App\Models\User;
use App\Models\Course;
use App\Models\College;
use App\Models\Interest;
use App\Helpers\FileHelper;
use App\Helpers\FormHelper;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        $colleges = College::get();
        $clubs = Club::get();
        $courses = Course::get();
        return view('scholar.register', compact('colleges'));
    }

    public function register(UserRequest $request)
    {
        $validated = $request->validated();

        //save picture
        $validated['picture'] = FileHelper::save($request->picture);
        FileHelper::generateImage([30, 30], $validated['picture']);

        //this will hold the interest of the user that will be created later,
        $interestField = [
            'course_id' => $validated['course'],
            'college_id' => $validated['college'],
            'club_id' => $validated['club'],
        ];

        $aan = $validated['aan'];

        //this will remove the excess fields
        $userFields = FormHelper::removeDataWithKeys(
            [
                'course',
                'college',
                'club',
                'aan',
            ],
            $validated
        );

        $userFields['password'] = bcrypt($userFields['password']);

        //this will create a fields
        $user = User::create($userFields);

        //turn the aan into unavailable
        Aan::whereValue($aan)
            ->first()
            ->update(['user_id' => $user->id]);

        //create interest of the newly created user
        $interestField['user_id'] = $user->id;
        Interest::create($interestField);

        //log the user in
        auth()->login($user);
        return redirect(route('scholar.home'));
    }
}