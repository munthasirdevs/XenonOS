<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;

class SystemController extends Controller
{
    use ApiResponse;

    public function health()
    {
        $dbStatus = 'ok';
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            $dbStatus = 'error';
        }

        $cacheStatus = 'ok';
        try {
            cache()->put('health_check', 'ok', 1);
            cache()->forget('health_check');
        } catch (\Exception $e) {
            $cacheStatus = 'error';
        }

        return $this->success([
            'database' => $dbStatus,
            'cache' => $cacheStatus,
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    public function stats()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();
        
        $totalClients = Client::count();
        $activeClients = Client::where('status', 'active')->count();
        
        $totalProjects = Project::count();
        $activeProjects = Project::whereIn('status', ['active', 'in_progress'])->count();
        
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'completed')->count();
        
        $totalInvoices = Invoice::count();
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');
        
        $pendingInvoices = Invoice::whereIn('status', ['draft', 'sent'])->count();
        $paidInvoices = Invoice::where('status', 'paid')->count();

        return $this->success([
            'users' => [
                'total' => $totalUsers,
                'active' => $activeUsers,
            ],
            'clients' => [
                'total' => $totalClients,
                'active' => $activeClients,
            ],
            'projects' => [
                'total' => $totalProjects,
                'active' => $activeProjects,
            ],
            'tasks' => [
                'total' => $totalTasks,
                'completed' => $completedTasks,
                'completion_rate' => $totalTasks > 0 ? round($completedTasks / $totalTasks * 100, 1) : 0,
            ],
            'invoices' => [
                'total' => $totalInvoices,
                'pending' => $pendingInvoices,
                'paid' => $paidInvoices,
            ],
            'revenue' => [
                'total' => $totalRevenue,
            ],
        ]);
    }

    public function info()
    {
        return $this->success([
            'app_name' => config('app.name', 'XenonOS'),
            'app_version' => '1.0.0',
            'laravel_version' => app()->version(),
            'php_version' => PHP_VERSION,
            'timezone' => config('app.timezone'),
            'locale' => config('app.locale'),
            'environment' => config('app.env'),
            'debug' => config('app.debug'),
        ]);
    }

    public function routes()
    {
        $routes = collect(app('router')->getRoutes())->map(function ($route) {
            return [
                'uri' => $route->uri(),
                'methods' => $route->methods(),
                'name' => $route->getName(),
            ];
        });

        return $this->success($routes);
    }

    public function services()
    {
        $services = [
            'database' => DB::connection()->getPdo() ? 'connected' : 'disconnected',
            'cache' => config('cache.default'),
            'queue' => config('queue.default'),
            'mail' => config('mail.default') ?? 'not configured',
            'storage' => config('filesystems.default'),
        ];

        return $this->success($services);
    }
}