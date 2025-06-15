@extends('layouts.dashboard')
<!-- Modal Penolakan Deposit -->
<div class="modal fade" id="rejectModal{{ $deposit->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel{{ $deposit->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.deposit.reject', $deposit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="rejectModalLabel{{ $deposit->id }}">Tolak Deposit</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="alasan_penolakan{{ $deposit->id }}" class="form-label">Alasan Penolakan</label>
                        <textarea name="alasan_penolakan" class="form-control" id="alasan_penolakan{{ $deposit->id }}" rows="3" required></textarea>
                    </div>
                    <p class="text-muted mb-0">Yakin ingin menolak deposit ini? Tindakan ini tidak dapat dibatalkan.</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Sekarang</button>
                </div>
            </div>
        </form>
    </div>
</div>
