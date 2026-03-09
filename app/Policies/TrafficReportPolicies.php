<?php

namespace App\Policies;

use App\Models\Reports\TrafficReport;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TrafficReportPolicies
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('traffic_reports.view_any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TrafficReport $traffictReport): bool
    {
        return $user->can('traffic_reports.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('traffic_reports.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TrafficReport $traffictReport): bool
    {
        return $user->can('traffic_reports.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TrafficReport $traffictReport): bool
    {
        return $user->can('traffic_reports.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TrafficReport $traffictReport): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TrafficReport $traffictReport): bool
    {
        return false;
    }
}
