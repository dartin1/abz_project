<?php

namespace App\Http\Controllers;

use App\Employer;
use Illuminate\Http\Request;

//use App\Http\Requests;

use App\Article;

/**
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{
    /**
     * main page
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id = null)
    {
        $main_list = Employer::find(1);
        $tree = '<ul id="browser" class="sortable">';
        $tree .= '<li id="list_' . $main_list->id . '"><div><p >' . $main_list->fio . ', ' . $main_list->position . '</p></div>';
        $tree .= '<ul>';
        $main_list = $main_list->load('childs');
        foreach ($main_list->childs as $list) {
            if ($list->id == $id) {
                $tree .= '<li id="list_' . $list->id . '"><div><a href="' . $list->id . '">' . $list->fio . ', ' . $list->position . '</a></div>';
                $tree .= '<ul>';
                $child_list = Employer::find($id);
                foreach ($child_list->childs as $list) {
                    $tree .= '<li id="list_' . $list->id . '"><div><p>' . $list->fio . ', ' . $list->position . '</p></div>';
                    if (count($list->childs)) {
                        $tree .= $this->childView($list);
                    }
                }
                $tree .= '</ul></li>';
            } else
                $tree .= '<li id="list_' . $list->id . '"><div><a href="' . $list->id . '">' . $list->fio . ', ' . $list->position . '</a></div></li>';
        }

        $tree .= '</ul>';
        return view('index', compact('tree'));

    }
    /**
     * view employer branch
     * @param $child_list
     * @return string
     */
    public function childView($child_list)
    {
        $tree = '<ul>';
        foreach ($child_list->childs as $arr) {
            if (count($arr->childs)) {
                $tree .= '<li id="list_' . $arr->id . '"><div><p>' . $arr->fio . ', ' . $arr->position . '</p></div>';
                $tree .= $this->childView($arr);
            } else {
                $tree .= '<li id="list_' . $arr->id . '"><div><p>' . $arr->fio . ', ' . $arr->position . '</p></div>';
            }
        }
        $tree .= "</ul></li>";
        return $tree;
    }

    /**
     *drag-n-drop employer tree
     */
    public function saving()
    {
        $list = $_POST['list'];
        $pieces = explode("&", $list);
        for( $i = 2; $i < count($pieces)-1; $i++){
            $part = explode("=", $pieces[$i-1]);
            $id = (int)preg_replace('/[^\d]+/', '', $part[0]);
            $chief = $part[1];
            $tmp = Employer::find($id);
            ($chief == "null") ? $tmp->chief = 0 : $tmp->chief = $chief;
            $tmp->save();
        }
    }
}