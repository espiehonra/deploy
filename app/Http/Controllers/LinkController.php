<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use Auth;


class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$links=Link::orderBy('dAdded ','desc');
        $user = auth()->user();
        $links=Link::orderBy('id','desc')->get();
        $data=array(
            'empno'=>$user->empno,
            'links'=>$links,
            'userLevel'=>$user->userLevel
        );
        return view('links.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $linkArr=$request->link;
        $linkTitleArr=$request->linkTitle;
        $linkDescriptionArr=$request->linkDescription;
        $empno=$request->empno;
        $ctrEmpty=0;
        for ($x = 0; $x < sizeof($linkArr); $x++) {
            if (trim($linkArr[$x]) != '' && trim($linkTitleArr[$x])!='' && trim($linkDescriptionArr[$x])!='' ){
                $link=new Link;
                $link->link=$linkArr[$x];
                $link->vLinkTitle=$linkTitleArr[$x];
                $link->vLinkDescription =$linkDescriptionArr[$x];
                $link->addedBy =$empno;
                $link->dAdded  =date('Y-m-d h:i:s');
                $link->save();
            } else {
                $ctrEmpty++;
            }
        } 
        if($request->idcol!=""){
            $idcolArr=explode("^",$request->idcol); 
            $linkColArr=explode("^^@",$request->linkCol);
            $titleColArr=explode("^^@",$request->titleCol);
            $detailColArr=explode("^^@",$request->detailCol);
            for ($x = 1; $x < sizeof($idcolArr); $x++) {
                if (trim($linkColArr[$x]) != '' && trim($titleColArr[$x])!='' && trim($detailColArr[$x])!='' ){
                    $link = Link::find($idcolArr[$x]);
                    $link->link=$linkColArr[$x];
                    $link->vLinkTitle=$titleColArr[$x];
                    $link->vLinkDescription =$detailColArr[$x];
                    $link->addedBy =$empno;
                    $link->dAdded  =date('Y-m-d h:i:s');
                    $link->save();
                }
            }

        }
        if($ctrEmpty>0){ echo 1;}
        else{ echo 0;}
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Link::find($id)->delete();
    }
}
