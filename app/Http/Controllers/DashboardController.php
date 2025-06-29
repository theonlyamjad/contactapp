<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\City;
use App\Models\Business;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user(); 

        if (!$user) {
            return redirect()->route('welcome');
        }

        // Fetch authenticated user's data
        $totalPersons = Person::where('user_id', $user->id)->count();
        $totalMales = Person::where('user_id', $user->id)->where('gender', 'male')->count();
        $totalFemales = Person::where('user_id', $user->id)->where('gender', 'female')->count();
        $totalBusiness = Business::where('user_id', $user->id)->count();
        $greeting = $this->getGreeting();

        // Fetch tasks belonging to the logged-in user
        $totalTaskDone = Task::where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereHasMorph('taskable', [Person::class, Business::class])
            ->count();

        $totalTasksDoneByPeople = Task::where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereHasMorph('taskable', [Person::class])
            ->count();

        $totalTasksDoneByBusiness = Task::where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereHasMorph('taskable', [Business::class])
            ->count();

        // Fetch only the top business cities of this user
        $topBusinessCities = City::whereHas('businesses', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->withCount(['businesses' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->orderByDesc('businesses_count')
            ->limit(5)
            ->get(['id', 'ville', 'businesses_count']);

        

        
        return view('dashboard', compact(
            'user', 'totalPersons',
            'totalMales', 'totalFemales', 'totalBusiness',
            'totalTaskDone', 'totalTasksDoneByPeople', 'totalTasksDoneByBusiness',
            'topBusinessCities', 'greeting'
        ));
    }

    private function getGreeting()
    {
        $hour = Carbon::now()->hour;

        if ($hour >= 5 && $hour < 12) {
            return 'Good Morning 🌅';
        } elseif ($hour >= 12 && $hour < 18) {
            return 'Good Afternoon ☀️';
        } else {
            return 'Good Evening 🌇';
        }
    }
}
