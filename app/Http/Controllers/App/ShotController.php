<?php

namespace App\Http\Controllers\App;

use App\TheShots\Helpers\Controllers\ShotHelper;
use App\Http\Controllers\Controller;
use App\TheShots\Models\Shot;
use Illuminate\Http\Request;

class ShotController extends Controller
{
    use ShotHelper;
    
    /**
     * Display the all shots.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        return view('shots.list');
    }

    /**
     * Display the specific shot.
     *
     * @param App\TheShots\Models\Shot
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Shot::find($id)) {
            return view('404');
        }

        return view('shot.shot', [
            'id' => $id,
        ]);
    }

    /**
     * Add new shot page.
 *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('shots.create');
    }

    /**
     * Create a new shot.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function createAction(Request $request)
    {
        $this->rules($request);

        $shot = $this->createShotInstance($request);

        $this->uploadShotPreview($shot);

        if ($request->hasFile('images'))
            $this->UploadShotImages($shot);

        return redirect()->back()->with('success', 'Shot successfully created!');
    }
}
