<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Calendar2;
use Mail;
use Session;

class PagesController extends Controller {

    public function getIndex() {
        $posts = Post::orderBy('created_at', 'asc')->limit(1)->get(); //переписать код
        return view('pages.welcome')->withPosts($posts);
    }

    public function indexCommon()
    {
        return view('/server.php/services');
    }


    public function getServices()
    {
        $posts = Post::where('category_id', '=', 2)->get();
        return view('pages.services')->withPosts($posts);
    }

    public function getRates()
    {
        $posts = Post::where('category_id', '=', 3)->get();
        return view('pages.rates')->withPosts($posts);
    }

    public function getCommon()
    {
        $posts = Post::where('category_id', '=', 4)->get();
        return view('pages.common')->withPosts($posts);
    }

    public function getHeirs()
    {
        $posts = Post::where('category_id', '=', 5)->get();
        return view('pages.heirs')->withPosts($posts);
    }

    public function getEstate()
    {
        $posts = Post::where('category_id', '=', 6)->get();
        return view('pages.estate')->withPosts($posts);
    }

    public function getCorporate()
    {
        $posts = Post::where('category_id', '=', 7)->get();
        return view('pages.corporate')->withPosts($posts);
    }


    public function getAbout() {
        $first = 'Alex';
        $last = 'Curtis';

        $fullname = $first . " " . $last;
        $email = 'alex@jacurtis.com';
        $data = [];
        $data['email'] = $email;
        $data['fullname'] = $fullname;
        return view('pages.about')->withData($data);
    }

    public function getContact() {
        return view('pages.contact');
    }

    public function postContact(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'subject' => 'min:3',
            'message' => 'min:10']);

        $data = array(
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message
        );

        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('hello@devmarketer.io');
            $message->subject($data['subject']);
        });

        Session::flash('success', 'Your Email was Sent!');

        return redirect('/');
    }


}