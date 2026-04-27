<?php

namespace App\Http\Controllers;

use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function index()
    {
        $ticketTypes = TicketType::orderBy('type')->get();
        return view('admin.tickets.index', compact('ticketTypes'));
    }

    public function update(Request $request, TicketType $ticket)
    {
        $request->validate([
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'name'        => 'required|string|max:255',
        ]);

        $ticket->update([
            'price'       => $request->price,
            'description' => $request->description,
            'name'        => $request->name,
        ]);

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Harga tiket ' . ucfirst($ticket->type) . ' berhasil diperbarui.');
    }
}
