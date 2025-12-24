<?php

namespace App\Http\Controllers;

use App\Models\Couple;
use App\Models\Human;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $query->where('created_at', 'like', "%{$created_at}%");
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

        if ($result = request('results')) {
            if ($result === '0-50') {
                $query->where('result', '>=', 0)->where('result', '<=', 50);
            } elseif ($result === '51-80') {
                $query->where('result', '>=', 51)->where('result', '<=', 80);
            } elseif ($result === '81-100') {
                $query->where('result', '>=', 81)->where('result', '<=', 100);
            }
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
            $query->orderBy('result', $resultsSort);
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

    public function create()
    {
        $humans = Human::all();
        return view('couple.create', compact('humans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'husband' => 'required|integer|exists:humans,id',
            'wife' => 'required|integer|exists:humans,id',
            'status' => 'required|in:married,unmarried,divorced',
        ]);

        $data['user_id'] = 1;
        // $data['user_id'] = Auth::id();

        while (true) {
            $data['husband_key'] = bin2hex(random_bytes(4));
            $data['wife_key'] = bin2hex(random_bytes(4));

            $exists = Couple::where('husband_key', $data['husband_key'])
                ->orWhere('wife_key', $data['wife_key'])
                ->exists();

            if (!$exists) {
                break;
            }
        }

        Couple::create($data);
        return redirect()->route('couples.index')->with('success', 'Couple created successfully');
    }


    public function show($id)
    {
        $couple = Couple::with('answers')->findOrFail($id);

        // 1-usul: Collection metodlari bilan
        $husbandAnswers = $couple->answers
            ->where('key', $couple->husband_key)
            ->sortBy('question_id')
            ->values();

        $wifeAnswers = $couple->answers
            ->where('key', $couple->wife_key)
            ->sortBy('question_id')
            ->values();

        // Javoblarni birlashtirish
        $answers = [];
        foreach ($husbandAnswers as $index => $husbandAnswer) {
            $answers[] = [
                'question' => $husbandAnswer->question->question,
                'category' => $husbandAnswer->question->category->category,
                'husband' => $husbandAnswer->answer,
                'wife' => $wifeAnswers[$index]->answer ?? null,
            ];
        }

        return view('couple.show', compact('couple', 'answers'));
    }

    public function edit(Couple $couple)
    {
        $humans = Human::all();
        return view('couple.edit', compact('couple', 'humans'));
    }

    public function update(Request $request, Couple $couple)
    {
        $data = $request->validate([
            'husband' => 'integer|exists:humans,id',
            'wife' => 'integer|exists:humans,id',
            'status' => 'nullable|in:married,unmarried,divorced',
        ]);

        $data['user_id'] = 1;
        // $data['user_id'] = Auth::id();

        while (true) {
            $data['husband_key'] = bin2hex(random_bytes(4));
            $data['wife_key'] = bin2hex(random_bytes(4));

            $exists = Couple::where('husband_key', $data['husband_key'])
                ->orWhere('wife_key', $data['wife_key'])
                ->exists();

            if (!$exists) {
                break;
            }
        }

        $couple->update($data);
        return redirect()->route('couples.index')->with('success', 'Couple updated successfully');
    }

    public function destroy($id)
    {
        if ($id == -1) {
            $ids = request()->input('couples', []);
            Couple::whereIn('id', $ids)->delete();
            return redirect()->route('couples.index')->with('success', 'Selected couples deleted successfully');
        }
        $couple = Couple::findOrFail($id);
        $couple->delete();
        return redirect()->route('couples.index')->with('success', 'Couple deleted successfully');
    }
}
