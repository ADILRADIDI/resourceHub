<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgrammingDataController extends Controller
{
    public function index()
    {
        $data = [
            'programming_languages' => [
                'JavaScript',
                'Python',
                'Java',
                'C#',
                'C++',
                'Ruby',
                'Go',
                'PHP',
                'Swift',
                'Rust',
                'Kotlin',
                'TypeScript',
                'Scala',
                'Haskell',
                'MATLAB',
                'Julia',
                'R',
                'SQL',
                'Lua',
                'Perl',
                'Tcl',
                'Scheme',
                'Common Lisp',
                'Erlang',
                'OCaml',
                'F#',
                'Delphi',
                'PowerShell',
                'VB.NET',
                'Visual Basic',
                'Assembly',
                'Pascal',
                'Ada',
                'COBOL',
                'Fortran',
                'PL/I',
                'ALGOL',
            ],
            'frameworks_and_libraries' => [
                'React',
                'Angular',
                'Vue.js',
                'Django',
                'Flask',
                'Spring',
                'Laravel',
                'Ruby on Rails',
                'Node.js',
                'Express.js',
                'TensorFlow',
                'PyTorch',
                'Bootstrap',
                'Tailwind CSS',
            ],
        ];

        return response()->json($data);
    }
}
