<?php

namespace App\Http\Controllers;

use App\Reminder;
use Carbon\Carbon;
use Telegram;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reminder = Reminder::paginate(10);

        if ($request->cari) {
            $reminder = Reminder::where('nama','like',"%{$request->cari}%")
                            ->orWhere('deskripsi','like',"%{$request->cari}%")
                            ->paginate(10);
        }

        $reminder->appends($request->only('cari'));
        return view('reminder.index', compact('reminder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reminder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'          => ['required','string','max:128'],
            'deskripsi'     => ['nullable'],
            'kategori'      => ['required','string','max:128'],
            'tanggal'       => ['nullable'],
            'waktu'         => ['nullable'],
        ]);

        Reminder::create($data);
        return redirect()->route('reminder.index')->with('success','Reminder berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function show(Reminder $reminder)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function edit(Reminder $reminder)
    {
        return view('reminder.edit', compact('reminder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reminder $reminder)
    {
        $data = $request->validate([
            'nama'         => ['required','string','max:128'],
            'deskripsi'     => ['nullable'],
            'kategori'      => ['required','string','max:128'],
            'tanggal'       => ['nullable'],
            'waktu'       => ['nullable'],
        ]);

        $reminder->update($data);
        return back()->with('success','Reminder berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reminder  $reminder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reminder $reminder)
    {
        $reminder->delete();
        return back()->with('success','Reminder berhasil dihapus');
    }
}
