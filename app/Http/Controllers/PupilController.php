<?php

namespace App\Http\Controllers;

use App\Models\Pupil;
use App\Http\Requests\PupilRequest;

class PupilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pupils = Pupil::all();
        $pupils = Pupil::paginate(5);

        return view('pupil.index', compact('pupils'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pupil.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PupilRequest $request)
    {
        $pupil = new Pupil();
        $pupil->name = $request->name;
        $pupil->sex = $request->sex;

        $pupil->birthday = $request->birthday;
        $pupil->skill = $request->skill;
        $pupil->note = $request->note;
        $pupil->user_id = auth()->user()->id;

        $pupil->save();

        return redirect()->route('pupil.create')->with('message', '生徒を登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pupil  $pupil
     * @return \Illuminate\Http\Response
     */

    public function edit(Pupil $pupil)
    {
        return view('pupil.edit', compact('pupil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pupil  $pupil
     * @return \Illuminate\Http\Response
     */
    public function update(PupilRequest $request, Pupil $pupil)
    {
        $pupil->name = $request->name;
        $pupil->sex = $request->sex;
        $pupil->birthday = $request->birthday;
        $pupil->skill = $request->skill;
        $pupil->note = $request->note;

        $pupil->save();

        return redirect()->route('pupil.index')->with('message', '生徒の情報を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pupil  $pupil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pupil $pupil)
    {
        $pupil->delete();

        return back()->with('message', '生徒を削除しました');
    }
}
