<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function addPage(Request $request)
    {
        $data = $request->validate([
            'page_name' => 'required|string|unique:pages',
            'page_url' => 'required|string',
            'content' => 'required|min:3'
        ]);

        $page = new Page([
            'page_name' => $data['page_name'],
            'page_url' => $data['page_url'],
            'content' => $data['content'],
        ]);

        if ($page->save()) {
            $last = Page::find($page->id);
            return response()->json($last);
        } else {
            return response()->json('Error');
        }
    }

    public function updatePage(Request $request)
    {
        $data = $request->validate([
            'page_name' => 'required|string|unique:pages',
            'content' => 'required|min:3'
        ]);
        $page = DB::table('pages')
            ->where('id', $request->pageId)
            ->update([
                'page_name' => $data['page_name'],
                'content' => $data['content'],
            ]);
        if ($page) {
            $last = Page::find($request->pageId);
            return response()->json($last);
        } else {
            return response()->json('Error');
        }
    }

    public function getPages(Request $request)
    {
        $page_info = array();
        $pages_info = array();
        $pages = DB::table('pages')
            ->orderByRaw('created_at DESC')
            ->get();
        foreach ($pages as $page) {
            $page_info['id'] = $page->id;
            $page_info['page_name'] = $page->page_name;
            $page_info['page_url'] = $page->page_url;
            $page_info['content'] = $page->content;
            $page_info['date'] = $page->created_at;
            array_push($pages_info, $page_info);
        }
        return response()->json($pages_info);
    }

    public function getPage($pageId)
    {
        $page_info = array();
        $pages_info = array();
        $pages = DB::table('pages')
            ->where('id', $pageId)
            ->orderByRaw('created_at DESC')
            ->get();
        foreach ($pages as $page) {
            $page_info['id'] = $page->id;
            $page_info['page_name'] = $page->page_name;
            $page_info['page_url'] = $page->page_url;
            $page_info['content'] = $page->content;
            $page_info['date'] = $page->created_at;
            array_push($pages_info, $page_info);
        }
        return response()->json($pages_info);
    }

    public function removePage($pageId)
    {
        $page = Page::find($pageId);
        $page->delete();
        return response()->json($pageId);
    }

    public function ContactUsMailRequest(Request $request)
    {
        $company_email = 'imanzi.rw@gmail.com';
        $details = [
            'title' => 'Mail from Artise.africa',
            'names' => $request->names,
            'email' => $request->email,
            'message' => $request->message,
        ];

        Mail::to($request->email)->send(new \App\Mail\ContactUsMail($details));
        return response()->json("Success");
    }
}
