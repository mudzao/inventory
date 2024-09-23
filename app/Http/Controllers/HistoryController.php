<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the filter from the query string or default to 'today'
        $filter = $request->query('filter', 'today');
    
        // Define the time ranges for filtering
        switch ($filter) {
            case 'week':
                $startOfWeek = now()->startOfWeek(); // Sunday
                $endOfWeek = now()->endOfWeek();
                $histories = History::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(20);
                break;
    
            case 'month':
                $startOfMonth = now()->startOfMonth();
                $endOfMonth = now()->endOfMonth();
                $histories = History::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(20);
                break;
    
            case 'today':
            default:
                $histories = History::whereDate('created_at', now())
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(20);
                break;
        }
    
        // Return the histories view with the filtered results
        return view('histories.show', [
            'histories' => $histories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
