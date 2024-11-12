<!-- resources/views/components/status-badge.blade.php -->
@php
    // Map status ke label dan kelas warna
    $statusClasses = [
        'pending' => 'badge-status pending',
        'approved' => 'badge-status approved',
        'declined' => 'badge-status declined',
    ];

    $statusLabels = [
        'pending' => 'Pending',
        'approved' => 'Approved',
        'declined' => 'Declined',
    ];

    $statusClass = $statusClasses[$status] ?? 'badge-status';
    $statusLabel = $statusLabels[$status] ?? $status;
@endphp

<span class="{{ $statusClass }}">
    {{ $statusLabel }}
</span>

<style>
    .badge-status {
        padding: 4px 8px;
        border-radius: 4px;
        color: white;
        font-weight: bold;
    }
    .badge-status.pending {
        background-color: gray;
    }
    .badge-status.approved {
        background-color: green;
    }
    .badge-status.declined {
        background-color: red;
    }
</style>
