<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use App\Models\SavedScholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScholarshipController extends Controller
{

    public function index(Request $request)
    {
        $query = Scholarship::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('institution', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category') && $request->input('category') !== 'all') {
            $query->where('category', $request->input('category'));
        }

        // Filter by type
        if ($request->filled('type') && $request->input('type') !== 'all') {
            $query->where('type', $request->input('type'));
        }

        // Filter by status (active/inactive)
        if ($request->filled('status')) {
            if ($request->input('status') === 'active') {
                $query->whereRaw('NOW() BETWEEN open_date AND close_date');
            } elseif ($request->input('status') === 'closed') {
                $query->where('close_date', '<', now());
            }
        }

        // Get distinct values for filters
        $categories = Scholarship::distinct()->pluck('category')->sort();
        $types = Scholarship::distinct()->pluck('type')->sort();

        // Paginate results
        $scholarships = $query->latest('created_at')->paginate(4)->appends($request->query());

        return view('scholarships.index', compact('scholarships', 'categories', 'types'));
    }

    public function saved(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $query = SavedScholarship::where('user_id', $user->id)
            ->with('scholarship');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('scholarship', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('institution', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category') && $request->input('category') !== 'all') {
            $category = $request->input('category');
            $query->whereHas('scholarship', function ($q) use ($category) {
                $q->where('category', $category);
            });
        }

        // Filter by type
        if ($request->filled('type') && $request->input('type') !== 'all') {
            $type = $request->input('type');
            $query->whereHas('scholarship', function ($q) use ($type) {
                $q->where('type', $type);
            });
        }

        // Get all saved scholarships for filter options
        $allSaved = SavedScholarship::where('user_id', $user->id)
            ->with('scholarship')
            ->get();

        $categories = $allSaved->pluck('scholarship.category')->unique()->sort()->values();
        $types = $allSaved->pluck('scholarship.type')->unique()->sort()->values();

        // Paginate results
        $scholarships = $query->latest('created_at')->paginate(8)->appends($request->query());

        // Map scholarship relationship
        $scholarships->getCollection()->transform(function ($saved) {
            return $saved->scholarship;
        });

        return view('scholarships.saved', compact('scholarships', 'categories', 'types'));
    }

    public function toggleSave(Scholarship $scholarship)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $saved = SavedScholarship::where('user_id', $user->id)
            ->where('scholarship_id', $scholarship->id)
            ->first();

        if ($saved) {
            $saved->delete();
            return back()->with('success', 'Beasiswa dihapus dari penyimpanan');
        } else {
            SavedScholarship::create([
                'user_id' => $user->id,
                'scholarship_id' => $scholarship->id,
            ]);
            return back()->with('success', 'Beasiswa ditambahkan ke penyimpanan');
        }
    }

    public function isSaved(Scholarship $scholarship)
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        return SavedScholarship::where('user_id', $user->id)
            ->where('scholarship_id', $scholarship->id)
            ->exists();
    }
}


