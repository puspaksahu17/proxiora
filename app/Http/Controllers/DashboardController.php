<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        return match ($user->role) {
            'admin' => view('dashboard.admin', [
                'subadmins' => User::where('role', 'subadmin')->withCount('assignedStudents')->orderBy('name')->get(),
                'students' => User::where('role', 'student')->with('assignedSubadmin')->orderBy('name')->get(),
            ]),
            'subadmin' => view('dashboard.subadmin', [
                'students' => $user->assignedStudents()->orderBy('name')->get(),
            ]),
            default => view('dashboard.student', ['milestones' => $this->milestones()]),
        };
    }

    private function milestones(): array
    {
        return [
            0 => 'Start', 10 => 'Profile Information Submitted', 20 => 'Career Assessment Completed',
            35 => 'Career Roadmap Generated', 50 => 'ATS Resume Guidance Completed',
            65 => 'LinkedIn Profile Review Completed', 80 => 'Interview Preparation Shared',
            90 => 'Job Search Strategy Shared', 100 => 'Subscription Successfully Completed',
        ];
    }
}
