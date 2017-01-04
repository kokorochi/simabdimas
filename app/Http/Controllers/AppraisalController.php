<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Appraisal;
use App\Appraisal_i;
use View;

class AppraisalController extends BlankonController {
    protected $pageTitle = 'Aspek Penilaian';
    protected $deleteQuestion = 'Apakah anda yakin untuk menghapus Aspek Penilaian ini?';
    protected $deleteUrl = 'appraisals';
    private $lv_create = 1;
    private $lv_update = 2;

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
        $this->middleware('isOperator');

        array_push($this->css['pages'], 'global/plugins/bower_components/fontawesome/css/font-awesome.min.css');
        array_push($this->css['pages'], 'global/plugins/bower_components/animate.css/animate.min.css');
        array_push($this->css['pages'], 'global/plugins/bower_components/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css');
        array_push($this->css['pages'], 'global/plugins/bower_components/summernote/dist/summernote.css');

        array_push($this->js['plugins'], 'global/plugins/bower_components/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.min.js');
        array_push($this->js['plugins'], 'global/plugins/bower_components/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js');
        array_push($this->js['plugins'], 'global/plugins/bower_components/summernote/dist/summernote.min.js');

        array_push($this->js['scripts'], 'admin/js/pages/blankon.form.wysiwyg.js');
        array_push($this->js['scripts'], 'admin/js/customize.js');

        View::share('css', $this->css);
        View::share('js', $this->js);
        View::share('title', $this->pageTitle . ' | ' . $this->mainTitle);
        View::share('pageTitle', $this->pageTitle);
        View::share('deleteQuestion', $this->deleteQuestion);
        View::share('deleteUrl', $this->deleteUrl);
    }

    public function index()
    {
        $appraisals = Appraisal::paginate(10);

        return view('appraisal.appraisal-list', compact('appraisals'));
    }

    public function create()
    {
        return view('appraisal.appraisal-create');
    }

    public function edit($id)
    {
        $appraisal = Appraisal::find($id);
        $appraisals_is = $appraisal->appraisal_i()->get();

        return view('appraisal/appraisal-edit', compact('appraisal', 'appraisals_is'));
    }

    public function store(Requests\StoreAppraisalRequest $request)
    {
        $this->saveAppraisal($request, $this->lv_create);

        return redirect()->intended('appraisals/');
    }

    public function update(Requests\StoreAppraisalRequest $request, $id)
    {
        $appraisals = Appraisal::find($id);
        $this->saveAppraisal($request, $this->lv_update, $appraisals, $id);

        return redirect()->intended('appraisals/');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id)
        {
            $appraisals = Appraisal::find($id);
            $appraisals->delete();
            $appraisals->appraisal_i()->delete();
        });

        return redirect()->intended('appraisals/');
    }

    /**
     * @param Requests\StoreAppraisalRequest $request
     */
    private function saveAppraisal(Requests\StoreAppraisalRequest $request, $upd_mode, $appraisals = null, $id = null)
    {
        if ($appraisals === null) $appraisals = new Appraisal;
        DB::transaction(function () use ($request, $upd_mode, $appraisals, $id)
        {
            $appraisals->name = $request->name;
            if ($upd_mode === $this->lv_create)
            {
                $appraisals->created_by = Auth::user()->nidn;
            } else
            {
                $appraisals->updated_by = Auth::user()->nidn;
                $appraisals->appraisal_i()->delete();
            }
            $appraisals->save();

            $i = 1;
            foreach ($request->aspect as $a => $b)
            {
                $appraisals_i = new Appraisal_i;
                $appraisals_i->appraisal_id = $appraisals->id;
                $appraisals_i->item = $i++;
                $appraisals_i->aspect = $request->aspect[$a];
                $appraisals_i->quality = $request->quality[$a];
                $appraisals_i->save();
            }
        });
    }
}
