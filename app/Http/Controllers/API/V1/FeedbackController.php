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
    public function index(Request $request, $paginate = 10)
    {
        if ($request->search) {
            return Feedback::where('email', 'LIKE', "%{$request->search}%")
                ->orderBy('id', 'desc')
                ->paginate($paginate);
        } else {
            return Feedback::orderBy('id', 'desc')->paginate(10);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
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
