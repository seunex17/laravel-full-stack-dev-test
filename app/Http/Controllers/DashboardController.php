<?php

    namespace App\Http\Controllers;

    use App\Models\Agent;
    use App\Models\Comment;
    use App\Models\Ticket;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;

    class DashboardController extends Controller {

        public function index()
        {
            $user = Auth::user();

            if ($user->role === 'agent')
            {
                $agentId = $user->agent_id;
                $tickets = Ticket::where('agent_id', $agentId)
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $tickets = Ticket::where('user_id', Auth::id())
                    ->orderBy('id', 'desc')
                    ->get();
            }

            return view('dashboard', [
                'tickets' => $tickets,
            ]);
        }


        public function newTicket()
        {
            $agents = Agent::all();

            return view('ticket.new', [
                'agents' => $agents,
            ]);
        }


        public function createTicket(Request $request)
        {
            $request->request->add([
                'user_id' => Auth::id(),
                'ticket_id' => time(),
            ]);
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'agent_id' => 'required',
                'comment' => 'required',
            ]);

            if ($validator->fails())
            {
                $errors = $validator->errors()
                    ->messages();

                return redirect()
                    ->back()
                    ->with([
                        'error' => array_shift($errors),
                    ])
                    ->withInput();
            }

            Ticket::create($request->all());

            return redirect()
                ->route('dashboard.index')
                ->with([
                    'success' => 'New ticket has been submitted',
                ]);
        }

        public function viewTicket(string $id)
        {
            $user = Auth::user();
            $ticket = Ticket::where('ticket_id', $id)->first();

            if (!$ticket)
            {
                return redirect()->back();
            }

            if ($user->role === 'agent' && $ticket->agent_id != $user->agent_id)
            {
                return redirect()->back();
            }

            return view('ticket.view', [
                'ticket' => $ticket,
            ]);
        }

        public function createTicketComment(Request $request)
        {
            $request->request->add([
                'user_id' => Auth::id(),
            ]);

            Comment::create($request->all());

            return redirect()->back()->with([
                'success' => 'Reply sent!',
            ]);
        }
    }
