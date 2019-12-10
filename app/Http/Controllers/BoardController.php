<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Requests\StoreBoard;
use App\Http\Requests\UpdateBoard;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Board::class, 'board');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = Board::all();

        return view('board.index', compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('board.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBoard $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoard $request)
    {
        $board = Board::create($request->validated());
        return $board ? redirect(route('boards.index')) : redirect(route('boards.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        return view('board.show', $board);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        return view('board.edit', $board);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBoard  $request
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBoard $request, Board $board)
    {
        return ($board->update($request->validated())
            && (isset($request->name) ? $request->name === $board->name : true))
            ? redirect()->route('boards.show', $board->name, 301)
            : redirect()->route('boards.edit', $board->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        $board->delete();
        return response()->json([
            'redirect' => route('board.index'),
        ]);
    }
}
