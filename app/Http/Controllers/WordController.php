<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\User;
use Validator;

class WordController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('fileToUpload')) {
            $file = $request->file('fileToUpload');
            $allowedExtensions = ['jpg', 'png', 'gif'];
            $fileExtension = $file->getClientOriginalExtension();
            if (!in_array($fileExtension, $allowedExtensions)) {
                return redirect()->back()->withErrors(['fileToUpload' => 'Seuls les fichiers du type JPG, PNG, and GIF sont autorisés'])->withInput();
            }
            $file_name = $file->getClientOriginalName();
            $file_ext = $file->getClientOriginalExtension();
            $fileInfo = pathinfo($file_name);
            $filename = $fileInfo['filename'];
            $newname = uniqid() . "." . $file_ext; // Generate a unique filename
            $destinationPath = 'uploads/images';
            $file->move($destinationPath, $newname);
            $pathToStore = $destinationPath.'/'.$newname;
            $request->merge(['path' => $pathToStore]);
            $request->merge(['created_by' => auth()->user()->id]);
        }
        $validate = Validator::make($request->all(), [
            'title' => 'required|string|max:250',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors(['title' => 'Ce champ ne peut pas être vide'])->withInput();
        }
        $word = Word::create($request->all());

        return redirect()->back()->with('success', 'Votre fichier a bien été envoyé dans la base de données');
    }

    public function index()
    {
        $words = Word::all();
        return view('dashboard', compact('words'));
    }

    public function edit(Word $word)
    {
        return view('word.edit', compact('word'));
    }

    
    public function update(Request $request, Word $word)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|string|max:250',
        ]);

        if ($request->hasFile('fileToUpload')) {
            $file_path = public_path($word->path);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $file = $request->file('fileToUpload');
            $allowedExtensions = ['jpg', 'png', 'gif'];
            $fileExtension = $file->getClientOriginalExtension();
            if (!in_array($fileExtension, $allowedExtensions)) {
                return redirect()->back()->withErrors(['fileToUpload' => 'Seuls les fichiers du type JPG, PNG, and GIF sont autorisés'])->withInput();
            }
            $file_name = $file->getClientOriginalName();
            $file_ext = $file->getClientOriginalExtension();
            $fileInfo = pathinfo($file_name);
            $filename = $fileInfo['filename'];
            $newname = uniqid() . "." . $file_ext; // Generate a unique filename
            $destinationPath = 'uploads/images';
            $file->move($destinationPath, $newname);
            $pathToStore = $destinationPath.'/'.$newname;
            $request->merge(['path' => $pathToStore]);
        }
        
        if ($validate->fails()) {
            return redirect()->back()->withErrors(['title' => 'Ce champ ne peut pas être vide'])->withInput();
        }
        $word->update($request->only('title'));
        $word->update($request->only('path'));

        return redirect()->route('dashboard')->with('success', 'Le titre du mot a été mis à jour avec succès');
    }

    public function destroy(Word $word)
    {
        $word->delete();
        $file_path = public_path($word->path);
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        return redirect()->route('dashboard')->with('success', 'Votre mot a bien été supprimé');
    }
    
    // debut des exo
    public function french_choose()
    {
        $words = Word::all();
        return view('francais.choose', compact('words'));
    }

    public function french_easy()
    {
        $words = Word::all();
        return view('francais.easy', compact('words'));
    }
    
    public function french_medium()
    {
        $words = Word::all();
        return view('francais.medium', compact('words'));
    }

    public function french_hard()
    {
        $words = Word::all();
        return view('francais.hard', compact('words'));
    }

    public function api_get_words()
    {
        $words = Word::all();
        return response()->json($words);
    }
}
