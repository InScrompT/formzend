<?php

namespace Tests\Feature\Controller;

use App\Models\Account;
use App\Models\Submission;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_view_verified_dashboard()
    {
        $this->get(route('dashboard'))
            ->assertRedirect(route('login'));
    }

    public function test_user_can_view_verified_dashboard()
    {
        $account = Account::first();
        $verifiedWebsites = $account
            ->websites()
            ->where('verified', true)
            ->withCount('submissions')
            ->get();

        $this->actingAs($account)
            ->get(route('dashboard'))
            ->assertViewIs('dashboard.show')
            ->assertViewHasAll([
                'websites' => $verifiedWebsites
            ]);
    }

    public function test_guest_cannot_view_unverified_dashboard()
    {
        $this->get(route('dashboard.websites.unverified'))
            ->assertRedirect(route('login'));
    }

    public function test_user_can_view_unverified_dashboard()
    {
        $account = Account::first();
        $unverifiedWebsites = $account
            ->websites()
            ->where('verified', false)
            ->withCount('submissions')
            ->get();

        $this->actingAs($account)
            ->get(route('dashboard.websites.unverified'))
            ->assertViewIs('dashboard.unverified')
            ->assertViewHasAll([
                'websites' => $unverifiedWebsites
            ]);
    }

    public function test_guest_cannot_list_submissions()
    {
        $website = Website::whereVerified(true)->first();

        $this->get(route('dashboard.website.submissions', $website))
            ->assertRedirect(route('login'));
    }

    public function test_user_can_list_submissions()
    {
        $website = Website::whereVerified(true)->first();

        $this->actingAs($website->account)
            ->get(route('dashboard.website.submissions', $website))
            ->assertViewIs('dashboard.submissions.list')
            ->assertViewHasAll([
                'website' => $website,
                'submissions' => $website->submissions()->latest()->paginate(50),
            ]);
    }

    public function test_guest_cannot_view_submission()
    {
        $submission = Submission::first();

        $this->get(route('dashboard.website.submissions.show', $submission))
            ->assertRedirect(route('login'));
    }

    public function test_user_can_view_submission()
    {
        $submission = Submission::with('account')->first();

        $this->actingAs($submission->account)
            ->get(route('dashboard.website.submissions.show', $submission))
            ->assertViewIs('dashboard.submissions.show')
            ->assertViewHas('submission', $submission);
    }
}
