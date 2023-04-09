<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Feedback::orderBy('id', 'desc')->paginate(10);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email',
            'feedback' => 'required',
        ]);

        $feedback = Feedback::create([
            'name' => $request->name,
            'email' => $request->email,
            'feedback' => $request->feedback,
            'phone' => $request->phone,
        ]);

        return response($feedback, 200)->header('Content-Type', 'text/plain');
    }

    public function destroy($id)
    {
        Feedback::where('id', $id)->delete();

        return response('OK', 200)->header('Content-Type', 'text/plain');
    }
}
