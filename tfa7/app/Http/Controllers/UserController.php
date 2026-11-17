<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;

class UserController extends Controller
{
    /**
     * List all users with their prepared avatars (or the placeholder).
     */
    public function index()
    {
        $users = User::orderBy('username')->get();

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the Create User form.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Validate and store a new user.
     * On failure, Laravel redirects back with $errors and old() input.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'full_name' => ['required', 'string', 'max:255'],
        ]);

        User::create($validated);

        return redirect()->route('users.index')->with('status', 'User created successfully.');
    }

    /**
     * Show the Edit User form, pre-filled, including the avatar file input.
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Validate and update an existing user, optionally replacing the
     * avatar: the upload is validated (image, max 2MB), prepared as a
     * display-ready 256x256 JPEG with Intervention Image, stored on the
     * public disk, and only the resulting path is saved in the avatar column.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user)],
            'full_name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $validated['avatar'] = $this->storePreparedAvatar(
                $request->file('avatar'),
                $validated['username']
            );
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('status', 'User updated successfully.');
    }

    /**
     * Validate (by type/size rules above), prepare for display, and store
     * an uploaded avatar. Returns the stored path relative to the public disk.
     */
    private function storePreparedAvatar(UploadedFile $file, string $username): string
    {
        $image = ImageManager::gd()->read($file->getRealPath());
        $image->cover(256, 256);

        $filename = 'avatars/' . Str::slug($username) . '-' . time() . '.jpg';

        Storage::disk('public')->put($filename, (string) $image->toJpeg(80));

        return $filename;
    }
}
