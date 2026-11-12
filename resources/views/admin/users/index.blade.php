@extends('admin.layouts.app')

@section('title', 'Users & RBAC Roles')
@section('header_title', 'Staff Governance & Roles')

@section('content')
<div class="space-y-8">

  <!-- Header & Add User Toggle -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <div class="label-caps text-[#D4F54F] mb-1">Access Control Architecture</div>
      <h2 class="font-head text-2xl font-bold text-[#F2F5EC]">Administrative Staff & Roles</h2>
      <p class="text-xs text-[#9AA391] mt-1">Govern RBAC permissions across Super Admin, Admin, Editor, and Viewer tiers.</p>
    </div>
    <div>
      <button onclick="document.getElementById('create-user-modal').classList.toggle('hidden')"
        class="px-5 py-2.5 rounded-full bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-colors flex items-center gap-2 shadow-lg shadow-[#D4F54F]/20">
        <span>+ Add Staff Member</span>
      </button>
    </div>
  </div>

  <!-- Create User Modal -->
  <div id="create-user-modal" class="hidden fixed inset-0 z-50 bg-black/80 grid place-items-center p-4">
    <div class="glass p-8 rounded-3xl max-w-lg w-full border border-white/10 relative">
      <div class="flex items-center justify-between mb-6 pb-3 border-b border-white/10">
        <div>
          <div class="label-caps text-[#D4F54F] mb-1">Provision Account</div>
          <h3 class="font-head text-xl font-bold text-[#F2F5EC]">Create Staff Member</h3>
        </div>
        <button onclick="document.getElementById('create-user-modal').classList.add('hidden')" class="text-[#9AA391] hover:text-white">✕</button>
      </div>

      <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Full Name</label>
          <input type="text" name="name" required class="w-full px-4 py-2.5 bg-white/[0.04] border border-white/10 rounded-xl text-xs text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
        </div>

        <div>
          <label class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Work Email</label>
          <input type="email" name="email" required class="w-full px-4 py-2.5 bg-white/[0.04] border border-white/10 rounded-xl text-xs text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
        </div>

        <div>
          <label class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Role Tier</label>
          <select name="role" required class="w-full px-4 py-2.5 bg-white/[0.04] border border-white/10 rounded-xl text-xs font-mono text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
            <option value="viewer" class="bg-[#101210]">Viewer (Read-only submissions & metrics)</option>
            <option value="editor" class="bg-[#101210]">Editor (View and update lead stages)</option>
            <option value="admin" class="bg-[#101210]">Admin (Full manage access, logs, exports)</option>
            <option value="super_admin" class="bg-[#101210]">Super Admin (Complete system governance)</option>
          </select>
        </div>

        <div>
          <label class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Temporary Password (min 8 chars)</label>
          <input type="password" name="password" required class="w-full px-4 py-2.5 bg-white/[0.04] border border-white/10 rounded-xl text-xs text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
        </div>

        <div class="pt-4 flex items-center justify-end gap-3">
          <button type="button" onclick="document.getElementById('create-user-modal').classList.add('hidden')"
            class="px-4 py-2 rounded-xl text-xs font-mono text-[#9AA391] hover:text-white">
            Cancel
          </button>
          <button type="submit"
            class="px-6 py-2.5 rounded-full bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-colors">
            Create User
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Users Table -->
  <div class="glass rounded-3xl border border-white/10 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse text-xs">
        <thead>
          <tr class="border-b border-white/[0.08] bg-white/[0.02] text-[#9AA391] font-mono uppercase tracking-wider">
            <th class="py-4 px-6">Name & Email</th>
            <th class="py-4 px-6">Assigned Role</th>
            <th class="py-4 px-6">Status</th>
            <th class="py-4 px-6">Last Login</th>
            <th class="py-4 px-6">Created</th>
            <th class="py-4 px-6 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/[0.06]">
          @foreach($users as $u)
          <tr class="hover:bg-white/[0.02] transition-colors">
            <td class="py-4 px-6">
              <div class="font-head font-bold text-sm text-[#F2F5EC]">{{ $u->name }}</div>
              <div class="font-mono text-[#9AA391] mt-0.5">{{ $u->email }}</div>
            </td>
            <td class="py-4 px-6">
              <span class="px-2.5 py-1 rounded-full text-[10px] font-mono uppercase font-bold tracking-wider {{ $u->isSuperAdmin() ? 'bg-[#D4F54F]/20 text-[#D4F54F] border border-[#D4F54F]/30' : ($u->isAdmin() ? 'bg-cyan-500/20 text-cyan-400 border border-cyan-500/30' : ($u->isEditor() ? 'bg-amber-500/20 text-amber-400 border border-amber-500/30' : 'bg-white/10 text-[#9AA391]')) }}">
                {{ str_replace('_', ' ', $u->role) }}
              </span>
            </td>
            <td class="py-4 px-6">
              <span class="px-2.5 py-1 rounded-full text-[10px] font-mono uppercase font-bold tracking-wider {{ $u->status === 'active' ? 'bg-[#D4F54F]/10 text-[#D4F54F]' : 'bg-red-500/10 text-red-400' }}">
                {{ $u->status }}
              </span>
            </td>
            <td class="py-4 px-6 font-mono text-[#9AA391]">
              @if($u->last_login_at)
              {{ $u->last_login_at->format('M d, Y · h:i A') }}<br>
              <span class="text-[10px]">IP: {{ $u->last_login_ip }}</span>
              @else
              <span class="text-white/20">Never</span>
              @endif
            </td>
            <td class="py-4 px-6 font-mono text-[#9AA391]">
              {{ $u->created_at->format('M d, Y') }}
            </td>
            <td class="py-4 px-6 text-right">
              <div class="flex items-center justify-end gap-2">
                <!-- Edit button toggle -->
                <button onclick="document.getElementById('edit-user-{{ $u->id }}').classList.toggle('hidden')"
                  class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/10 text-[#9AA391] hover:text-[#F2F5EC] text-xs font-mono transition-colors">
                  Edit Role
                </button>

                @if($u->id !== auth()->id())
                <!-- Delete user -->
                <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Permanently remove {{ $u->name }}?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="p-1.5 rounded-lg text-red-400/80 hover:text-red-400 hover:bg-red-500/10 transition-colors" title="Delete User">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
                </form>
                @endif
              </div>

              <!-- Edit User Modal -->
              <div id="edit-user-{{ $u->id }}" class="hidden fixed inset-0 z-50 bg-black/80 grid place-items-center p-4 text-left">
                <div class="glass p-8 rounded-3xl max-w-md w-full border border-white/10 relative">
                  <div class="flex items-center justify-between mb-6 pb-3 border-b border-white/10">
                    <div>
                      <div class="label-caps text-[#D4F54F] mb-1">Modify User</div>
                      <h3 class="font-head text-xl font-bold text-[#F2F5EC]">{{ $u->name }}</h3>
                    </div>
                    <button onclick="document.getElementById('edit-user-{{ $u->id }}').classList.add('hidden')" class="text-[#9AA391] hover:text-white">✕</button>
                  </div>

                  <form action="{{ route('admin.users.update', $u->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                      <label class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Full Name</label>
                      <input type="text" name="name" value="{{ $u->name }}" required class="w-full px-4 py-2.5 bg-white/[0.04] border border-white/10 rounded-xl text-xs text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
                    </div>

                    <div>
                      <label class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Role Tier</label>
                      <select name="role" class="w-full px-4 py-2.5 bg-white/[0.04] border border-white/10 rounded-xl text-xs font-mono text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
                        @foreach($roles as $key => $label)
                        <option value="{{ $key }}" {{ $u->role === $key ? 'selected' : '' }} class="bg-[#101210]">{{ $label }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div>
                      <label class="block text-xs font-mono uppercase tracking-wider text-[#9AA391] mb-2">Account Status</label>
                      <select name="status" class="w-full px-4 py-2.5 bg-white/[0.04] border border-white/10 rounded-xl text-xs font-mono text-[#F2F5EC] focus:border-[#D4F54F] outline-none">
                        <option value="active" {{ $u->status === 'active' ? 'selected' : '' }} class="bg-[#101210]">Active</option>
                        <option value="suspended" {{ $u->status === 'suspended' ? 'selected' : '' }} class="bg-[#101210]">Suspended</option>
                      </select>
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3">
                      <button type="button" onclick="document.getElementById('edit-user-{{ $u->id }}').classList.add('hidden')"
                        class="px-4 py-2 rounded-xl text-xs font-mono text-[#9AA391] hover:text-white">
                        Cancel
                      </button>
                      <button type="submit"
                        class="px-6 py-2.5 rounded-full bg-[#D4F54F] text-[#101210] font-mono text-xs font-bold uppercase tracking-wider hover:bg-[#F0FFB0] transition-colors">
                        Save Changes
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    @if($users->hasPages())
    <div class="p-4 border-t border-white/[0.08]">
      {{ $users->links() }}
    </div>
    @endif
  </div>

</div>
@endsection
