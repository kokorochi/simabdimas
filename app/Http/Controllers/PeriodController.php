<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Category_type;
use App\ResearchType;
use App\Appraisal;
use App\Period;
use View;

class PeriodController extends BlankonController
{
    protected $pageTitle = 'Periode';
    protected $deleteQuestion = 'Apakah anda yakin untuk menghapus Periode ini?';
    protected $deleteUrl = 'periods';
    protected $category_types;
    protected $research_types;
    protected $appraisals;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        $this->middleware('isOperator');

        array_push($this->css['pages'], 'global/plugins/bower_components/fontawesome/css/font-awesome.min.css');
        array_push($this->css['pages'], 'global/plugins/bower_components/animate.css/animate.min.css');
        array_push($this->css['pages'], 'global/plugins/bower_components/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css');
        array_push($this->css['pages'], 'global/plugins/bower_components/summernote/dist/summernote.css');
        array_push($this->css['pages'], 'global/plugins/bower_components/bootstrap-datepicker-vitalets/css/datepicker.css');

        array_push($this->js['plugins'], 'global/plugins/bower_components/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.min.js');
        array_push($this->js['plugins'], 'global/plugins/bower_components/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js');
        array_push($this->js['plugins'], 'global/plugins/bower_components/summernote/dist/summernote.min.js');
        array_push($this->js['plugins'], 'global/plugins/bower_components/bootstrap-datepicker-vitalets/js/bootstrap-datepicker.js');

//        array_push($this->js['scripts'], 'admin/js/pages/blankon.form.wysiwyg.js');
        array_push($this->js['scripts'], 'admin/js/pages/blankon.form.advanced.js');
        array_push($this->js['scripts'], 'admin/js/pages/blankon.form.picker.js');
        array_push($this->js['scripts'], 'admin/js/customize.js');

        $this->category_types       = Category_type::where('category_name', '<>', 'Mandiri')->get();
        $this->research_types     = ResearchType::all();
        $this->appraisals           = Appraisal::all();

        View::share('css', $this->css);
        View::share('js', $this->js);
        View::share('title', $this->pageTitle . ' | ' . $this->mainTitle);
        View::share('pageTitle', $this->pageTitle);
        View::share('deleteQuestion', $this->deleteQuestion);
        View::share('deleteUrl', $this->deleteUrl);
        View::share('category_types', $this->category_types);
        View::share('research_types', $this->research_types);
        View::share('appraisals', $this->appraisals);
    }

    public function index()
    {
        $periods = Period::paginate(10);

        return view('period.period-list', compact('periods'));
    }

    public function create()
    {
        return view('period.period-create');
    }

    public function edit($id)
    {
        $period = Period::find($id);
        $period_array = Period::find($id)->toArray();
        $period->propose_begda = date('d-m-Y', strtotime($period->propose_begda));
        $period->propose_endda = date('d-m-Y', strtotime($period->propose_endda));
        $period->review_begda  = date('d-m-Y', strtotime($period->review_begda ));
        $period->review_endda  = date('d-m-Y', strtotime($period->review_endda ));
        $period->first_begda   = date('d-m-Y', strtotime($period->first_begda  ));
        $period->first_endda   = date('d-m-Y', strtotime($period->first_endda  ));
        $period->monev_begda   = date('d-m-Y', strtotime($period->monev_begda  ));
        $period->monev_endda   = date('d-m-Y', strtotime($period->monev_endda  ));
        $period->last_begda    = date('d-m-Y', strtotime($period->last_begda   ));
        $period->last_endda    = date('d-m-Y', strtotime($period->last_endda   ));

        return view('period/period-edit', compact('period', 'period_array'));
    }

    public function store(Requests\StorePeriodRequest $request)
    {
        $periods = new period;
        $this->setPeriodFields($request, $periods);
        $periods->created_by = Auth::user()->nidn;
        $periods->save();

        return redirect()->intended('periods/');
    }

    public function update(Requests\StorePeriodRequest $request, $id)
    {
        $periods                    = Period::find($id);
        $this->setPeriodFields($request, $periods);
        $periods->updated_by         = Auth::user()->nidn;
        $periods->save();

        return redirect()->intended('periods/');
    }

    public function destroy($id)
    {
        Period::find($id)->delete();
        return redirect()->intended('periods/');
    }

    /**
     * @param Requests\StorePeriodRequest $request
     * @param $periods
     */
    private function setPeriodFields(Requests\StorePeriodRequest $request, $periods)
    {
        $periods->years = $request->years;
        $periods->category_type_id = $request->category_type;
        $periods->research_type_id = $request->research_type;
        $periods->appraisal_id = $request->appraisal_type;
        $periods->scheme = $request->scheme;
        $periods->sponsor = $request->sponsor;
        $periods->min_member = $request->min_member;
        $periods->max_member = $request->max_member;
        $periods->propose_begda = date('Y-m-d', strtotime($request->propose_begda));
        $periods->propose_endda = date('Y-m-d', strtotime($request->propose_endda));
        $periods->review_begda = date('Y-m-d', strtotime($request->review_begda));
        $periods->review_endda = date('Y-m-d', strtotime($request->review_endda));
        $periods->first_begda = date('Y-m-d', strtotime($request->first_begda));
        $periods->first_endda = date('Y-m-d', strtotime($request->first_endda));
        $periods->monev_begda = date('Y-m-d', strtotime($request->monev_begda));
        $periods->monev_endda = date('Y-m-d', strtotime($request->monev_endda));
        $periods->last_begda = date('Y-m-d', strtotime($request->last_begda));
        $periods->last_endda = date('Y-m-d', strtotime($request->last_endda));
        $periods->annotation = $request->annotation;
    }
}
