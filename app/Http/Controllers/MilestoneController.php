<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Models\Milestone;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function getUserNextMilestone($current_hours) {
        $milestone = [];

        if ($milestone = Milestone::where('deleted_at', null)
            ->where('num_hours', '>', $current_hours)->first()) {
            unset($milestone->id);
            unset($milestone->created_at);
            unset($milestone->updated_at);
            unset($milestone->deleted_at);
        }

        return $milestone;
    }
}
