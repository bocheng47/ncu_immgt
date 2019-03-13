	<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Message;

class MessageController extends Controller
{
    public function index()
	{
 		$message = Message::all();
 		return view('messages.index', [
 		'message' => $message,
 		]);
	}

	public function store(Request $request)
		{
			$message = new Message;
		    $message->body = $request->body;
			$message->save();
			return redirect('message');
		}
	public function show(Message $message)
		{	
			return view('messages.show', [
			'message' => $message
			]);
		}
	public function edit(Message $message)
		{
			return view('messages.edit', [
			'message' => $message
			]);
		}
	public function update(Request $request, Message $message)
		{
			$message->update([
			'body' => $request->body
			]);
			return redirect('/message');
		}
	public function destroy(Request $request, Message $message)
		{
			$message->delete();
			return redirect('/message');
		}
}
																