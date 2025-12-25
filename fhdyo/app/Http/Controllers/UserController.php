<?php

namespace App\Http\Controllers;

use App\Models\Couple;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (!$this->checkRole()) {
            return abort(403, "You don't have permission");
        }
        $perPage = request()->get('per_page', 13);
        $query = User::query();

        // 🔍 Qidiruvlar

        if ($user = request('gender')) {
            $query->whereHas('userData', function ($q) use ($user) {
                $q->where('gender', $user);
            });
        }

        if ($birthday = request('birthday')) {
            $query->whereHas('userData', function ($q) use ($birthday) {
                $q->where('birthday', 'like', "%{$birthday}%");
            });
        }


        if ($name = request('name')) {
            $query->where('name', 'like', "%{$name}%");
        }

        if ($user = request('role')) {
            $query->whereHas('userData', function ($q) use ($user) {
                $q->where('role', $user);
            });
        }

        if ($passportId = request('email')) {
            $query->where('email', 'like', "%{$passportId}%");
        }


        if ($createdSort = request('name_sort')) {
            $query->orderBy('name', $createdSort);
        } elseif ($emailSort = request('email_sort')) {
            $query->orderBy('email', $emailSort);
        } elseif ($roleSort = request('role_sort')) {
            $query->orderBy('role', $roleSort);
        } elseif ($genderSort = request('gender_sort')) {
            $query->join('user_data', 'user_data.user_id', '=', 'users.id')
                ->orderBy('user_data.gender', $genderSort)
                ->select('users.*');
        } elseif ($birthdaySort = request('birthday_sort')) {
            $query->join('user_data', 'user_data.user_id', '=', 'users.id')
                ->orderBy('user_data.birthday', $birthdaySort)
                ->select('users.*');
        } else {
            $query->orderBy('created_at', 'desc');
        }


        // 🔢 Paginate
        $count = $query->count();
        $users = $query->paginate($perPage);

        // ❌ Agar page > lastPage bo‘lsa, oxirgi sahifaga redirect
        if (request()->get('page') > $users->lastPage()) {
            return redirect()->route('users.index', [
                'page' => $users->lastPage(),
                'per_page' => $perPage
            ] + request()->except(['page']));
        }

        return view('user.index', compact('users', 'count'));
    }

    public function create()
    {
        if (!$this->checkRole()) {
            return abort(403, "You don't have permission");
        }
        return view('user.create');
    }

    public function store(Request $request)
    {
        if (!$this->checkRole()) {
            return abort(403, "You don't have permission");
        }
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,super_admin',
        ]);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        $userData = $request->validate([
            'gender' => 'nullable|in:male,female',
            'birthday' => 'nullable|date',
            'avater' => 'nullable|image|max:10240'
        ]);

        $userData['user_id'] = $user->id;

        UserData::create($userData);

        return redirect()->route('users.index')->with('success', 'Admin created successfully');
    }

    public function show(User $user)
    {
        $perPage = request()->get('per_page', 13);
        $query = $user->couples();

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
            $query->join('humans as husband', 'couples.husband', '=', 'husband.id')
                ->orderBy('husband.first_name', $husbandSort)
                ->select('couples.*');
        } elseif ($wifeSort = request('wife_sort')) {
            $query->join('humans as wife', 'couples.wife', '=', 'wife.id')
                ->orderBy('wife.first_name', $wifeSort)
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

        return view('user.show', compact('user', 'couples', 'count'));
    }

    public function edit(User $user)
    {
        if (!$this->checkRole()) {
            return abort(403, "You don't have permission");
        }
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (!$this->checkRole()) {
            return abort(403, "You don't have permission");
        }
        $data = $request->validate([
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:users,email',
            'password' => 'sometimes|required|string|min:6|confirmed',
            'role' => 'sometimes|required|in:admin,super_admin',
        ]);

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        $userData = $request->validate([
            'gender' => 'sometimes|nullable|in:male,female',
            'birthday' => 'sometimes|nullable|date',
            'avater' => 'sometimes|nullable|image|max:10240'
        ]);

        $user->userData()->update(['user_id' => $user->id], $userData);


        return redirect()->route('users.index')->with('success', 'Admin created successfully');
    }

    public function destroy($id)
    {
        if (!$this->checkRole()) {
            return abort(403, "You don't have permission");
        }
        if ($id == -1) {
            $ids = request()->input('users', []);
            User::whereIn('id', $ids)->delete();
            return redirect()->route('users.index')->with('success', 'Selected users deleted successfully');
        }
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Selected users deleted successfully');
    }

    public function checkRole()
    {
        return Auth::user()->role == 'super_admin';
    }
}
