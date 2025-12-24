<?php

namespace App\Http\Controllers;

use App\Models\Couple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoupleController extends Controller
{
    public function index()
    {
        $perPage = request()->get('per_page', 13);
        $query = Couple::query();

        // 🔍 Qidiruvlar
        if ($husband = request('husband')) {
            $query->whereHas('husbandData', function ($q) use ($husband) {
                $q->where(function ($subQ) use ($husband) {
                    $subQ->where('first_name', 'like', "%{$husband}%")
                        ->orWhere('middle_name', 'like', "%{$husband}%")
                        ->orWhere('last_name', 'like', "%{$husband}%");
                });
            });
        }

        if ($wife = request('wife')) {
            $query->whereHas('wifeData', function ($q) use ($wife) {
                $q->where(function ($subQ) use ($wife) {
                    $subQ->where('first_name', 'like', "%{$wife}%")
                        ->orWhere('middle_name', 'like', "%{$wife}%")
                        ->orWhere('last_name', 'like', "%{$wife}%");
                });
            });
        }

        if ($created_at = request('created_at')) {
            $query->whereDate('created_at', $created_at);
        }

        if ($user = request('user')) {
            $query->whereHas('user', function ($q) use ($user) {
                $q->where('name', 'like', "%{$user}%");
            });
        }

        if ($status = request('status')) {
            $query->where('status', $status);
        }

        if ($passportId = request('passport_id')) {
            $query->where('passport_id', 'like', "%{$passportId}%");
        }

        if ($address = request('address')) {
            $query->where(function ($q) use ($address) {
                $q->where('province', 'like', "%{$address}%")
                    ->orWhere('region', 'like', "%{$address}%");
            });
        }


        // 🔽 Sortlashlar
        if ($createdSort = request('created_at_sort')) {
            $query->orderBy('created_at', $createdSort);
        } elseif ($statusSort = request('status_sort')) {
            $query->orderBy('status', $statusSort);
        } elseif ($husbandSort = request('husband_sort')) {
            $query->join('humans as husband', 'couples.husband_id', '=', 'husband.id')
                ->orderBy('husband.first_name', $husbandSort)
                ->select('couples.*');
        } elseif ($wifeSort = request('wife_sort')) {
            $query->join('humans as wife', 'couples.wife_id', '=', 'wife.id')
                ->orderBy('wife.first_name', $wifeSort)
                ->select('couples.*');
        } elseif ($userSort = request('user_sort')) {
            $query->join('users', 'couples.user_id', '=', 'users.id')
                ->orderBy('users.name', $userSort)
                ->select('couples.*');
        } elseif ($resultsSort = request('results_sort')) {
            $query->leftJoinSub(
                DB::table('couple_results')
                    ->select('couple_id', DB::raw('SUM(percent) as total_percent'))
                    ->groupBy('couple_id'),
                'result_stats',
                'couples.id',
                '=',
                'result_stats.couple_id'
            )->orderBy('result_stats.total_percent', $resultsSort)
                ->select('couples.*', 'result_stats.total_percent');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        // 🔢 Paginate
        $count = $query->count();
        $couples = $query->with(['husbandData', 'wifeData', 'user'])->paginate($perPage);

        // ❌ Agar page > lastPage bo'lsa, oxirgi sahifaga redirect
        if (request()->get('page') > $couples->lastPage() && $couples->lastPage() > 0) {
            return redirect()->route('couples.index', array_merge(
                request()->except(['page']),
                ['page' => $couples->lastPage(), 'per_page' => $perPage]
            ));
        }

        return view('couple.index', compact('couples', 'count'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'husband' => 'required|integer|exists:humans,id',
            'wife' => 'required|integer|exists:humans,id',
            'husband_key' => 'nullable|string',
            'wife_key' => 'nullable|string',
            'status' => 'nullable|string',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        return Couple::create($data);
    }

    public function show(Couple $couple)
    {
        return $couple->load(['husbandData', 'wifeData', 'user', 'answers', 'results']);
    }

    public function update(Request $request, Couple $couple)
    {
        $data = $request->validate([
            'husband' => 'integer|exists:humans,id',
            'wife' => 'integer|exists:humans,id',
            'husband_key' => 'nullable|string',
            'wife_key' => 'nullable|string',
            'status' => 'nullable|string',
            'user_id' => 'integer|exists:users,id',
        ]);

        $couple->update($data);
        return $couple;
    }

    public function destroy(Couple $couple)
    {
        $couple->delete();
        return response()->json(['message' => 'Couple deleted']);
    }
}
