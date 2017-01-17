<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\calendar;
use Session;

class CalendarController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calendars = calendar::all();
        return view('calendars.index')->withcalendars($calendars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $calendar = new calendar;
        $calendar->year = $request->year;
        $calendar->month  = $request->month;
        $calendar->day = $request->day;
        $calendar->busy = $request->busy;
        $calendar->save();

       // $calendar= Calendar::where('day', '=',  $request->day)->where('month', '=',  $request->month)->where('year', '=', $request->year)->where('busy', '=', 1)->get();

        Session::flash('Успешно:', 'Календарь обновлен!');
         return redirect('/');
        //return redirect()->route('calendars.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $calendar = calendar::find($id);
        return view('calendars.show')->withcalendar($calendar);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $calendar = Calendar::find($id);
        return view('calendars.edit')->withCalendar($calendar);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        //$calendar = Calendar::find(14);

        $calendar= Calendar::where('day', '=',  8)->get();

        $calendar = Calendar::find($calendar->id);

        $calendar->year = $request->year; //поменять местами
        $calendar->month  = $request->month;
        $calendar->day = $request->day;
        $calendar->busy = 0;
        $calendar->save();

        Session::flash('success', 'Calendar updated');

        //return redirect()->route('calendars.index');
    }

    public function postUpdate2(Request $request)
    {
        //$calendar = Calendar::find(14);

        //$calendar= Calendar::where('day', '=',  8)->get();

        $calendar= Calendar::where('day', '=',  $request->day2)->where('month', '=',  $request->month2)->where('year', '=', $request->year2)->where('busy', '=', 1)->first();

        //Session::flash('success', $calendar->id);


        $intVal = (int)($calendar->id);

        $calendar = Calendar::find($intVal);

        //$calendar->year = $request->year2; //поменять местами
       // $calendar->month  = $request->month2;
       // $calendar->day = $request->day2;
       // $calendar->busy = 0;
        $calendar->delete();
        Session::flash('Успешно:', 'Календарь обновлен!');
       // Session::flash('success', 'Calendar updated');
       return redirect('/');
      // return redirect()->route('calendars.index');
    }
    /*
    public function update(Request $request, $id)
    {

        /*$calendar= Calendar::where('day', '=',  $request->dayupdate)->where('month', '=',  $request->monthupdate)->where('year', '=', $request->yearupdate)->where('busy', '=', 1)->get();

        if(count($calendar) > 0){

        } else {
            $calendar = new calendar;
        }

        $calendar->year = $request->year;
        $calendar->month  = $request->month;
        $calendar->day = $request->day;
        $calendar->busy = $request->busy;
        $calendar->save();
        $calendar= Calendar::where('day', '=',  $request->day)->where('month', '=',  $request->month)->where('year', '=', $request->year)->where('busy', '=', 1)->get();

        if(count($calendar) > 0){

        } else {
            // $calendar = new calendar;
        }


        /*           $calendar->year = $request->year;
                   $calendar->month = $request->month;
                   $calendar->day = $request->day;
                   $calendar->busy = 0;
                   $calendar->save();

        $calendar->year = $request->input('year');
        $calendar->month = $request->input('month');
        $calendar->day = $request->input('day');
        $calendar->busy = $request->input('busy');


        Session::flash('success', 'Successfully saved your new calendar!');

        return redirect()->route('calendars.index');
        //return redirect()->route('calendars.show', $calendar->id);
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calendar = calendar::find($id);

        $calendar->delete();

        Session::flash('success', 'calendar was deleted successfully');

        return redirect()->route('calendars.index');
    }
}
