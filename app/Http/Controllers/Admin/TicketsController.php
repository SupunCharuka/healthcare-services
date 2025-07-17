<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TicketsController extends Controller
{
    public function index(Request $request)
    {
        $tickets = Ticket::with('user')->latest()->get();

        if ($request->wantsJson()) {
            return DataTables::of($tickets)
                ->addColumn('file', function ($tickets) {
                    if (!empty($tickets->file))
                        return '
                        <a href="' . storage("uploads/service-provider/ticket/" . $tickets->file) . '" target="blank">
                        <i class="fa fa-book mr-2"></i> View File
                        </a>';
                })
                ->addColumn('action', function (Ticket $tickets) {
                    if ($tickets->status == 'open') {
                        return
                            '<a href="javascript:void(0)" data-id="' . $tickets->id . '" class="btn btn-sm btn-warning btn-closed">Close</a> ' .
                            '<a href="' . route('service-provider.adminView.index', ['ticket' => $tickets->id]) . '" class="btn btn-sm btn-dark">View</a>';
                    } else if ($tickets->status == 'close') {
                        return '<a href="javascript:void(0)" data-id="' . $tickets->id . '" class="btn btn-sm btn-success btn-open">Open</a> ' .
                            '<a href="' . route('service-provider.adminView.index', ['ticket' => $tickets->id]) . '" class="btn btn-sm btn-dark">View</a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $tickets->id . '" class="btn btn-sm btn-success btn-open">Open</a> ' .
                            '<a href="javascript:void(0)" data-id="' . $tickets->id . '" class="btn btn-sm btn-warning btn-closed">Close</a> ' .
                            '<a href="' . route('service-provider.adminView.index', ['ticket' => $tickets->id]) . '" class="btn btn-sm btn-dark">View</a>';
                    }
                })
                ->rawColumns(['action', 'file'])
                ->make(true);
        }
        return view('backend.admin.tickets.index');
    }

    public function view(Ticket $ticket)
    {
        return view('backend.admin.tickets.view', compact('ticket'));
    }
}
