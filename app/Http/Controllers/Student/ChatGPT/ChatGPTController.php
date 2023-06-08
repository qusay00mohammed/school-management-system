<?php

namespace App\Http\Controllers\Student\ChatGPT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ChatGPTController extends Controller
{

    public function index()
    {
        $messages = collect(session('messages', []))->reject(fn ($message) => $message['role'] === 'system');

        return view('pages.student.chatGPT.index', [
            'messages' => $messages
        ]);
    }


    public function store(Request $request)
    {
        $messages = $request->session()->get('messages', [
            ['role' => 'system', 'content' => 'You are LaravelGPT - A ChatGPT clone. Answer as concisely as possible.']
        ]);

        $messages[] = ['role' => 'user', 'content' => $request->input('message')];
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages
        ]);
        $messages[] = ['role' => 'assistant', 'content' => $response->choices[0]->message->content];
        $request->session()->put('messages', $messages);

        return redirect()->route('student.questions.index');
    }



    public function destroy(Request $request)
    {
        $request->session()->forget('messages');

        return redirect()->route('student.questions.index');
    }




}
