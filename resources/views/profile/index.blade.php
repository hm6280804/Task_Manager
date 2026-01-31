@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="page-header mb-4">
    <h1 class="page-title">My Profile</h1>
    <p class="page-subtitle">Manage your personal information and account settings</p>
</div>

<div class="row">
    <!-- Left Column - Profile Info -->
    <div class="col-lg-4">
        
        <!-- Profile Card -->
        <div class="card mb-4">
            <div class="card-body text-center">
                <!-- Avatar -->
                <div class="profile-avatar mb-3">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                
                <h4 class="mb-1">{{ $user->name }}</h4>
                <p class="text-muted mb-3">{{ $user->email }}</p>
                
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="badge bg-primary">Active User</span>
                    @if($user->email_verified_at)
                        <span class="badge bg-success">
                            <i class="bi bi-patch-check-fill me-1"></i>Verified
                        </span>
                    @endif
                </div>

                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-number">total tasks</div>
                        {{-- <div class="stat-number">{{ $stats['total_tasks'] }}</div> --}}
                        <div class="stat-label">Total Tasks</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">total Categories</div>
                        {{-- <div class="stat-number">{{ $stats['total_categories'] }}</div> --}}
                        <div class="stat-label">Categories</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">completed tasks</div>
                        {{-- <div class="stat-number">{{ $stats['completed_tasks'] }}</div> --}}
                        <div class="stat-label">Completed</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Info Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="bi bi-info-circle me-2"></i>Account Information
                </h6>
            </div>
            <div class="card-body">
                <div class="info-row mb-3">
                    <label class="text-muted small">Member Since</label>
                    <div>{{ $user->created_at->format('M d, Y') }}</div>
                </div>
                <div class="info-row mb-3">
                    <label class="text-muted small">Last Updated</label>
                    <div>{{ $user->updated_at->diffForHumans() }}</div>
                </div>
                <div class="info-row">
                    <label class="text-muted small">Email Status</label>
                    <div>
                        @if($user->email_verified_at)
                            <span class="text-success">
                                <i class="bi bi-check-circle-fill me-1"></i>Verified
                            </span>
                        @else
                            <span class="text-warning">
                                <i class="bi bi-exclamation-circle-fill me-1"></i>Not Verified
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats Card -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="bi bi-graph-up me-2"></i>Task Statistics
                </h6>
            </div>
            <div class="card-body">
                <div class="stat-bar mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Completion Rate</span>
                        <span class="fw-semibold">
                            some percent
                            {{-- {{ $stats['total_tasks'] > 0 ? round(($stats['completed_tasks'] / $stats['total_tasks']) * 100) : 0 }}% --}}
                        </span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" 
                             style="width: 60%">
                             {{-- style="width: {{ $stats['total_tasks'] > 0 ? round(($stats['completed_tasks'] / $stats['total_tasks']) * 100) : 0 }}%"> --}}
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">
                        <i class="bi bi-clock text-warning me-1"></i>Pending
                    </span>
                    <span class="fw-semibold">pending task</span>
                    {{-- <span class="fw-semibold">{{ $stats['pending_tasks'] }}</span> --}}
                </div>

                <div class="d-flex justify-content-between">
                    <span class="text-muted">
                        <i class="bi bi-exclamation-triangle text-danger me-1"></i>Overdue
                    </span>
                    <span class="fw-semibold text-danger">overdue tasks</span>
                    {{-- <span class="fw-semibold text-danger">{{ $stats['overdue_tasks'] }}</span> --}}
                </div>
            </div>
        </div>

    </div>

    <!-- Right Column - Edit Forms -->
    <div class="col-lg-8">
        
        <!-- Edit Profile Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-person-circle me-2"></i>Edit Profile
                </h5>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>Update Profile
                    </button>
                </form>
            </div>
        </div>

        <!-- Change Password Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-shield-lock me-2"></i>Change Password
                </h5>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                        <input type="password" 
                               class="form-control @error('current_password') is-invalid @enderror" 
                               id="current_password" 
                               name="current_password" 
                               required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimum 8 characters</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-shield-check me-2"></i>Update Password
                    </button>
                </form>
            </div>
        </div>

        <!-- Recent Activity Card -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-clock-history me-2"></i>Recent Activity
                </h5>
                <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                @if(1)
                    <p class="text-muted text-center py-3 mb-0">No recent activity</p>
                @else
                    <div class="activity-list">
                        @foreach($recentTasks as $task)
                            <div class="activity-item">
                                <div class="activity-icon {{ $task->is_completed ? 'bg-success' : 'bg-primary' }}">
                                    <i class="bi {{ $task->is_completed ? 'bi-check-circle' : 'bi-circle' }}"></i>
                                </div>
                                <div class="activity-content">
                                    <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none">
                                        <strong class="{{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                            {{ $task->title }}
                                        </strong>
                                    </a>
                                    <div class="d-flex gap-2 mt-1">
                                        @if($task->category)
                                            <span class="badge" style="background: {{ $task->category->color }}20; color: {{ $task->category->color }}; font-size: 11px;">
                                                {{ $task->category->name }}
                                            </span>
                                        @endif
                                        {!! $task->priority_badge !!}
                                    </div>
                                    <small class="text-muted">
                                        {{ $task->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection

@push('styles')
<style>
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #023B7E 0%, #0056b3 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        font-weight: 700;
        margin: 0 auto;
        box-shadow: 0 4px 15px rgba(2, 59, 126, 0.2);
    }

    .profile-stats {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 24px;
        font-weight: 700;
        color: #023B7E;
    }

    .stat-label {
        font-size: 12px;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-row label {
        display: block;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 11px;
    }

    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .activity-item {
        display: flex;
        gap: 15px;
        align-items: start;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        flex-shrink: 0;
    }

    .activity-content {
        flex-grow: 1;
    }

    .card-header h5,
    .card-header h6 {
        color: #023B7E;
    }
</style>
@endpush