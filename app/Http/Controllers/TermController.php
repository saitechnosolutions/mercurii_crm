<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    //
    public function viewterms()
    {
        $terms = Term::all();
        return view('pages.viewterms', compact('terms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'whichterm' => 'required',
            'termtype' => 'required',
            'content' => 'required',
        ]);

        Term::create([
            'whichterm' => $request->whichterm,
            'termtype' => $request->termtype,
            'content' => $request->content,
        ]);

        return redirect()->route('terms.view')->with('success', 'Term added successfully!');
    }

    public function edit($id)
    {
        $term = Term::findOrFail($id);
        return view('pages.editterms', compact('term'));
    }

    // Update the term
    public function update(Request $request, $id)
    {
        $request->validate([
            'termtype' => 'required',
            'content' => 'required',
            'whichterm' => 'required',
        ]);

        $term = Term::findOrFail($id);
        $term->termtype = $request->termtype;
        $term->content = $request->content;
        $term->whichterm = $request->whichterm;
        $term->save();

        return redirect()->route('terms.view')->with('success', 'Term updated successfully!');
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'term_approve' => 'required|in:0,1',
        ]);

        $term = Term::findOrFail($id);
        $term->term_approve = $request->term_approve;
        $term->save();

        return redirect()->back()->with('success', 'Term approval status updated successfully.');
    }

    public function destroy($id)
{
    $term = Term::findOrFail($id);
    $term->delete();
    return redirect()->route('terms.view')->with('success', 'Term deleted successfully!');
}
}
