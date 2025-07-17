<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TicketsController extends Controller
{
    public function index(Request $request)
    {
        $ticket = Ticket::where('user_id', Auth::user()->id)->latest();
        if ($request->wantsJson()) {
            return DataTables::of($ticket)
                ->addColumn('file', function ($ticket) {
                    if (!empty($ticket->file))
                        return '
                        <a href="' . storage("uploads/service-provider/ticket/" . $ticket->file) . '" target="blank">
                        <i class="fa fa-book mr-2"></i> View File
                        </a>';
                })
                ->addColumn('action', function (Ticket $ticket) {
                    if ($ticket->status == 'open') {
                        return
                            '<a href="javascript:void(0)" data-id="' . $ticket->id . '" class="btn btn-sm btn-warning btn-closed">Close</a> ' .
                            '<a href="javascript:void(0)" data-id="' . $ticket->id . '" class="btn btn-sm btn-danger btn-delete">Delete</a> ' .
                            '<a href="' . route('customer.supportTicket.edit', ['ticket' => $ticket->id]) . '" class="btn btn-sm btn-info btn-edit">Edit</a> '.
                            '<a href="' . route('customer.supportTicket.view', ['ticket' => $ticket->id]) . '" class="btn btn-sm btn-dark">View</a>';
                    } else if ($ticket->status == 'close') {
                        return '<a href="javascript:void(0)" data-id="' . $ticket->id . '" class="btn btn-sm btn-success btn-open">Open</a> ' .
                            '<a href="javascript:void(0)" data-id="' . $ticket->id . '" class="btn btn-sm btn-danger btn-delete">Delete</a> ' .
                            '<a href="' . route('customer.supportTicket.edit', ['ticket' => $ticket->id]) . '" class="btn btn-sm btn-info btn-edit">Edit</a> '.
                            '<a href="' . route('customer.supportTicket.view', ['ticket' => $ticket->id]) . '" class="btn btn-sm btn-dark">View</a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $ticket->id . '" class="btn btn-sm btn-success btn-open">Open</a> ' .
                            '<a href="javascript:void(0)" data-id="' . $ticket->id . '" class="btn btn-sm btn-warning btn-closed">Close</a> ' .
                            '<a href="javascript:void(0)" data-id="' . $ticket->id . '" class="btn btn-sm btn-danger btn-delete">Delete</a> ' .
                            '<a href="' . route('customer.supportTicket.edit', ['ticket' => $ticket->id]) . '" class="btn btn-sm btn-info btn-edit">Edit</a> '.
                            '<a href="' . route('customer.supportTicket.view', ['ticket' => $ticket->id]) . '" class="btn btn-sm btn-dark ">View</a>';
                    }
                })
                ->rawColumns(['action', 'file'])
                ->make(true);
        }
        return view('backend.customer.support-ticket.index');
    }
    public function create()
    {
        $this->authorize('create', Ticket::class);
        return view('backend.customer.support-ticket.create');
    }

    public function view(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        return view('backend.customer.support-ticket.view', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        return view('backend.customer.support-ticket..edit', compact('ticket'));
    }

    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);
        if (!$ticket) {
            $json['status'] = 'error';
            $json['code'] = '404';
            $json['message'] = 'not found';
            $json['icon'] = 'error';
            return response()->json($json, 404);
        }
        $ticket->delete();
        $json['status'] = 'deleted';
        $json['message'] = 'Deleted successfully';
        $json['icon'] = 'success';
        $json['data'] = $ticket;
        return response()->json($json);
    }

    public function open(Ticket $ticket)
    {
        $this->authorize('open', $ticket);
        $ticket->update(['status' => 'open']);
        return response()->json(['success' => true, 'message' => 'Open successfully']);
    }

    public function close(Ticket $ticket)
    {
        $this->authorize('close', $ticket);

        $ticket->update(['status' => 'close']);
        return response()->json(['success' => true, 'message' => 'Closed successfully']);
    }
}
