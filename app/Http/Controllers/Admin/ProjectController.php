<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// importo il modello
use App\Models\Admin\Project;

use App\Models\Admin\Type;

// importo la classe Rule per le eccezioni nell'unique
use Illuminate\Validation\Rule;

// importo lo Storage
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view( 'admin.projects.index', compact('projects') );
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // importo i type dal modello type
        $types = Type::all();

        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'type_id' => 'nullable|exists:types,id',
                'title' => 'required|unique:projects',
                'description' => 'nullable',
                'cover_img' => 'nullable|image',
                'link_project' => 'nullable|unique:projects|url',
            ],
            [
                'title.required'=> 'Il campo "titolo" è richiesto',
                'title.unique'=> 'Questo titolo è già utilizzato',
                'cover_img.image' => 'Il file deve essere di tipo immagine',
                'link_project.unique' => 'Questo link è già utilizzato',
                'link_project.url' => 'Questo campo deve contenere un link URL valido '
            ]
        );

        // funzione per salvare i nuovi dati nel database
        $form_data = $request ->all();
        // dd($request);

        //trasformo lo slug
        $slug = Project::generateSlug($request->title);


        $form_data['slug'] = $slug;

        // caricamento immagine se presente
        if ($request->hasFile('cover_img') ) {

            // creo un path dove viene salvata la cover del progetto
            // 'project_covers' è una sottocartella che creo in storage
            $path = Storage::disk('public')->put('project_covers', $request->cover_img );

            $form_data['cover_img'] = $path;
        }

        //creo il nuovo progetto
        $newProject = new Project();
        
        $newProject->fill( $form_data );

        $newProject->save();

        //ritorno ad un'altra pagina
        return redirect()->route('admin.projects.index')->with('successCreate', 'Hai creato un nuovo progetto!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view( 'admin.projects.edit', compact ('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate(
            [
                'title' => [
                    'required',
                    Rule::unique('projects')->ignore($project->id),
                ],
                'description' => 'nullable',
                'cover_img' => 'nullable|image',
                'link_project' => [
                    'nullable',
                    'url',
                    Rule::unique('projects')->ignore($project->id),
                ]
            ],
            [
                'title.required'=> 'Il campo "titolo" è richiesto',
                'title.unique'=> 'Questo titolo è già utilizzato in altri progetti',
                'cover_img.image' => 'Il file deve essere di tipo immagine',
                'link_project.unique' => 'Questo link è già utilizzato in altri progetti',
                'link_project.url' => 'Questo campo deve contenere un link URL valido '
            ]
        );


        // funzione per salvare i dati modificati nel database
        $form_data = $request->all();

        //trasformo lo slug
        $slug = Project::generateSlug($request->title);

        $form_data['slug'] =$slug;


        // caricamento immagine se presente
        if ($request->hasFile('cover_img') ) {

            //cancello per sostituire (update)
            if( $project->cover_img ){
                Storage::delete($project->cover_img);
            }

            // creo un path dove viene salvata la cover del progetto
            // 'project_covers' è una sottocartella che creo in storage
            $path = Storage::disk('public')->put('project_covers', $request->cover_img );

            $form_data['cover_img'] = $path;
        }


        $project->update( $form_data );

        //ritorno ad un'altra pagina
        return redirect()->route('admin.projects.index')->with('successEdit', 'Hai modificato un progetto!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //cancello l'immagine dallo storage
        if( $project->cover_img ){
            Storage::delete($project->cover_img);
        }

        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
